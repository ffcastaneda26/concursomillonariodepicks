<?php

use App\Models\Round;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Round::class)->comment('Jornada');
            $table->unsignedBigInteger('local_team_id')->nullable()->comment('Equipo Local');
            $table->integer('local_points')->nullable()->default(null)->comment('Puntos Local');
            $table->unsignedBigInteger('visit_team_id')->nullable()->comment('Equipo Visita');
            $table->integer('visit_points')->nullable()->default(null)->comment('Puntos visita');
            $table->date('game_day')->comment('Fecha del juego aaaa-mm-dd');
            $table->time('game_time', $precision = 0)->comment('Hora de juego: hh:mm');
            $table->tinyInteger('winner')->nullable()->default(null)->comment('Ganador');
            $table->decimal('handicap',5,2)->nullable()->default(0.00)->comment('Linea o handicap');

            // Crear llaves foráneas
            $table->foreign('local_team_id')->references('id')->on('teams');
            $table->foreign('visit_team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
