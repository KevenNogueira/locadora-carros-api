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
        Schema::create('modelos', function (Blueprint $table) {
            $table->integer('num_modelo')->primary();
            $table->string('cnpj_marca', 14);
            $table->string('nom_marca', 50);
            $table->string('imagem', 100);
            $table->integer('num_porta');
            $table->integer('num_assento');
            $table->boolean('air_bag');
            $table->boolean('abs');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key
            $table->foreign('cnpj_marca')->references('cnpj')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelos', function (Blueprint $table) {
            $table->dropForeign('modelos_cnpj_marca_foreign');
        });

        Schema::dropIfExists('modelos');
    }
};
