<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;


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

         if($request->is('api/v1/mobile/*')){ //api mobile

            if (!$token = JWTAuth::attempt($input)) {
                return response()->json(['result' => 'wrong email or password.']);
            }
            
            return response()->json(['token' => $token]);

         } 

         $user = User::where('email', '=', $input['email'])->get()->first();
         
         if(Hash::check($input['password'], $user->password)){

            session(['id_user' => $user->id]);

            return view('welcome');

         }   
    }
   
    public function get_user_details(Request $request)
    {
        $input = $request->all();
        
        if($request->is('api/v1/mobile/json*')){
            $user = JWTAuth::toUser($input['token']);
            return response()->json(['result' => $user]);    
        }

        if(session()->has('id_user')){

            return response()->json(User::find(session('id_user')));  //return view...
        }

        
    }

    public function update(Request $request, $id){

        $user = NULL;
        $input = NULL;

        if($request->is('api/v1/mobile/json*'))
            if($id == JWTAuth::toUser($request->input('token'))->id)
                $input = $request->except('token');

        if(session()->has('id_user'))
            if($id == session('id_user'))
                $input = $request->all();

        if(!is_null($input)){
            $input['password'] = Hash::make($input['password']);
            $user = User::where('id', '=', $id)->update($input);
        }

        if(!is_null($user))
            if($request->is('api/v1/mobile/json*'))
                return response()->json(['result' => true]);

            //return view    
        return 'null';
    }
   
}
