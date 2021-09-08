<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento',10);
            $table->unsignedBigInteger('num_documento')->unique();
            $table->string('nombre',100);
            $table->string('telefono', 13)->nullable();
            $table->string('direccion', 45)->nullable();
        });

        //SAGL
        DB::table('clientes')->insert(
            array(
                'tipo_documento' => 'CC',
                'num_documento' => '1075123456',
                'nombre' => 'PEPITO JOSE PEREZ PEREZ',
                'telefono' => '873123456',
                'direccion' => 'Calle 123 #13-12',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
