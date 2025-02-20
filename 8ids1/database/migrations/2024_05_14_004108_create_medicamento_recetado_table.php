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
        Schema::create('medicamento_recetado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_cita");
            $table->unsignedBigInteger("id_medicamento");
            $table->string('cantidad');
            $table->string('unidad');
            $table->string('cada_cuanto');
            $table->integer('dias');
            $table->timestamps();

            $table->foreign("id_cita")->references("id")->on("citas");
            $table->foreign("id_medicamento")->references("id")->on("medicamentos");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamento_recetado');
    }
};
