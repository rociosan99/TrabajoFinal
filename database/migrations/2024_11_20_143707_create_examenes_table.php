<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesTable extends Migration
{
    public function up()
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('tema'); // Tema del examen
            $table->date('fecha_examen'); // Fecha del examen
            $table->timestamps(); // created_at y updated_at

            $table->unsignedBigInteger('curso_id'); // Relación con el curso
            // Clave foránea
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('examenes');
    }
}

