<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UpdateProduct;
use App\seller;
use JWTAuth;

class SellerController extends Controller
{
    public function update(Request $request, $id ){

    	$seller = NULL;
    	$input = NULL;
    	
    	if($request->is('api/v1/mobile/json/*')){
    		$input = $request->except('token');
    		$seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)
    						->where('id', '=', $id)->get();
    	}

    	else{
    		if(session()->has('id_user'))
				$seller = seller::where('id_user', '=', session('id_user'))->where('id','=', $id)->get();    			
    		$input = $request->all();
    	}

    	if(!is_null($seller->first())) {

    		seller::where('id','=',$id)->update($input);

    		if(($seller->first()->presente) != $input['presente'])
    			event(new UpdateProduct($id, $input['presente']));
    	}

    	

    }
}
