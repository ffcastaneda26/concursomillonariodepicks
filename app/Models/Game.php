<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $table = 'games';
    public $timestamps = false;

    protected $fillable = ['round_id',
                            'local_team_id',
                            'local_points',
                            'visit_team_id',
                            'visit_points',
                            'game_day',
                            'game_time',
                            'winner'
    ];

    protected $casts = [
        'game_day'  => 'datetime:Y-m-d',
    ];

    /*+---------------------+
      | Setters y Getters   |
      +---------------------+
    */
    public function getHourAttribute()
    {
        $hour_game      = intval(substr($this->game_time,0,2));
        $minutes_game   = intval(substr($this->game_time,3,2));

        if($hour_game > 12){
            $hour_game = $hour_game - 12;
            $meridian  = 'P.M.';
        }else{
            $meridian  = 'A.M.';
        }

        return $hour_game . ':' .  $minutes_game . ' ' . $meridian;
        return strtoupper($this->first_name) . ' ' . strtoupper($this->last_name);
    }


    public function setGameDateAttribute()
    {
        $year_game      = substr($this->game_day,0,4);
        $month_game     = substr($this->game_day,5,2);
        $day_game       = substr($this->game_day,8,2);
        $hour_game      = substr($this->game_time,0,2);
        $minutes_game   = substr($this->game_time,3,2);
        $this->attributes['game_date'] = mktime($hour_game,$minutes_game,00,$month_game,$day_game,$year_game);
    }
    /*+------------+
       | Relaciones |
       +------------+
    */

    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function team_tie_breaker(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }

    public function round():BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function local_team(): BelongsTo
    {
        return $this->belongsTo(Team::class,'local_team_id');

    }

    public function visit_team(): BelongsTo
    {
        return $this->belongsTo(Team::class,'visit_team_id');
    }


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

     public function can_be_delete(){
        return false;
    }

    // ¿Permite pronosticar?

    public function allow_pick(){
        date_default_timezone_set(env('TIMEZONE','America/Mexico_City'));
        $configuration = Configuration::first();
        $year_game      = substr($this->game_day,0,4);
        $month_game     = substr($this->game_day,5,2);
        $day_game       = substr($this->game_day,8,2);
        $hour_game      = substr($this->game_time,0,2);
        $minutes_game   = substr($this->game_time,3,2);
        return mktime($hour_game,$minutes_game,00,$month_game,$day_game,$year_game) - time() > $configuration->minuts_before_picks * 60;
    }

    // Pronóstico del juegoy del usuario
    public function pick_user($user_id=null){
        if(!$user_id){
            $user_id = Auth::user()->id;
        }

       return $this->picks->where('user_id',$user_id)->first();
    }

    // Imprime Resultado?
    public function print_score(){
        return (!is_null($this->local_points) || !is_null($this->visit_points)) && ($this->local_points != $this->visit_points);
    }

    // ¿Es el último partido de la jornada?
    public function is_last_game_round(){
        $configuration_record = Configuration::first();

        if( $configuration_record->use_team_to_tie_breaker){
            return ( $this->local_team_id == $configuration_record->team_id  || $this->visit_team_id == $configuration_record->team_id);
        }

        return $this->round->get_last_game_round()->id == $this->id;


    }

    // ¿Es el partido del desempate?

    public function is_game_tie_breaker(){
        $configuration_record = Configuration::first();
        return $configuration_record->use_team_to_tie_breaker
           && ( $this->local_team_id == $configuration_record->team_id  || $this->visit_team_id == $configuration_record->team_id);
    }

    // Ya tiene resultado
    public function has_result(){
         return !is_null($this->visit_points) || !is_null($this->local_points);
    }

    // ¿Quien gana: local o visit?
    public function win(){
        if(is_null( $this->local_points) || is_null($this->visit_points)){
            return false;
        }

        $this->winner = $this->local_points + $this->handicap  >=  $this->visit_points ? 1 : 2;
        $this->save();
        $sql = "UPDATE picks pic,games ga ";
        $sql.="SET ";
        $sql.="hit= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END ";
        $sql.="WHERE ga.id = pic.game_id ";
        $sql.="  AND ga.id = " . $this->id;
        DB::update($sql);

        return $this->local_points + $this->handicap  >=  $this->visit_points ? 1 : 2;
    }


    /*+-------------+
      | Búsquedas   |
      +-------------+
    */

    public function scopeWhitResult($query)
    {
        $query->whereNotNull('local_points')
              ->WhereNotNull('visit_points');
    }




}
