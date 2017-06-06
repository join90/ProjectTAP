<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller

{
   
    public function register(Request $request)
    {   
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);

        if($request->is('api/v1/mobile/*')){
            return response()->json(['result'=>true]);    
        }
        
        //return view....
    }
   
    public function login(Request $request)
    {
         $input = $request->all();
         $user = NULL;
         $seller = NULL;

         if($request->is('api/v1/mobile/*')){ //api mobile
        
            if (!$token = JWTAuth::attempt($input)) 
                return response()->json(['result' => 'wrong email or password.']);

            $user = User::find(JWTAuth::toUser($token)->id)->get()->first();
        }
        
        else{
            
            $user = User::where('email', '=', $input['email'])->get()->first();
            
            if(!Hash::check($input['password'], $user->password))
                return 'email o password errati';
        }
            
        if($user->venditore == 1){
            $seller = User::join('sellers','sellers.id_user','=','users.id')->where('users.id','=',$user->id)->get()->first(); 
        
            Redis::set($user->id, json_encode($seller));
            Redis::expire($user->id, 3610); 
        }
        else{
            Redis::set($user->id, json_encode($user));
            Redis::expire($user->id, 3610);    
        }
        
        if($request->is('api/v1/mobile/*'))
            return response()->json(['result' => $token]);
          
        session(['user' => $user->id]);
        return view('welcome');
    }
   
    
    public function get_user_details(Request $request)
    {
        $input = $request->all();
        
        if($request->is('api/v1/mobile/json*')){
            if(($response = Redis::get(JWTAuth::toUser($input['token'])->id)) != null)
                return json_decode($response, true);
        }

        if(session()->has('user')){

            if(($response = Redis::get(session('user')) != null))
                return json_decode($response, true);
        }     
        
    }

    public function update(Request $request, $id){

        $user = NULL;
        $input = NULL;
        $seller = NULL;

        if($request->is('api/v1/mobile/json*'))
            if($id == JWTAuth::toUser($request->input('token'))->id)
                $input = $request->except('token');

        if(session()->has('id_user'))
            if($id == session('id_user'))
                $input = $request->all();

        if(!is_null($input)){
            $input['password'] = Hash::make($input['password']);
            $user = User::where('id', '=', $id)->update($input);

            if($user->venditore == 1){
                $seller = User::join('sellers','sellers.id_user','=','users.id')->where('users.id','=',$user->id)->get()->first(); 
        
                Redis::set($user->id, json_encode($seller)); 
            }
            else{
                
                Redis::set($user->id, json_encode($user));    
            }

        }

        if(!is_null($user))
            if($request->is('api/v1/mobile/json*'))
                return response()->json(['result' => true]);

            //return view    
        return 'null';
    }
   
}
