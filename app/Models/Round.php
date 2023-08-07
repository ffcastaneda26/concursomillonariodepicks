<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Round
 *
 * @property $id
 * @property $fecha_inicio
 * @property $fecha_final
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
		'fecha_inicio' => 'required',
		'fecha_final' => 'required',
		'type' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha_inicio','fecha_final','type'];



}
