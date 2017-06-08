<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\seller;
use Illuminate\Support\Facades\Redis;



class SellerController extends Controller
{
    public function update(Request $request){
 
        $bool = NULL; 

        $input = $request->all();
    	
        $seller = json_decode(Redis::get(session('user')),true);

    	if(!is_null($seller)){

            seller::where('id','=',$seller['id'])->update($input);

            $bool = $seller['presente'];
            $seller['presente'] = $input['presente'];
            Redis::set(session('user'), json_encode($seller));
            Redis::expire(session('user'), 3610);

            if($bool != $input['presente'])
                ProductController::UpdateProductAll($seller['id'],$input['presente']);    
            
        }    
        
    }

}
