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
        Schema::create('horarios_cursos', function (Blueprint $table) {
            $table->id('id_horario_curso');
            
            // Clave foránea hacia la tabla cursos
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');

            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('dia_semana', ['lunes', 'martes', 'miércoles', 'jueves', 'viernes']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_cursos');
    }
};
