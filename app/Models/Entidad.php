<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 'entidades';
    public $timestamps = false;


    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class);
    }




    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

    public function can_be_delete(){
        return false;
    }



    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeGeneral($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('nombre','LIKE',"%$valor%")
                  ->orwhere('abreviado','LIKE',"%$valor%");
         }
    }

    public function scopePredeterminado($query)
    {
        $query->where('predeterminado',1)->first();
    }

}
