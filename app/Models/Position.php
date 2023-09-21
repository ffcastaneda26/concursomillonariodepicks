<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round_id',
        'user_id',
        'hits',
        'dif_winner_points',
        'error_abs_local_visita',
        'marcador_total',
        'hit_last_game',
        'hit_visit',
        'hit_local',
        'position'
    ];

    /*+------------+
      | Relaciones |
      +------------+
     */

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
