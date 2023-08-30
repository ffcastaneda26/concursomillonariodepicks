<?php

use App\Models\Entidad;
use App\Models\Municipio;
use App\Models\User;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->default(6)->comment('Usuario');
            $table->enum('gender',['Hombre','Mujer'])->default('Hombre')->comment('Sexo');
            $table->date('birthday')->nullable()->default(null)->comment('Fecha Nacimiento');
            $table->string('curp',18)->unique()->nullable()->default(null)->comment('Curp');
            $table->foreignIdFor(Entidad::class)->default(6)->comment('Entidad Federativa');
            $table->foreignIdFor(Municipio::class)->default(164)->comment('Municipio');
            $table->string('codpos',5)->nullable()->default(null)->comment('Código Postal');
            $table->string('ine_anverso', 2048)->nullable()->default(null)->comment('Credencial INE Anverso');
            $table->string('ine_reverso', 2048)->nullable()->default(null)->comment('Credencial INE Reverso');
            $table->string('stripe_session')->unique()->nullable()->default(null)->comment('Id Sesión de stripe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
