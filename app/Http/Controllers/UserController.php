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
         $response = NULL;

         if($request->is('api/v1/mobile/*')){ //api mobile

            /*if(($response = Redis::get('IlTuoToken')) != null)
                return json_decode($response, true);*/
        
            if (!$token = JWTAuth::attempt($input)) {
                return response()->json(['result' => 'wrong email or password.']);
            }
            
            //Redis::set('IlTuoToken', json_encode(['token' => $token]));
            
            return response()->json(['result' => $token]);

         } 

         $user = User::where('email', '=', $input['email'])->get()->first();
           
         
         if(Hash::check($input['password'], $user->password)){

            session(['id_user' => $user->id]);

            return view('welcome');

         }   


         /*$redis->set('user_details', json_encode(array('first_name' => 'Alex', 
                                              'last_name' => 'Richards'
                                              )
                                       )
           );*/
          

          
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
