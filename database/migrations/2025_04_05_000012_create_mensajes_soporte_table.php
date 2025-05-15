<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes_soporte', function (Blueprint $table) {
            $table->integer('id_mensaje')->unsigned()->autoIncrement();
            $table->string('n_identificacion_cliente', 10);
            $table->unsignedInteger('id_administrador')->nullable();
            $table->string('asunto', 100);
            $table->text('mensaje');
            $table->datetime('fecha_envio')->default('current_timestamp()');
            $table->enum('estado_mensaje', ['Abierto', 'Respondido', 'Cerrado'])->default('Abierto');
            $table->datetime('fecha_respuesta')->nullable();
            $table->string('hora_respuesta', 8)->nullable();
            $table->timestamps(false); // Sin timestamps automáticos
        });

        // Relaciones
        Schema::table('mensajes_soporte', function (Blueprint $table) {
            $table->foreign('n_identificacion_cliente')
                ->references('n_identificacion')->on('clientes')
                ->onDelete('cascade');

            $table->foreign('id_administrador')
                ->references('id_administrador')->on('administradores')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes_soporte');
    }
};
