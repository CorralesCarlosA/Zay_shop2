<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('clientes', function (Blueprint $table) {
        $table->timestamps();       // Agrega created_at y updated_at
        $table->softDeletes();      // Agrega deleted_at (para soft deletes)
    });
}

public function down()
{
    Schema::table('clientes', function (Blueprint $table) {
        $table->dropTimestamps();
        $table->dropSoftDeletes();
    });
}
};
