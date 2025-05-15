<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->integer('id_devolucion')->unsigned()->autoIncrement();
            $table->integer('id_venta')->unsigned()->nullable();
            $table->string('n_identificacion_cliente', 10);
            $table->text('motivo_devolucion')->nullable();
            $table->enum('estado_devolucion', ['Pendiente', 'Aprobada', 'Rechazada', 'Completada'])->default('Pendiente');
            $table->datetime('fecha_solicitud')->useCurrent();
            $table->string('hora_solicitud', 8);
            $table->text('comentarios_cliente')->nullable();
            $table->text('comentarios_administrador')->nullable();
            $table->integer('id_administrador')->unsigned()->nullable();

            // Relaciones
            $table->foreign('n_identificacion_cliente')->references('n_identificacion')->on('clientes')->onDelete('cascade');
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('set null');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devoluciones');
    }
};
