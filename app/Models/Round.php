<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Auth;

/**
 * Class Round
 *
 * @property $id
 * @property $start_date
 * @property $end_date
 * @property $type
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Round extends Model
{

    protected $table = 'rounds';
    public $timestamps = false;
    static $rules = [
		'start_date' => 'required',
		'end_date' => 'required',
		'type' => 'required',
    ];

    protected $casts = [
        'start_date'  => 'datetime:Y-m-d',
        'end_date'  => 'datetime:Y-m-d',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['start_date','end_date','type'];


    /*+------------+
       | Relaciones |
       +------------+
     */

    public function games(): HasMany
    {
        return $this->hasMany(Game::class)->orderby('game_day')->orderby('game_time');
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function picks(): HasManyThrough
    {
        return $this->throughgames()->haspicks();
    }

    public function user_picks(User $user=null): HasManyThrough
    {
        if(!$user){
            $user=Auth::user();
        }

        return $this->throughgames()->haspicks()->where('user_id',$user->id)->orderby('game_id');
    }


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

     public function can_be_delete(){
        if($this->games()->count()) return false;
        return true;
    }

    // Jornada actual segun las fechas de inicio y final
     public function  read_current_round(){
        $dt = Carbon::now();

        $current_round = $this::where('start_date','<=',$dt->endOfDay())
                            ->where('end_date','>=',$dt->endOfDay())
                            ->first();
        $current_round->active = 1;
        $current_round->save();
        return $current_round;
     }

     // ¿Es el último partido de la jornada?
     public function is_last_game($game_id){
        return $this->games->last()->id == $game_id;
     }

     // Regresa el último partido de la jornada
     public function get_last_game_round(){
        return $this->games->last();
     }
}
