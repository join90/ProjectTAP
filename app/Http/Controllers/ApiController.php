<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function IndexProducts(Request $request){
        
        $products = RedisController::ScanProductsForShop('*P_*'); //restituisce tutti i prodotti dei negozi
    
        //return view dario 
    }

    public function GetProductsShop(Request $request, $seller_id){

    	$products = RedisController::ScanProductsForShop('*SP_'.$seller_id.'*'); //restituisce i prodotti filtrati per negozio
    	
    	//return view dario
    }

    public function IndexShops(Request $request) 
    {
    
        $shops = RedisController::ScanShopsForUser('*S_*'); //tutti i negozi

        //return view dario

    }

    public function GetProductsShopPromo(Request $request, $seller_id){

    	$products = RedisController::ScanProductsForShop('*SP_'.$seller_id.'*'); 

    	$productsPromo = array();

    	foreach ($products as $product) {
    		
    		if($product['promozione'] == 1)
    			$productsPromo = array_merge($productsPromo, $product);
    	}
    	
    	//return view dario
    }

    public function GetProductsFordisp(Request $request){

        $products = RedisController::ScanProductsForShop('*P_*');

        $productsDisp = array();

        foreach ($products as $product) {
            
            if($product['disponibilita'] == 1)
                $productsDisp = array_merge($productsDisp, $product);
        }

        // return view dario
    }

}
