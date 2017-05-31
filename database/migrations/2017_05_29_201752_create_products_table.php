<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titolo');
            $table->string('categoria');
            $table->string('marchio')->length(15)->nullable();
            $table->string('provenienza')->length(20)->nullable();
            $table->float('prezzo')->default(0);
            $table->integer('pezzatura')->length(10)->unsigned()->nullable();
            $table->string('QuantUnita')->length(10);
            $table->integer('disponibilita')->length(10)->unsigned();
            $table->dateTime('dataora');
            $table->integer('maturazione')->length(10)->unsigned()->nullable();
            $table->integer('TipoAgricoltura')->length(10)->unsigned();
            $table->boolean('km0');
            $table->boolean('promozione');
            $table->float('PrezzoVecchio');
            $table->boolean('presente');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('products');
    }
}
