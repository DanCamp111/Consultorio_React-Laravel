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
        Schema::create('doctores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->unsignedBigInteger('id_especialidades')->nullable();
            $table->string('cedula');
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger("id_user")->nullable();
            $table->timestamps();
            $table->foreign('id_especialidades')
                  ->references('id')
                  ->on('especialidades')
                  ->onDelete('set null'); 
            $table->foreign("id_user")->references("id")->on("users");
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
