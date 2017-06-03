<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use JWTAuth;
use App\seller;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        
        $seller = NULL;

        if($request->is('api/v1/mobile/json/*'))
            $seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)->get();
        else
           if(session()->has('id_user')) 
                $seller = seller::where('id_user', '=', session('id_user'))->get();     
            
        if(!isnull($seller->first())){

            $products = Product::where('seller_id','=', $seller->first()->id)->get();

            if(!isnull($products->first())){

                if($request->is('api/v1/mobile/json/*'))    
                    return response()->json($products);          
                
                foreach ($products as $items) {
                    echo 'id: '.$items->id.'<br>';   
                }

                //return view...
            }
            
        }    
        
        return 'null';
    }

    
    public function store(Request $request)
    {
       $seller = NULL;
       $input = NULL;

       if($request->is('api/v1/mobile/json/*')){
            $seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)->get();
            $input = $request->except('token');
        }

        else
            if(session()->has('id_user')){
                $seller = seller::where('id_user', '=', session('id_user'))->get();
                $input = $request->all();
            }
              
        if(!isnull($seller->first())){
            
            $input['seller_id'] = $seller->first()->id; 
            Product::create($input);
        
            if($request->is('api/v1/mobile/json/*'))
                return response()->json(['result' => true]);
    
            if(session()->has('id_user')){
                //return view;
            }   
        }
        
        return 'null';
    }       
       

    public function show(Request $request, $id)
    {
        $seller = NULL;

        if($request->is('api/v1/mobile/json/*'))
            $seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)->get();
            
        else
            if(session()->has('id_user'))
                $seller = seller::where('id_user', '=', session('id_user'))->get();
        

        if (!is_null($seller->first())){
            $product = Product::where('seller_id', '=', $seller->first()->id)->where('id','=',$id)->get();
                
            if(!is_null($product->first())){
                if($request->is('api/v1/mobile/json/*'))
                    return response()->json($product->first());

                //return view;    
            }    
                
        }    

        return 'null';

    }


    public function update(Request $request, $id)
    {
        $seller = NULL;
        $product = NULL;
        $input = NULL;

        if($request->is('api/v1/mobile/json/*')){
            $seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)->get();
            $input = $request->except('token');
        }
            
        else
            if(session()->has('id_user'))
                $seller = seller::where('id_user', '=', session('id_user'))->get();

        if(!is_null($seller->first())){

            $input['seller_id'] = $seller->first()->id; 
            $product = Product::where('seller_id', '=', $seller->first()->id)->where('id','=',$id)->update($input);
        
            if($request->is('api/v1/mobile/json/*'))
                return response()->json(['result'=> true]);

            //return view;
                
        }

        return 'null';

    }
        
}

