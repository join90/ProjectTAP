<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller

{
   
    public function register(Request $request)
    {   
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);

        return UserController::login($request);
        
    }
   
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $user = NULL;
        $seller = NULL;
 
        $user = User::where('email', '=', $input['email'])->get()->first();
            
        if(!Hash::check($input['password'], $user->password))
            return 'email o password errati';
       
        session(['user' => $user->id]);

        if($user->venditore == 1){
            $seller = User::join('sellers','sellers.id_user','=','users.id')->where('users.id','=',$user->id)->get()->first(); 
        
            Redis::set($user->id, json_encode($seller));
            Redis::expire($user->id, 3610); 
            
            return response()->json($seller);
        }
        
        Redis::set($user->id, json_encode($user));
        Redis::expire($user->id, 3610);

        return response()->json($user);
        
    }
   
    
    public function get_user_details(Request $request)
    {
        
        if(session()->has('user')){
            if(($response = Redis::get(session('user'))) != null)
                return json_decode($response, true);
        }

        return null;     
        
    }

    public function update(Request $request, $id){

        $user = NULL;
        $input = NULL;
        $seller = NULL;


        if(session()->has('user'))
            if($id == session('user'))
                $input = $request->all();

        if(!is_null($input)){

            $input['password'] = Hash::make($input['password']);
            $user = User::where('id', '=', $id)->update($input);

            if($user->venditore == 1){
                $seller = User::join('sellers','sellers.id_user','=','users.id')->where('users.id','=',$user->id)->get()->first(); 
        
                Redis::set($user->id, json_encode($seller)); 
                Redis::expire($user->id, 3610);    
                return response()->json($seller);
            }
                
            
            Redis::set($user->id, json_encode($user));    
            Redis::expire($user->id, 3610);    
            return response()->json($user);

        }

        return null;

    }
   
}
