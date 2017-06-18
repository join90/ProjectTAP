<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'titolo' => str_random(10),
            'categoria' => str_random(10),
            'marchio' => str_random(10),
            'provenienza' => str_random(10),
            'prezzo' => 2.34,
            'pezzatura' => 2,
            'QuantUnita' => str_random(10),
            'disponibilita' => 3,
            'maturazione' => 2,
            'TipoAgricoltura' => 3,
            'km0' => 0,
            'promozione' => 0,
            'presente' => 1,
            'seller_id' => 34,
        ]);
    }
}
