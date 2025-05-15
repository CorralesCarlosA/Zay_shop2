<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estadoproducto', function (Blueprint $table) {
            $table->integer('idEstadoProducto')->unsigned()->autoIncrement();
            $table->string('estado', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estadoproducto');
    }
};
