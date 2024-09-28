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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->comment('Nombre(s)');
            $table->string('alias',12)->unique()->comment('Alias');
            $table->string('email')->unique()->comment('Correo');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('change_password')->default(0)->comment('¿Necesita Cambiar Clave?');
            $table->boolean('authorized')->default(0)->comment('¿Autorizado?');
            $table->boolean('active')->default(0)->comment('¿Está activo?');
            $table->string('phone',10)->nullable()->default(null)->comment('Teléfono');
            $table->boolean('adult')->default(0)->comment('¿Es Adulto?');
            $table->boolean('accept_terms')->default(0)->comment('¿Aceptó Términos y Condiciones?');
            $table->boolean('paid')->default(0)->comment('¿Ya pagó?');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
