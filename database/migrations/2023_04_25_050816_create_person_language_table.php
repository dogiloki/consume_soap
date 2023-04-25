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
        Schema::create('person_language', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_person');
            $table->unsignedBigInteger('id_language');
            $table->integer('level');
            $table->timestamps();
            $table->foreign('id_person')->references('id')->on('person');
            $table->foreign('id_language')->references('id')->on('language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_language');
    }
};
