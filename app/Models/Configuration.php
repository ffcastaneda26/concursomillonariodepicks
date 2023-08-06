<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuration
 *
 * @property $id
 * @property $website_name
 * @property $website_url
 * @property $email
 * @property $score_picks
 * @property $minuts_before_picks
 * @property $allow_tie
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Configuration extends Model
{

    protected $table = 'configuration';
    public $timestamps = false;
    static $rules = [
		'website_name'           => 'required',
		'website_url'           => 'required',
		'email'                 => 'required',
		'email'                 => 'email',
		'score_picks'           => 'nullable',
		'minuts_before_picks'   => 'required',
		'allow_tie'             => 'nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['website_name','website_url','email','score_picks','minuts_before_picks','allow_tie'];



}
