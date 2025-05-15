<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagenes_producto', function (Blueprint $table) {
            $table->integer('id_imagen_producto')->unsigned()->autoIncrement();
            $table->integer('idProducto')->unsigned();
            $table->string('url_imagen', 255);
            $table->boolean('is_main')->default(0);

            // Relación
            $table->foreign('idProducto')->references('idProducto')->on('productos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes_producto');
    }
};
