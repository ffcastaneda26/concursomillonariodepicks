<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
		'short' => 'nullable',
		'logo'  => 'nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','alias','short','logo'];



}
