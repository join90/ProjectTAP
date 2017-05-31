<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use JWTAuth;
use App\seller;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        
        return respose()->json([Product::all()]);
    }

    
    public function store(Request $request)
    {
       
       $seller = seller::where('id_user', '=', JWTAuth::toUser($request->input('token'))->id)->get();
       
       $input = $request->except('token');
       
       $input['seller_id'] = $seller->first()->id;

       return response()->json(Product::create($input));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

