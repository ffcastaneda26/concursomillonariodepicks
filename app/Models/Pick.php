<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pick extends Model
{
    use HasFactory;

    protected $table = 'picks';
    protected $fillable = ['user_id','game_id','winner','updated_user_id'];

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

    public function user_updated(): BelongsTo
    {
        return $this->belongsTo(User::class,'updated_user_id');
    }


}
