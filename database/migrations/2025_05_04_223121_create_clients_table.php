<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('nombres', 50)->comment('Asegúrese que sea el nombre que aparece en su identificación');
            $table->string('apellidos', 50)->comment('Asegúrese que sean los apellidos de su identificación');
            $table->enum('tipo_identificacion', [
                'Cedula de ciudadania (CC)',
                'Tarjeta de identidad (TI)',
                'NIT'
            ])->default('Cedula de ciudadania (CC)');
            $table->string('n_identificacion', 10)->primary();
            $table->string('correoE', 150)->unique();
            $table->enum('tipo_cliente', ['Oro', 'Plata', 'Bronce', 'Hierro'])->default('Hierro');
            $table->string('n_telefono', 10);
            $table->string('Direccion_recidencia', 255);
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro']);
            $table->decimal('estatura_m', 3, 2)->nullable()->after('sexo')->comment('Estatura en metros (opcional)');
            $table->string('password', 255);
            $table->unsignedInteger('ciudad');
            $table->unsignedInteger('id_administrador')->nullable();
            $table->tinyInteger('estado_cliente')->default(1);
            $table->timestamp('fecha_registro')->useCurrent();

            // Llaves foráneas
            $table->foreign('ciudad')
                ->references('id_ciudad')
                ->on('ciudades')
                ->onDelete('cascade');

            $table->foreign('id_administrador')
                ->references('id_administrador')
                ->on('administradores')
                ->onDelete('set null');
        });

        // Índices adicionales
        Schema::table('clientes', function (Blueprint $table) {
            $table->index('ciudad');
            $table->index('id_administrador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};