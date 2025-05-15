<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->integer('id_pedido')->unsigned()->autoIncrement();
            $table->string('n_identificacion_cliente', 10);
            $table->integer('direccion_envio')->unsigned();
            $table->integer('ciudad_envio')->unsigned();
            $table->decimal('total_pedido', 10, 2);
            $table->enum('estado_pedido', ['Pendiente', 'Enviado', 'Completado', 'Cancelado'])->default('Pendiente');
            $table->datetime('fecha_pedido')->useCurrent();
            $table->char('hora_pedido', 8);

            // Relaciones
            $table->foreign('n_identificacion_cliente')->references('n_identificacion')->on('clientes')->onDelete('cascade');
            $table->foreign('ciudad_envio')->references('id_ciudad')->on('ciudades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
