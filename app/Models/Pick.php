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


    public function winner($local_points,$visit_points){
        if(is_null( $local_points) || is_null($visit_points)){
            return false;
        }

        $this->local_points = $local_points;
        $this->visit_points = $visit_points;
        $this->winner = $local_points + $this->game->handicap  >=  $visit_points ? 1 : 2;
        $this->save();
        return $this->whnner;
    }
}
