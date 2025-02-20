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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->nullable();
            $table->string("ap_paterno")->nullable();
            $table->string("ap_materno")->nullable();
            $table->string("telefono")->nullable();
            $table->unsignedBigInteger("id_user")->nullable();
            $table->timestamps();

            
            $table->foreign("id_user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
