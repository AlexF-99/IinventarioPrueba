<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cantidad');

            $table->foreignId('id_factura')
                ->references('id')
                ->on('facturas')->onDelete('cascade');;

            $table->foreignId('id_inventario')
                ->references('id')
                ->on('inventario')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_factura');
    }
}
