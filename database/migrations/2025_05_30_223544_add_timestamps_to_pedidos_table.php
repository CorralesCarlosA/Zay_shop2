<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->timestamp('created_at')->nullable()->after('factura_generada');
        $table->timestamp('updated_at')->nullable()->after('created_at');
    });
    
    // Para datos existentes, usar fecha_pedido como created_at
    DB::statement('UPDATE pedidos SET created_at = fecha_pedido');
}

public function down()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropColumn(['created_at', 'updated_at']);                              
    });
}
};
