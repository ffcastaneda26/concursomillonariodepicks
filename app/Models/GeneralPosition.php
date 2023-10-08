<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralPosition extends Model
{
    use HasFactory;
    protected $table = 'general_positions';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'hits',
        'hits_breaker',
        'total_error',
        'position'
    ];


    /*+-------------+
     | Relaciones   |
     +--------------+
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /*+-------------+
     | Apoyo   |
     +--------------+
    */

    public function truncate_me(){
        $this::truncate();
    }

    public function create_positions($positions){
        $position = 0;
        foreach($positions as $reg_position){

           $this->create([
                'user_id'       => $reg_position->user_id,
                'hits'          => $reg_position->hits,
                'hits_breaker'  => $reg_position->hit_last_games,
                'total_error'   => $reg_position->error_abs_local_visita,
                'position'      => ++$position
            ]);
        }
    }

}
