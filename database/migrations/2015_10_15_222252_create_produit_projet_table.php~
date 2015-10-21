<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_projet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_projet');
            $table->foreign('id_projet')->references('id')->on('projets')->onDelete('cascade');
            $table->unsignedInteger('id_produit');
            $table->foreign('id_produit')->references('id')->on('produits')->onDelete('cascade');
            $table->integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produit_projet');
    }
}
