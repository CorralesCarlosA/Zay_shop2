<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipooferta', function (Blueprint $table) {
            $table->integer('idTipoOferta')->unsigned()->autoIncrement();
            $table->string('nombreTipo', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipooferta');
    }
};
