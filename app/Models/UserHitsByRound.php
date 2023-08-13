<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Position
 *
 * @property $id
 * @property $round_id
 * @property $user_id
 * @property $hits
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class UserHitsByRound extends Model
{
    use HasFactory;

    protected $table = 'user_hits_by_rounds';
    protected $fillable = [
        'round_id',
        'user_id',
        'hits',
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

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

}
