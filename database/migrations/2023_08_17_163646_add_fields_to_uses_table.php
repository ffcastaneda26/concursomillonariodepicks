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
            $table->string('curp',18)->nullable()->default(null)->after('birthday')->comment('Curp');
            $table->boolean('authorized')->default(0)->after('adult')->comment('¿Autorizado (Se verificaron credenciales)?');
            $table->foreignIdFor(Entidad::class)->after('linkedin')->default(6)->comment('Entidad Federativa');
            $table->foreignIdFor(Municipio::class)->after('entidad_id')->default(164)->comment('Municipio');
            $table->string('codpos',5)->nullable()->default(null)->after('municipio_id')->comment('Código Postal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('curp');
            $table->dropColumn('authorized');
            $table->dropColumn('entidad_id');
            $table->dropColumn('municipio_id');
            $table->dropColumn('codpos');

        });
    }
};
