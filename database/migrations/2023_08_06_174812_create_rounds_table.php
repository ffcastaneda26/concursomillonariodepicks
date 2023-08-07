<?php

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
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio')->unique()->comment('Fecha de inicio');
            $table->date('fecha_final')->unique()->comment('Fecha finalio');
            $table->enum('type',['Regular','Divisional','Conferencia'])->default('Regular')->comment('Tipo de Jornada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
