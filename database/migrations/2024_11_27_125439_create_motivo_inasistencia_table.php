<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motivo_inasistencia', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->text('descripcion'); // Campo para el motivo
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motivo_inasistencia');
    }
};
