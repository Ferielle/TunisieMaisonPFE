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
        Schema::table('immeubles', function (Blueprint $table) {
            $table->boolean('heating')->default(false)->change();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immeubles', function (Blueprint $table) {
            $table->boolean('heating')->change();  // If you want to revert the change

        });
    }
};
