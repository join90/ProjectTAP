<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function IndexProducts(Request $request){
        
        $products = RedisController::ScanProductsForShop('*P_*'); //restituisce tutti i prodotti 

    
        //return view dario  
    }

    public function GetProductsShop(Request $request, $seller_id){

    	$products = RedisController::ScanProductsForShop('*SP_'.$seller_id.'*'); //restituisce i prodotti filtrati per negozio

    
    	//return view dario
    }

    public function IndexShops(Request $request) 
    {
    
        $shops = RedisController::ScanShopsForUser('*S_*'); //tutti i negozi

        //return view dario;

    }

    public function NameShops(Request $request, $nome){ //filtro in base al nome

        $shops = RedisController::ScanShopsForUser('*S_*');

        $shopsName = array();

        foreach ($shops as $shop) {
            
            if($shop['nomeNegozio'] == $nome)
                $shopsName = array_merge($shopsName, array($shop));
        }

        //return view dario 
    }

    public function CittaShops(Request $request, $citta){

        $shops = RedisController::ScanShopsForUser('*S_*');

        $shopscitta = array();

        foreach ($shops as $shop) {
            
            if($shop['citta'] == $address)
                $shopscitta = array_merge($shopscitta, array($shop));
        }

        //return view dario
    }


    public function GetProductsShopPromo(Request $request, $seller_id){

    	$products = RedisController::ScanProductsForShop('*SP_'.$seller_id.'*'); 

    	$productsPromo = array();

    	foreach ($products as $product) {
    		
    		if(($product['promozione'] == 1) && ($product['presente'] == 1))
    			$productsPromo = array_merge($productsPromo, array($product));
    	}
    	
    	//return view dario
    }

    public function GetProductsShopForDisp(Request $request, $seller_id){

        $products = RedisController::ScanProductsForShop('*SP_'.$seller_id.'*');

        $productsDisp = array();

        foreach ($products as $product) {
            
            if($product['presente'] == 1)
                $productsDisp = array_merge($productsDisp, array($product));
        }

        //return view dario
    }

    public function GetProductsForDisp(Request $request){

        $products = RedisController::ScanProductsForShop('*P_*');

        $productsDisp = array();

        foreach ($products as $product) {
            
            if($product['presente'] == 1)
                $productsDisp = array_merge($productsDisp, array($product));
        }

        // return view dario
    }

    public function GetProductsPromo(Request $request){

        $products = RedisController::ScanProductsForShop('*P_*');
    
        $productsPromo = array();

        foreach ($products as $product) {
            
            if(($product['promozione'] == 1) && ($product['presente'] == 1)){

                $productsPromo = array_merge($productsPromo, array($product));

            }
        }

        //return view dario 

    }

}