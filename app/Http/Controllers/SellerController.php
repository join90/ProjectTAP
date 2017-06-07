<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\seller;
use JWTAuth;
use Illuminate\Support\Facades\Redis;



class SellerController extends Controller
{
    public function update(Request $request){

    	$seller = NULL;
    	$input = NULL;
    	$user_id = NULL; 
        $bool = NULL;

    	if($request->is('api/v1/mobile/json/*')){
    		$input = $request->except('token');
            $user_id = JWTAuth::toUser($request->input('token'))->id;
    	}

    	else{
            
            if(session()->has('user'))
                $user_id = session('user');    	

            $input = $request->all();
    	}

        $seller = json_decode(Redis::get($user_id),true);

    	if(!is_null($seller)){

            seller::where('id','=',$seller['id'])->update($input);

            $bool = $seller['presente'];
            $seller['presente'] = $input['presente'];
            Redis::set($user_id, json_encode($seller));
            Redis::expire($user_id, 3610);

            if($bool != $input['presente'])
                ProductController::UpdateProductAll($seller['id'],$input['presente']);    
            
        }    
        
    }

}
