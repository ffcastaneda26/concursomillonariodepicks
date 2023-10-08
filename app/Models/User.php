<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use function Illuminate\Events\queueable;
use function PHPUnit\Framework\isNull;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'alias',
        'email',
        'password',
        'change_password',
        'active',
        'phone',
        'adult',
        'accept_terms',
        'paid'
    ];



    public function getFullNameAttribute()
    {
        return strtoupper($this->first_name) . ' ' . strtoupper($this->last_name) . ' ' . strtoupper($this->maternal_name);
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }


    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = ucwords($value);
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /*+------------+
      | Relaciones |
      +------------+
     */

    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function picks_updated(): HasMany
    {
        return $this->hasMany(Pick::class,'updated_user_id');
    }

    public function picks_game($game_id): HasMany
    {
        return $this->hasMany(Pick::class)->where('game_id',$game_id);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class,'user_id')->orderby('round_id');
    }

    public function general_position(): HasOne
    {
        return $this->hasOne(GeneralPosition::class);
    }

    public function positions_rounds_played($roundsIds){
        return $this->positions()->whereIn('round_id',$roundsIds);

    }
    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        return false;
    }


    public function has_position_record_round($round_id){
       return $this->positions->where('round_id',$round_id)->count();
    }

    public function hits_round($round_id){
        return $this->positions->where('round_id',$round_id)->first()->hits;
    }

    public function is_active(){
        return $this->active;
    }

    public function is_adult(){
        return $this->adult;
    }

    // Pronósticos acertados en la jornada
    public function picks_hit_round($round_id){
        $hits = 0;
        foreach($this->picks->where('hit',1) as $pick){
            if($pick->game->round_id == $round_id && $pick->hit){
                $hits++;
            }


        }
        return $hits;
        return $this->picks()->game()->where('round_id',$round_id)->count();

    }



    // Asignarle los pronósticos que falten
    public function create_missing_picks(){
        $games = Game::where('game_day','>=',now())->get();
        foreach($games as $game){
            if($game->allow_pick()){
                $winner = mt_rand(1,2);
                $new_pick = Pick::create([
                    'user_id'   => $this->id,
                    'game_id'   => $game->id,
                    'winner'    => $winner
                    ]);

                if($game->is_last_game_round()){
                    if($winner == 1){
                        $new_pick->local_points = 7;
                        $new_pick->visit_points = 0;
                    }else{
                        $new_pick->local_points = 0;
                        $new_pick->visit_points = 7;
                    }
                    $new_pick->total_points = 7;
                }
                $new_pick->save();
            }
        }

    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeGeneral($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%")
                 ->orwhere('email','LIKE',"%$valor%")
                 ->orwhere('alias','LIKE',"%$valor%");
         }
    }

}
