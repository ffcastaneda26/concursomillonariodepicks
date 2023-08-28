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
        Schema::table('configuration', function (Blueprint $table) {
            $table->boolean('require_payment_to_continue')->default(1)->comment('¿Require pago para continuar?');
            $table->boolean('require_data_user_to_continue')->default(1)->comment('¿Requiere datos complementarios para continuar?');
            $table->boolean('assig_role_to_user')->default(0)->comment('¿Asignar Rol al registrarse?');
            $table->boolean('add_user_to_stripe')->default(0)->comment('¿Agregar usuario a Stripe?');
            $table->boolean('use_team_to_tie_breaker')->default(0)->comment('¿Usar un Equipo para desempate?');
            $table->foreignIdFor(Team::class)->comment('Equipo para desempate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configuration', function (Blueprint $table) {
            $table->dropColumn('require_payment_to_continue');
            $table->dropColumn('require_data_user_to_continue');
            $table->dropColumn('assig_role_to_user');
            $table->dropColumn('add_user_to_stripe');
            $table->dropColumn('use_team_to_tie_breaker');
            $table->dropColumn('team_id');

        });
    }
};
