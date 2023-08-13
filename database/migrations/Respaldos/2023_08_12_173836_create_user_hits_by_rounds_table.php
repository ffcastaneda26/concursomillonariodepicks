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
        Schema::create('user_hits_by_rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->comment('Jugador');
            $table->foreignIdFor(Round::class)->comment('Jornada');
            $table->tinyInteger('hits')->nullable()->default(null)->comment('Aciertos');
            $table->tinyInteger('position')->nullable()->default(null)->comment('Posición en la jornada');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_hits_by_rounds');
    }
};
