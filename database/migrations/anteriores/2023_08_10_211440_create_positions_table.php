<?php

use App\Models\User;
use App\Models\Round;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Round::class)->comment('Jornada');
            $table->foreignIdFor(User::class)->comment('Jugador');
            $table->tinyInteger('hits')->nullable()->default(null)->comment('Aciertos');
            $table->boolean('hit_last_game')->nullable()->default(0)->comment('¿Acertó ultimo juego?');
            $table->tinyInteger('error_abs_local_visita')->nullable()->default(null)->comment('Dif Absoluta local-visita entre pronóstico y juego');
            $table->tinyInteger('dif_winner_points')->nullable()->default(null)->comment('Dif Puntos del ganador');
            $table->tinyInteger('marcador_total')->nullable()->default(null)->comment('Dif de la victoria');
            $table->tinyInteger('position')->nullable()->default(null)->comment('Posición en la jornada');
            $table->boolean('exclude')->default(0)->comment('¿Excluir en acumulados?');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
