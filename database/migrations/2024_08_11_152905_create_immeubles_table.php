<!--<?php

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
        Schema::create('immeubles', function (Blueprint $table) {
            $table->id();
    $table->string('name')->nullable();
    $table->string('address')->nullable();
    $table->integer('price')->nullable();
    $table->string('description')->nullable();
    $table->string('picture')->nullable();
    $table->timestamps();
    $table->string('ville')->nullable();
    $table->boolean('heating')->default(false)->change();
    $table->boolean('air_conditioning')->default(false)->change();
    $table->string('status')->default('available'); // 'available' or 'reserved'

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immeubles');
    }
};
