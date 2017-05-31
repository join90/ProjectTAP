<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_product_presente AFTER UPDATE ON `users` FOR EACH ROW
            BEGIN
                IF (OLD.presente <> NEW.presente) THEN
                    UPDATE products SET products.presente = NEW.presente WHERE products.user_id = NEW.id;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `update_product_presente`');
    }
}
