<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Product;

class ApiController extends Controller
{
    public function IndexProducts(Request $request){
        
        $products = RedisController::ScanProductsForShop('*P_*'); //restituisce tutti i prodotti 
        /*$products = Product::select('*')                            
                            ->get();
        var_dump($products);*/
        foreach ($products as &$product) {
            //dd($shop->imgProfilo);
            //dd($product['imgProfilo']);
            //$product['blob'] = BlobController::downloadBlob('prodotti',$product['imgProfilo']);
            $product['blob'] = BlobController::downloadBlob('prodotti',$product['imgProfilo']);
            //dd($product['blob']);
            //dd($products);
            //var_dump($product['imgProfilo']);
            //echo BlobController::downloadBlob('prodotti',$product['imgProfilo']);
            //var_dump(BlobController::downloadBlob('prodotti',$product['imgProfilo']));    
        }
            //dd($products);
        return view('layout/frontend/products/products', ['products' => $products, 'seller_id' => 0]); //Dario 
    }
 

    public function ShowCart(Request $request){ //Dario
        
        $products = RedisController::ScanProductsForShop('*P_*'); //restituisce tutti i prodotti         

        return view('layout/frontend/users/cart', ['products' => $products]); //Dario
    }

    public function GetProductsShop(Request $request, $seller_id){

    	$products = RedisController::ScanProductsForShop('*SP_'.$seller_id.'*'); //restituisce i prodotti filtrati per negozio

        
        foreach ($products as &$product) {
            $product['blob'] = BlobController::downloadBlob('prodotti',$product['imgProfilo']);
        }
        return view('layout/frontend/products/products', ['products' => $products, 'seller_id' => $seller_id]); //Dario    	
    }

    public function IndexShops(Request $request) 
    {
    
        $shops = RedisController::ScanShopsForUser('*S_*'); //tutti i negozi

        return $shops;

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


    public function GetMakersShops(Request $request){

        $shops = RedisController::ScanShopsForUser('*S_*'); //tutti i negozi

        $makers = [];

        foreach ($shops as $shop) {
            
            $makers = array_merge($makers, [array($shop['latitudine'], $shop['longitudine'],  $shop['id'], $shop['nomeNegozio'])]);
        }

        //dd($makers);    
        return view('layout.frontend.shops.maker', ['makers' => $makers] );

    }

}
