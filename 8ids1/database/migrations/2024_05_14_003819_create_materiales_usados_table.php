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
        Schema::create('materiales_usados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_cita");
            $table->unsignedBigInteger("id_material");
            $table->string('cantidad');
            $table->string('unidad');
            $table->timestamps();

            $table->foreign("id_cita")->references("id")->on("citas");
            $table->foreign("id_material")->references("id")->on("materiales");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales_usados');
    }
};
