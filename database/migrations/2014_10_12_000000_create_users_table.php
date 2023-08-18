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
            $table->string('first_name',50)->comment('Nombre');
            $table->string('last_name',50)->comment('Apellido');
            $table->string('email')->unique()->comment('Correo');
            $table->string('phone',10)->nullable()->default(null)->comment('Teléfono');
            $table->enum('gender',['Hombre','Mujer'])->default('Hombre')->comment('Sexo');
            $table->date('birthday')->nullable()->default(null)->comment('Fecha Nacimiento');
            $table->boolean('adult')->default(0)->comment('¿Es Adulto?');
            $table->boolean('accept_terms')->default(0)->comment('¿Aceptó Términos y Condiciones?');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('facebook')->nullable()->default(null)->comment('Facebook');
            $table->string('youtube')->nullable()->default(null)->comment('Facebook');
            $table->string('instagram')->nullable()->default(null)->comment('Facebook');
            $table->string('tweeter')->nullable()->default(null)->comment('tweeter');
            $table->string('tiktok')->nullable()->default(null)->comment('tiktok');
            $table->string('pinterest')->nullable()->default(null)->comment('pinterest');
            $table->string('snapshat')->nullable()->default(null)->comment('snapshat');
            $table->string('linkedin')->nullable()->default(null)->comment('linkedin');
            $table->boolean('active')->default(0)->comment('¿Está activo?');
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
