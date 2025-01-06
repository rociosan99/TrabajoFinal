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
        Schema::table('clases', function (Blueprint $table) {
            $table->boolean('dictado')->default(0)->after('cantidad'); // Campo entero para marcar dictado
            $table->text('observacion')->nullable()->after('dictado'); // Campo para observaciones
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clases', function (Blueprint $table) {
            $table->dropColumn(['dictado', 'observacion']);
        });
    }
};
