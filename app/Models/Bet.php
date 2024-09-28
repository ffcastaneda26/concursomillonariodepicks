<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bet extends Model
{
    use HasFactory;

    protected $table = 'bets';
    public $timestamps = false;

    protected $fillable = ['name'];
    static $rules = [
		'name'  => 'required',
    ];

    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

        /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

     public function can_be_delete(){
        if($this->picks()->count()) return false;
        return true;
    }
    public function scopeGeneral($query,$valor)
    {

        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }
}
