<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf_cliente', 11);
            $table->string('vin_carro', 17);
            $table->dateTime('data_inicio_periodo');
            $table->dateTime('data_final_previsto_periodo');
            $table->dateTime('data_final_realizado_periodo')->nullable();
            $table->float('valor_diaria', 8, 2);
            $table->integer('km_inicial');
            $table->integer('km_final')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign Key
            $table->foreign('cpf_cliente')->references('cpf')->on('clientes');
            $table->foreign('vin_carro')->references('vin')->on('carros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locacoes', function (Blueprint $table) {
            $table->dropForeign('locacoes_cpf_cliente_foreign');
            $table->dropForeign('locacoes_vin_carro_foreign');
        });

        Schema::dropIfExists('locacoes');
    }
};