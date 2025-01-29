<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('asistencias', function (Blueprint $table) {
            // Agregar una restricción de unicidad a las columnas 'alumno_id' y 'fecha'
            $table->unique(['clase_id', 'usuario_id']);
        });
    }

    /**
     * Revierte la migración.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('asistencias', function (Blueprint $table) {
            // Eliminar la restricción de unicidad
            $table->dropUnique(['clase_id', 'usuario_id']);
        });
    }
};
