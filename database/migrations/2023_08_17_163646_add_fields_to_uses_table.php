<?php

use App\Models\Entidad;
use App\Models\Municipio;
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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('change_password')->default(0)->after('linkedin')->comment('¿Necesita Cambiar Clave?');
            $table->string('curp',18)->unique()->nullable()->default(null)->after('birthday')->comment('Curp');
            $table->boolean('authorized')->default(0)->after('adult')->comment('¿Autorizado (Se verificaron credenciales)?');
            $table->foreignIdFor(Entidad::class)->after('change_password')->default(6)->comment('Entidad Federativa');
            $table->foreignIdFor(Municipio::class)->after('entidad_id')->default(164)->comment('Municipio');
            $table->string('codpos',5)->nullable()->default(null)->after('municipio_id')->comment('Código Postal');
            $table->string('ine_anverso', 2048)->nullable()->default(null)->after('codpos')->comment('Credencial INE Anverso');
            $table->string('ine_reverso', 2048)->nullable()->default(null)->after('ine_anverso')->comment('Credencial INE Reverso');
            $table->string('stripe_session')->unique()->nullable()->default(null)->after('authorized')->comment('Id Sesión de stripe');
            $table->boolean('paid')->default(0)->after('stripe_session')->comment('¿Ya pagó?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('curp');
            $table->dropColumn('change_password');
            $table->dropColumn('authorized');
            $table->dropColumn('entidad_id');
            $table->dropColumn('municipio_id');
            $table->dropColumn('codpos');
            $table->dropColumn('ine_anverso');
            $table->dropColumn('ine_reverso');
            $table->dropColumn('stripe_session');
            $table->dropColumn('paid');
        });
    }
};
