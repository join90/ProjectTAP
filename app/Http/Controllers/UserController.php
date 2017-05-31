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
        User::create($input);
        return response()->json(['result'=>true]);

    }
   
    public function login(Request $request)
    {
         $input = $request->all();     

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['result' => 'wrong email or password.']);
        }
            
           return response()->json(['token' => $token]);
    }
   
    public function get_user_details(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $user]);
    }



    public function getall(Request $request){

        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);

        return response()->json(User::all());

    }

   
}
