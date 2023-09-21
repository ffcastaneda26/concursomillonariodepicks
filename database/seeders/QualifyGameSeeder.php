<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Seeder;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QualifyGameSeeder extends Seeder
{
    use FuncionesGenerales;

    /*+---------------------------------------------------------+
      | Simulación de terminar partidos poniendo resultados     |
      +---------------------------------------------------------+
      | 1) Selecciona juegos de las jornadas 1 Y 2              |
      | 2) Random: Puntos visita, local y Ganador               |
      | 3) Determi
     */
    public function run(): void
    {
        $rounds = Round::where('id','<',3)->get();
        foreach($rounds as $round){
            foreach($round->games as $game){
                $local_points = 0;
                $visit_points = 0;

                while($local_points == $visit_points){
                    $local_points =  mt_rand(0,56);
                    $visit_points =  mt_rand(0,56);
                }
                $game->local_points = $local_points;
                $game->visit_points = $visit_points;

                $handicap = mt_rand(0,3);
                $negative_positive = mt_rand(0,1);
                if($handicap != 0){
                    $handicap = $handicap +0.5;
                }
                if($negative_positive == 0){
                    $handicap = $handicap * -1;
                }

                $game->handicap =$handicap;

                $game->winner   = $local_points > $visit_points ? 1 : 2;
                $game->save();

                $this->qualify_picks($game);

                if($game->is_last_game_round()){
                    $this->update_tie_breaker($game);
                }

                $this->update_total_hits($round); // Actualiza tabla de aciertos por jornada (POSITIONS)
                $this->update_positions($round);
            }
        }
    }
}
