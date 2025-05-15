<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->integer('id_administrador')->primary()->unsigned();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('correoE', 150)->unique();
            $table->string('password', 255);
            $table->timestamp('fecha_registro')->useCurrent();
            $table->tinyInteger('estado_administrador')->default(1);
            $table->string('n_identificacion', 10)->unique();
        });

        // Agregar índice único personalizado si es necesario
        Schema::table('administradores', function (Blueprint $table) {
            $table->index('n_identificacion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administradores');
    }
};
