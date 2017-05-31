<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCognomeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cognome')->nullable()->change();
            $table->boolean('presente')->after('password')->change();
            $table->boolean('domicilio')->change();
            
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->string('cellulare')->nullable()->after('telefono');
        $table->string('GiorniSettimanaApertura')->nullable()->after('cellulare');
        $table->string('OrariApertura')->nullable()->after('GiorniSettimanaApertura');
        $table->tinyInteger('domicilio')->nullable()->after('OrariApertura');
        $table->float('CostoDomicilio')->nullable()->after('domicilio');
        $table->string('ImgProfilo')->nullable()->after('CostoDomicilio');
        $table->float('valutazione')->default(0)->after('ImgProfilo');
        $table->float('latitudine',10,7)->nullable()->after('valutazione');
        $table->float('longitudine',10,7)->nullable()->after('latitudine');
    }
}