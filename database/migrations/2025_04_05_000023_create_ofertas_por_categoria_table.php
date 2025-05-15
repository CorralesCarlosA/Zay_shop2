<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ofertas_por_categoria', function (Blueprint $table) {
            $table->integer('id_oferta_categoria')->unsigned()->autoIncrement();
            $table->integer('id_categoria')->unsigned();
            $table->integer('idEstadoOferta')->unsigned();
            $table->integer('idTipoOferta')->unsigned();
            $table->integer('prioridad')->default(1);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            // Relaciones
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias_productos')->onDelete('cascade');
            $table->foreign('idEstadoOferta')->references('idEstadoOferta')->on('estadooferta')->onDelete('cascade');
            $table->foreign('idTipoOferta')->references('idTipoOferta')->on('tipooferta')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ofertas_por_categoria');
    }
};
