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
        Schema::table('kitchen_orders', function (Blueprint $table) {
            // Remover a restrição de chave estrangeira existente
            $table->dropForeign(['order_id']);

            // Adicionar uma nova restrição de chave estrangeira com ON DELETE CASCADE
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('kitchen_orders', function (Blueprint $table) {
            // Remover a nova restrição de chave estrangeira
            $table->dropForeign(['order_id']);

            // Adicionar a restrição de chave estrangeira anterior
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }
};
