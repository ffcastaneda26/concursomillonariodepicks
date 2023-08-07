<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Game
 *
 * @property $id
 * @property $round_id
 * @property $local_team_id
 * @property $local_points
 * @property $visit_team_id
 * @property $visit_points
 * @property $game_day
 * @property $game_time
 * @property $game_date
 * @property $winner
 *
 * @property Team $team
 * @property Team $team
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Game extends Model
{
    protected $table = 'games';
    public $timestamps = false;
    static $rules = [
		'round_id'      => 'required|exists:rounds,id',
        'local_team_id' => 'required|exists:teams,id',
		'local_points'  => 'nullable',
		'visit_team_id' => 'required|exists:teams,id',
		'visit_points'  => 'nullable',
		'game_day'      => 'required',
		'game_time'     => 'required',
		'game_date'     => 'required',
		'winner'        => 'nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['round_id','local_team_id','local_points','visit_team_id','visit_points','game_day','game_time','game_date','winner'];

    protected $casts = [
        'game_day'  => 'datetime:Y-m-d',
        'game_time' => 'datetime:hh:mm',
        'game_date' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function local_team(): BelongsTo
    {
        return $this->belongsTo(Team::class,'local_team_id');

    }

    public function visit_team(): BelongsTo
    {
        return $this->belongsTo(Team::class,'visit_team_id');

    }


}
