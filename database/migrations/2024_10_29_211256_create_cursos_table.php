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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string ('nombre');
            $table->string('dia');
            $table->time ('horario');
            $table->date ('fecha_inicio');
            $table->date ('fecha_fin');
            $table->string ('descripcion');

            $table->unsignedBigInteger("usuario_id");//clave foranea
            $table->foreign("usuario_id")->references("id")->on("users");
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
