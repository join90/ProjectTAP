<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use JWTAuth;
use App\seller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Events\UpdateProduct;


class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        
        $seller = NULL;

        if($request->is('api/v1/mobile/json/*'))
            $seller = json_decode(Redis::get(JWTAuth::toUser($request->input('token'))->id),true);
        else
           if(session()->has('user')) 
                $seller = json_decode(Redis::get(session('user')),true);     
    
    
        if(!is_null($seller)){

            $products = Product::where('seller_id','=', $seller['id'])->get();

            if(!is_null($products->first())){

                Redis::set('P_'.$products->first()->id, json_encode($products));
                Redis::expire('P_'.$products->first()->id, 3600); 

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
            $seller = json_decode(Redis::get(JWTAuth::toUser($request->input('token'))->id),true);
            $input = $request->except('token');
        }

        else
            if(session()->has('user')){
                $seller = json_decode(Redis::get(session('user')),true);
                $input = $request->all();
            }
              
        if(!is_null($seller)){
            
            $input['seller_id'] = $seller['id']; 
            $product = Product::create($input);

            Redis::set('P_'.$product->first()->id, json_encode($product));
            Redis::expire('P_'.$product->first()->id, 3600);
        
            if($request->is('api/v1/mobile/json/*'))
                return response()->json(['result' => true]);
    
            if(session()->has('user')){
                //return view;
            }   
        }
        
        return 'null';
    }       
       

    public function show(Request $request, $id)
    {
        $seller = NULL;
        $product = NULL;

        if($request->is('api/v1/mobile/json/*'))
            $seller = json_decode(Redis::get(JWTAuth::toUser($request->input('token'))->id),true);
            
        else
            if(session()->has('user'))
               $seller = json_decode(Redis::get(session('user')),true);
        

        if (!is_null($seller)){

            if(($response = Redis::get('P_'.$id) != null)){
                //dd('sono qui');
                return json_decode($response, true);
            }
                
            $product = Product::where('seller_id', '=', $seller['id'])->where('id','=',$id)->get();
            dd($product);    
            if(!is_null($product->first())){
                Redis::set('P_'.$product->first()->id, json_encode($product));
                Redis::expire('P_'.$product->first()->id, 3600); 

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
            $seller = json_decode(Redis::get(JWTAuth::toUser($request->input('token'))->id),true);
            $input = $request->except('token');
        }
            
        else
            if(session()->has('user'))
                $seller = json_decode(Redis::get(session('user')),true);

        if(!is_null($seller)){

            $input['seller_id'] = $seller['id']; 

            $product = Product::where('seller_id', '=', $seller['id'])->where('id','=',$id)->update($input);
            
            Redis::set('P_'.$product->first()->id, json_encode($product));
            Redis::expire('P_'.$product->first()->id, 3600);

            if($request->is('api/v1/mobile/json/*'))
                return response()->json(['result'=> true]);

            //return view;
                
        }

        return 'null';

    }


    public function ShowProductAll(Request $request){ //per i clienti e non i venditori

        $input = NULL;
        $user = NULL;

        if($request->is('api/v1/mobile/json/*')){
            $user = json_decode(Redis::get(JWTAuth::toUser($request->input('token'))->id),true);
            return response()->json(Product::all());
        }
            
        else
            if(session()->has('user')){
                //return view...
                
            }

    }

    public static function UpdateProductAll($id, $bool){

       
        DB::transaction(function() use ($id, $bool) {
                        
            Product::where('seller_id', '=', $id)->update(['presente' => $bool]);
            $productS = Product::where('seller_id','=',$id)->get();

            foreach ($productS as $item){
                //event(new UpdateProduct($item));
                Redis::set('P_'.$item->id, json_encode($item));
                Redis::expire('P_'.$item->id, 3600);
            }
        }); 
        
        
    }

    
    public function Redix (){

        return json_decode(ProductController::GetRedixProduct(),true);
    }

    private function GetRedixProduct(){

        return Redis::get('P_2');
    }
        
}

