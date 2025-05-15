<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificaciones_clientes', function (Blueprint $table) {
            $table->integer('id_notificacion')->unsigned()->autoIncrement();
            $table->string('n_identificacion_cliente', 10);
            $table->integer('id_administrador')->unsigned()->nullable();
            $table->text('mensaje');
            $table->datetime('fecha_envio')->useCurrent();
            $table->char('leido', 1)->default('0');

            // Relaciones
            $table->foreign('n_identificacion_cliente')->references('n_identificacion')->on('clientes')->onDelete('cascade');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones_clientes');
    }
};
