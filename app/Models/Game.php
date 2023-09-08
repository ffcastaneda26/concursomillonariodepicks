<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $table = 'games';
    public $timestamps = false;
    static $rules = [
		'round_id'      => 'required|exists:rounds,id',
        'local_team_id' => 'required|exists:teams,id',
		'visit_team_id' => 'required|exists:teams,id',
		'local_points'  => 'nullable',
		'visit_points'  => 'nullable',
		'game_day'      => 'required',
		'game_time'     => 'required',
		'winner'        => 'nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['round_id','local_team_id','local_points','visit_team_id','visit_points','game_day','game_time','winner'];

    protected $casts = [
        'game_day'  => 'datetime:Y-m-d',
        'game_time' => 'datetime:hh:mm',
    ];

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
        date_default_timezone_set("America/Chihuahua");
        $configuration = Configuration::first();
        $fecha_juego = new Carbon($this->game_day);
        $newDateTime = Carbon::now()->subMinute($configuration->minuts_before_picks);
        return $fecha_juego > $newDateTime;
    }

    // Pronóstico del juegoy del usuario
    public function pick_user(){
       return $this->picks->where('user_id',Auth::user()->id)->first();
    }

    // Imprime Resultado?
    public function print_score(){
        return (!is_null($this->local_points) || !is_null($this->visit_points)) && ($this->local_points != $this->visit_points);
    }

    // TODO: Cambiar el ID del equipo por algo que esté configurado
    public function is_last_game_round(){
        $configuration_record = Configuration::first();

        // return  ($this->local_team_id==1 || $this->visit_team_id == 1);

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

    // ¿Gana local?
    public function win(){
        return $this->local_points > $this->visit_points ? 'local' : 'visit';
    }

}
