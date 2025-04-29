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
        Schema::create('lectors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->enum('sexo', ['hombre', 'mujer']);
            $table->string('correo', 100)->unique();
            $table->string('celular')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectors');
    }
};
