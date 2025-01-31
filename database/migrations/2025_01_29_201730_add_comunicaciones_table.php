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
        Schema::table('comunicaciones', function (Blueprint $table) {
            $table->text('observacion')->nullable()->default(null); // Campo para observaciones
            $table->text('respuesta')->nullable()->default(null); // Campo para observaciones
            $table->timestamp('fecha_respuesta')->nullable()->default(null); // Campo para observaciones
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comunicaciones', function (Blueprint $table) {
            $table->dropColumn(['respuesta', 'observacion', 'fecha_respuesta']);
        });
    }
};
