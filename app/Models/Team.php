<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Team
 *
 * @property $id
 * @property $name
 * @property $alias
 * @property $short
 * @property $logo
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Team extends Model
{
    protected $table = 'teams';
    public $timestamps = false;
    static $rules = [
		'name'  => 'required',
		'alias' => 'required',
		'short' => 'required',
		'logo'  => 'nullable',
    ];

    // protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','alias','short','logo'];

    public function local_games(): HasMany
    {
        return $this->hasMany(Game::class,'local_team_id');
    }

    public function visit_games(): HasMany
    {
        return $this->hasMany(Game::class,'visit_team_id');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function can_be_delete(){
        if($this->local_games()->count()) return false;
        if($this->visit_games()->count()) return false;
        return true;
    }

    // before delete() method call this
    protected static function booted () {
        static::deleting(function(Team $team) {
             $team->local_games()->delete();
             $team->visit_games()->delete();
        });
    }


    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeGeneral($query,$valor)
    {

        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }

}
