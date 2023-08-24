<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Municipio extends Model
{
    use HasFactory;
    protected $table = 'municipios';
    public $timestamps = false;


    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */



    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class);
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
            $query->where('nombre','LIKE',"%$valor%");
         }
    }



}

