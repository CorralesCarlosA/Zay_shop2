<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventario_productos', function (Blueprint $table) {
            $table->integer('id_inventario')->unsigned()->autoIncrement();
            $table->integer('idProducto')->unsigned();
            $table->integer('stock_actual')->default(0);
            $table->integer('stock_minimo')->default(10);
            $table->datetime('fecha_actualizacion')->useCurrent();
            $table->integer('id_administrador')->unsigned();

            // Relaciones
            $table->foreign('idProducto')->references('idProducto')->on('productos')->onDelete('cascade');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventario_productos');
    }
};
