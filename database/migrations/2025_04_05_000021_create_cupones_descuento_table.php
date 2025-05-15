<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cupones_descuento', function (Blueprint $table) {
            $table->integer('id_cupon')->unsigned()->autoIncrement();
            $table->string('nombre_cupon', 50);
            $table->string('codigo_cupon', 50)->unique();
            $table->enum('tipo_descuento', ['Porcentaje', 'Valor fijo']);
            $table->decimal('valor', 10, 2);
            $table->date('fecha_expiracion');
            $table->boolean('activo')->default(true);
            $table->integer('cantidad_productos_minimos')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cupones_descuento');
    }
};
