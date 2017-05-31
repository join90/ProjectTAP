<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCognomeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cognome')->after('nome');
            $table->string('comune')->after('cognome');
            $table->string('ViaPiazza')->after('comune');
            $table->string('ncivico')->after('ViaPiazza');
            $table->string('telefono')->nullable()->after('ncivico');
            $table->tinyInteger('presente')->after('telefono');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cognome');
            $table->dropColumn('comune');
            $table->dropColumn('ViaPiazza');
            $table->dropColumn('ncivico');
            $table->dropColumn('telefono');
            $table->dropColumn('presente');

        });
    }
}
