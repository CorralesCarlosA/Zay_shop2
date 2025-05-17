<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->datetime('email_verified_at')->nullable()->after('correoE');
        });
        Schema::create('clientes', function (Blueprint $table) {
            $table->string('n_identificacion', 10)->primary();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->enum('tipo_identificacion', [
                'Cedula de ciudadania (CC)',
                'Tarjeta de identidad (TI)',
                'NIT'

            ])->default('Cedula de ciudadania (CC)');
            $table->string('correoE', 150)->unique();
            $table->enum('tipo_cliente', ['Oro', 'Plata', 'Bronce', 'Hierro'])->default('Hierro');
            $table->string('n_telefono', 10);
            $table->string('Direccion_recidencia', 255);
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro']);
            $table->decimal('estatura_m', 3, 2)->nullable();
            $table->string('password');
            $table->integer('ciudad')->unsigned(); // ID de ciudades
            $table->integer('id_administrador')->unsigned()->nullable(); // FK admin
            $table->tinyInteger('estado_cliente')->default(1); // 1 = activo, 0 = inactivo
            $table->timestamp('fecha_registro')->useCurrent();

            // Llaves foráneas
            $table->foreign('ciudad')->references('id_ciudad')->on('ciudades')->onDelete('cascade');
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
        });
    }
}
