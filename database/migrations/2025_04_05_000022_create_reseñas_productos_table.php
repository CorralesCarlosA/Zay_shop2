<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reseñas_productos', function (Blueprint $table) {
            $table->integer('id_reseña')->unsigned()->autoIncrement();
            $table->string('n_identificacion_cliente', 10);
            $table->integer('idProducto')->unsigned();
            $table->decimal('calificacion', 3, 2)->check('calificacion', 'BETWEEN 0 AND 5');
            $table->text('comentario')->nullable();
            $table->datetime('fecha_reseña')->useCurrent();
            $table->string('hora_reseña', 8);
            $table->enum('estado_reseña', ['Pendiente', 'Aprobada', 'Rechazada'])->default('Pendiente');

            // Relaciones
            $table->foreign('n_identificacion_cliente')->references('n_identificacion')->on('clientes')->onDelete('cascade');
            $table->foreign('idProducto')->references('idProducto')->on('productos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reseñas_productos');
    }
};
