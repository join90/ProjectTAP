<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public static function UpdateShopsRedis(){

        DB::transaction(function() {
                        
            $shops = SellerController::AllShops();
            foreach ($shops as $shop) {
                Redis::set('U_'.$shop->user_id.'_S_'.$shop->id, json_encode($shop));
                Redis::expire('U_'.$shop->user_id.'_S_'.$shop->id, 3600);                          
            }
        }); 
    }

    public static function UpdateProductRedis(){

         DB::transaction(function() {
                        
            $products = ProductController::ProductAll();
            
            foreach ($products as $item){

                Redis::set('P_'.$item->id.'SP_'.$item->seller_id, $item);
                Redis::expire('P_'.$item->id.'SP_'.$item->seller_id, 3600);
            }
        }); 

    } 

    public static function ScanShopsForUser ($pattern, $cursor=null, $allResults=array()) 

    {

        // Zero means full iteration
        if ($cursor==="0") {
            $results = array();
            foreach ($allResults as $value) {
                $results = array_merge($results, array(json_decode(Redis::get($value),true)));

            }
            return $results;
        }

        // No $cursor means init
        if ($cursor===null) {
            $cursor = "0";
        }

        // The call
        $result = Redis::scan($cursor, 'match', $pattern);

        // Append results to array
        $allResults = array_merge($allResults, $result[1]);

        // Recursive call until cursor is 0
        return RedisController::ScanShopsForUser($pattern, $result[0], $allResults);
    }


    public static function ScanProductsForShop ($pattern, $cursor=null, $allResults=array()) 

    {

        // Zero means full iteration
        if ($cursor==="0") {
            $results = array();
            foreach ($allResults as $value) {
                $results = array_merge($results, array(json_decode(Redis::get($value),true)));
            }
            return $results;
        }

        // No $cursor means init
        if ($cursor===null) {
            $cursor = "0";
        }

        // The call
        $result = Redis::scan($cursor, 'match', $pattern);

        // Append results to array
        $allResults = array_merge($allResults, $result[1]);

        // Recursive call until cursor is 0
        return RedisController::ScanProductsForShop($pattern, $result[0], $allResults);
    }
}
