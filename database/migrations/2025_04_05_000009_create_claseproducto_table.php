<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claseproducto', function (Blueprint $table) {
            $table->integer('idClaseProducto')->unsigned()->autoIncrement();
            $table->string('clase', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claseproducto');
    }
};
