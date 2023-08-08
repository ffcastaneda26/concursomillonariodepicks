<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picks extends Model
{
    use HasFactory;

    protected $table = 'picks';

    /*+------------+
      | Relaciones |
      +------------+
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */

}
