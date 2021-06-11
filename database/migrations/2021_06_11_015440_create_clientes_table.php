<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->boolean('ativo')->default(false);
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('telefone');
            $table->enum('estado', ['AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RO', 'RS', 'RR', 'SC', 'SE', 'SP', 'TO']);
            $table->string('cidade');
            $table->date('data_nascimento')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('criado_em')->useCurrent()->nullable();
            $table->timestamp('atualizado_em')->useCurrentOnUpdate()->nullable();
        });
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
