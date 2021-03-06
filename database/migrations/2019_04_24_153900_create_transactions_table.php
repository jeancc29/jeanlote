<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idTipo'); //Tipo de transaccion
            $table->unsignedInteger('idUsuario');
            $table->unsignedInteger('idTipoEntidad1'); //Tipo de entidad, osea, si es una banca, sisteama, entidad, etc..
            $table->unsignedInteger('idTipoEntidad2');
            $table->unsignedInteger('idEntidad1');
            $table->unsignedInteger('idEntidad2');
            $table->decimal('entidad1_saldo_inicial', 20, 2)->default(0);
            $table->decimal('entidad2_saldo_inicial', 20, 2)->default(0);
            $table->decimal('debito', 20, 2)->default(0);
            $table->decimal('credito', 20, 2)->default(0);
            $table->decimal('entidad1_saldo_final', 20, 2)->default(0);
            $table->decimal('entidad2_saldo_final', 20, 2)->default(0);
            $table->string('nota')->nullable();
            $table->string('nota_grupo')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedInteger('idGasto')->nullable(); //Cuando la transaccion sea un gasto automatico  este campo guardara el id del gasto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
