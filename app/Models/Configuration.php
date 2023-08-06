<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_name',
        'website_url',
        'email',
        'score_picks',
        'minuts_before_picks',
        'allow_tie',
    ];
}
