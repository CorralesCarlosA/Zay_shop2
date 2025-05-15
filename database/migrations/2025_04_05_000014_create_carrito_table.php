<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->integer('id_carrito')->unsigned()->autoIncrement();
            $table->string('n_identificacion_cliente', 10);
            $table->integer('idProducto')->unsigned();
            $table->integer('cantidad')->default(1);
            $table->datetime('fecha_agregado')->useCurrent();

            // Relaciones
            $table->foreign('n_identificacion_cliente')->references('n_identificacion')->on('clientes')->onDelete('cascade');
            $table->foreign('idProducto')->references('idProducto')->on('productos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
