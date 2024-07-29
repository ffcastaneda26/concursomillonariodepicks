<?php

use App\Models\Team;
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
            $table->integer('picks_to_select')->default(0)->comment('Pronósticos a seleccionar');
            $table->boolean('allow_tie')->default(0)->comment('¿Permitir empate?');
            $table->boolean('create_mssing_picks')->default(0)->comment('¿Crear pronósticos faltantes?');
            $table->boolean('assig_role_to_user')->default(0)->comment('¿Asignar Rol al registrarse?');
            $table->boolean('use_team_to_tie_breaker')->default(0)->comment('¿Usar un Equipo para desempate?');
            $table->foreignIdFor(Team::class)->comment('Equipo para desempate');
            $table->boolean('substract_points_accumulated')->default(0)->comment('Restar ountos acumulados');
            $table->enum('type_substract_points',['U','R'])->default('R')->comment('U=N jornadas de participación R=A partir de cierta jornada');
            $table->integer('user_rounds_participation',2)->default(3)->comment('Jornadas de participación del usuario para restar puntos');
            $table->integer('subtract_from_round',2)->default(18)->comment('Restar a partir de la jornada');
            $table->integer('rounds_to subtract points')->default(2)->comment('Jornadas con menos puntos para restarel total');
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
