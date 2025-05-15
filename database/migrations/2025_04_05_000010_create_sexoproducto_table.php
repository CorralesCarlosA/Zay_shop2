<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sexoproducto', function (Blueprint $table) {
            $table->integer('idSexoProducto')->unsigned()->autoIncrement();
            $table->enum('sexo', ['Masculino', 'Femenino', 'Unisex']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sexoproducto');
    }
};
