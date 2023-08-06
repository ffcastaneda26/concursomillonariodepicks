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
        Schema::create('configuration', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->comment('Nombre del website');
            $table->string('website_url')->nullable()->comment('Url');
            $table->string('email')->nullable()->comment('Correo');
            $table->boolean('score_picks')->default(0)->comment('Puntos en pronósticos');
            $table->integer('minuts_before_picks')->default(5)->comment('Minutos antes para pronóstico');
            $table->boolean('allow_tie')->default(0)->comment('¿Permitir empate?');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration');
    }
};
