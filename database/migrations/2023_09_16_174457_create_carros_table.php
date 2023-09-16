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
        Schema::create('carros', function (Blueprint $table) {
            $table->string('vin', 17)->primary();
            $table->integer('num_modelo');
            $table->string('placa', 10)->unique();
            $table->boolean('disponivel');
            $table->integer('km');
            $table->timestamps();
            $table->softDeletes();

            // Foreign Key
            $table->foreign('num_modelo')->references('num_modelo')->on('modelos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carros', function (Blueprint $table) {
            $table->dropForeign('carros_num_modelo_foreign');
        });

        Schema::dropIfExists('carros');
    }
};
