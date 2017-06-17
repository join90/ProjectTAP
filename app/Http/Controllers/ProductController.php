<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        
        $seller = json_decode(Redis::get(session('user')),true);
        
        if(!is_null($seller)){

            $products = Product::where('seller_id','=', $seller['id'])->get();

            if(!is_null($products)){

                foreach ($products as $item){
                
                    Redis::set('P_'.$item->id, json_encode($item));
                    Redis::expire('P_'.$item->id, 3600);
                }

                return response()->json($products);
                 
            }
            
        }    
        
        return null;
    }

    public static function ProductAll(){

        return Product::all();
    }

    
    public function store(Request $request)
    {
    
        $seller = json_decode(Redis::get(session('user')),true);
              
        if(!is_null($seller)){
            
            $input['seller_id'] = $seller['id']; 
            $product = Product::create($input);

            Redis::set('P_'.$product->first()->id, json_encode($product));
            Redis::expire('P_'.$product->first()->id, 3600);
            
            return response()->json($product);  
        }
        
        return null;
    }       
       

    public function show(Request $request, $id)
    {
        
        $seller = json_decode(Redis::get(session('user')),true);
             

        if (!is_null($seller)){

            if(($response = Redis::get('P_'.$id)) != null)
                return json_decode($response, true);
                 
            $product = Product::where('seller_id', '=', $seller['id'])->where('id','=',$id)->get();
                
            if(!is_null($product->first())){
                Redis::set('P_'.$product->first()->id, json_encode($product));
                Redis::expire('P_'.$product->first()->id, 3600); 

                return response()->json($product);    
            }    
                
        }    

        return null;

    }


    public function update(Request $request, $id)
    {
        
        $seller = json_decode(Redis::get(session('user')),true);
        
        if(!is_null($seller)){

            $input['seller_id'] = $seller['id']; 

            Product::where('seller_id', '=', $seller['id'])->where('id','=',$id)->update($input);
            $product = Product::where('seller_id', '=', $seller['id'])->where('id','=',$id)->get();

            Redis::set('P_'.$product->first()->id, json_encode($product));
            Redis::expire('P_'.$product->first()->id, 3600);

            
            return response()->json($product);
                
        }

        return 'null';

    }


    /*public function ShowProductAll(Request $request){ //per i clienti e non i venditori

        
        $products = Product::all();

        foreach ($products as $product) {
            
            Redis::set('P_'.$product->first()->id, json_encode($product));
            Redis::expire('P_'.$product->first()->id, 3600);
            
        }

        return view('layout/frontend/products/products', ['products' => $products]); //Dario
        

    }*/

    
    public function Redix (){ //only for test

        return json_decode(ProductController::GetRedixProduct(),true);
    }

    private function GetRedixProduct(){ //only for test

        return Redis::get('P_2');
    }

    public static function UpdateProductRedis(){

         DB::transaction(function() {
                        
            $products = Product::all();
            
            foreach ($products as $item){

                Redis::set('P_'.$item->id, $item);
                Redis::expire('P_'.$item->id, 3600);
            }
        }); 

    } 
        
}

