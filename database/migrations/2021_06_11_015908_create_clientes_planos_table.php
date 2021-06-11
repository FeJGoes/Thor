<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesPlanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_planos', function (Blueprint $table) {
            $table->foreignId('cliente_id')->constrained('clientes')->onDeleteCascade();
            $table->foreignId('plano_id')->constrained('planos')->onDeleteRestrict();
            $table->timestamp('criado_em')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_planos');
    }
}
