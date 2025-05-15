<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificaciones_admins', function (Blueprint $table) {
            $table->integer('id_notificacion')->unsigned()->autoIncrement();
            $table->text('mensaje');
            $table->tinyInteger('leido')->default(0);
            $table->datetime('fecha_creacion')->useCurrent();
            $table->unsignedInteger('id_administrador')->nullable();

            // Relaciones
            $table->foreign('id_administrador')->references('id_administrador')->on('administradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones_admins');
    }
};
