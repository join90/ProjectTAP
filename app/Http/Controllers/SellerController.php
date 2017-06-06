<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UpdateProduct;
use App\seller;
use JWTAuth;
use Illuminate\Support\Facades\Redis;


class SellerController extends Controller
{
    public function update(Request $request, $id ){

    	$seller = NULL;
    	$input = NULL;
    	$user_id = NULL; 

    	if($request->is('api/v1/mobile/json/*')){
    		$input = $request->except('token');
            $user_id = JWTAuth::toUser($request->input('token'))->id;

    		/*$seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)
    						->where('id', '=', $id)->get();*/
            $seller = json_decode(Redis::get($user_id),true);                
    	}

    	else{
    		
            if(session()->has('user')){
                $user_id = session('user');
				$seller = json_decode(Redis::get($user_id),true);    			
            }
    		
            $input = $request->all();
    	}

    	if(!is_null($seller)) {

    		seller::where('id','=',$seller['id'])->update($input);

            Redis::set($user_id, json_encode($seller));
            Redis::expire($user_id, 3610);

            if(($seller['presente']) != $input['presente'])
    			event(new UpdateProduct($id, $input['presente']));
    	}

    	

    }
}
