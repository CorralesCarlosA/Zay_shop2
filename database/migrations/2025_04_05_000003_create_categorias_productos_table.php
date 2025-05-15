<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias_productos', function (Blueprint $table) {
            $table->integer('id_categoria')->unsigned()->autoIncrement();
            $table->string('nombre_categoria', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias_productos');
    }
};
