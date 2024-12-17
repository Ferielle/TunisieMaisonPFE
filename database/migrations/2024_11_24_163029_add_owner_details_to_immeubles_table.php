<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOwnerDetailsToImmeublesTable extends Migration
{
    public function up()
    {
        Schema::table('immeubles', function (Blueprint $table) {
            $table->string('owner_phone', 20)->nullable(); // Owner's phone number
            $table->string('owner_name', 255)->nullable(); // Owner's name
            $table->string('owner_prename', 255)->nullable(); // Owner's prename (surname)
        });
    }

    public function down()
    {
        Schema::table('immeubles', function (Blueprint $table) {
            $table->dropColumn(['owner_phone', 'owner_name', 'owner_prename']);
        });
    }
}
