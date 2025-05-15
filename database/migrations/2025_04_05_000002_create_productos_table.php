<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->integer('idProducto')->unsigned()->autoIncrement();
            $table->string('nombreProducto', 100);
            $table->decimal('precioProducto', 10, 2);
            $table->string('tallaProducto', 10);
            $table->integer('idClaseProducto')->unsigned();
            $table->integer('idSexoProducto')->unsigned();
            $table->text('descripcionProducto');
            $table->string('codigoIdentificador', 100)->unique();
            $table->integer('idEstadoOferta')->unsigned()->nullable();
            $table->integer('idTipoOferta')->unsigned()->nullable();
            $table->integer('idColor')->unsigned();
            $table->integer('idEstadoProducto')->unsigned();
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->timestamp('fechaIngreso')->useCurrent();
            $table->decimal('calificacion', 3, 2)->nullable()->default(null);
            $table->text('comentarios')->nullable();
            $table->integer('id_administrador')->unsigned()->nullable();
            $table->decimal('valor_oferta', 10, 2)->nullable();
            $table->datetime('fecha_inicio_oferta')->nullable();
            $table->datetime('fecha_fin_oferta')->nullable();

            // Relaciones
            $table->foreign('idClaseProducto')->references('idClaseProducto')->on('claseproducto')->onDelete('cascade');
            $table->foreign('idSexoProducto')->references('idSexoProducto')->on('sexoproducto')->onDelete('cascade');
            $table->foreign('idColor')->references('idColor')->on('colorproducto')->onDelete('cascade');
            $table->foreign('idEstadoProducto')->references('idEstadoProducto')->on('estadoproducto')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias_productos')->onDelete('set null');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
