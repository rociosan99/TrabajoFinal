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
        Schema::create('comunicaciones', function (Blueprint $table) {
            $table->id('id_comunicacion'); //clave primaria
            $table->foreignId('receptor')->constrained('users'); //usuario receptor del mensaje
            $table->timestamp('fecha')->useCurrent(); // Fecha del mensaje,valor por defecto la fecha actual
            $table->enum('estado', ['enviado', 'pendiente'])->default('pendiente'); //con valor por defecto 'pendiente'
            $table->string('titulo', 255); //Título del mensaje
            $table->text('cuerpo'); //Cuerpo del mensaje
            $table->foreignId('id_clase')->nullable()->constrained('clases'); // clave foránea a la tabla clases
            $table->foreignId('id_curso')->nullable()->constrained('cursos'); // clave foránea a la tabla cursos
            $table->timestamps(); //columnas created_at y updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunicaciones');
    }
};
