<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->enum('estado', ['presente', 'ausente']); // Estado de la asistencia

            // Relaciones
            $table->foreignId('clase_id')->constrained('clases')->onDelete('cascade'); // Relación con clases
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // Relación con usuarios
            $table->foreignId('motivo_inasistencia_id')->nullable()->constrained('motivo_inasistencia')->onDelete('set null'); // Relación con motivo_inasistencia

            $table->timestamps(); 
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
