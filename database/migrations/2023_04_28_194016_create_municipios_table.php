<?php

use App\Models\Entidad;
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
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Entidad::class)->comment('Entidad Federativa');
            $table->string('nombre',50)->comment('Municipio');
            $table->boolean('predeterminado')->default(0)->comment('Predeterminado?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipios');
    }
};
