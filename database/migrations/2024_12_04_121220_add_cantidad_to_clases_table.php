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
        $table->integer('cantidad')->nullable()->after('curso_id'); // Añadimos el campo
        });
    }

    public function down(): void
    {   
        Schema::table('clases', function (Blueprint $table) {
        $table->dropColumn('cantidad');
        });
    }

};
