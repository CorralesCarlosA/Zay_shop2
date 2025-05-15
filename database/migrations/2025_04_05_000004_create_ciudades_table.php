<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->integer('id_ciudad')->unsigned()->autoIncrement();
            $table->string('nombre_ciudad', 100);
            $table->integer('id_departamento')->unsigned();

            // Índices
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciudades');
    }
};
