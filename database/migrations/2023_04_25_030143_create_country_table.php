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
        Schema::create('country', function (Blueprint $table) {
            $table->id();
            $table->string('iso_code')->uniqued();
            $table->string('name');
            $table->string('capital');
            $table->string('phone_code');
            $table->string('currency_iso_code')->uniqued();
            $table->string('src_flag');
            $table->string('continent_iso_code')->uniqued();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country');
    }
};
