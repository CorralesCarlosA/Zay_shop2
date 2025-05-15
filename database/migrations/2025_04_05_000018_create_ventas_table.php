<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->integer('id_venta')->unsigned()->autoIncrement();
            $table->string('n_identificacion_cliente', 10);
            $table->datetime('fecha_venta')->useCurrent();
            $table->char('hora_venta', 8);
            $table->decimal('total_venta', 10, 2);
            $table->enum('estado_venta', ['Pendiente', 'Completada', 'Cancelada'])->default('Pendiente');
            $table->string('metodo_pago', 50);
            $table->string('direccion_envio', 255);
            $table->integer('ciudad_envio')->unsigned();
            $table->unsignedInteger('id_administrador')->nullable();

            // Relaciones
            $table->foreign('n_identificacion_cliente')->references('n_identificacion')->on('clientes')->onDelete('cascade');
            $table->foreign('ciudad_envio')->references('id_ciudad')->on('ciudades')->onDelete('cascade');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
