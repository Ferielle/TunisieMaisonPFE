<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class test extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Ajoutez la clé étrangère
            $table->foreign('immeuble_id')
                  ->references('id') // référence à la colonne 'id' de la table 'immeubles'
                  ->on('immeubles')  // table de référence
                  ->onDelete('cascade'); // Action en cas de suppression (cascade, ici la suppression de la réservation si l'immeuble est supprimé)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimez la clé étrangère
            $table->dropForeign(['immeuble_id']);
        });
    }
}
