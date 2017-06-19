<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

class ProductController extends Controller
{
    
    public function index() 
    {
        
        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.id')
                            ->select('products.*', 'sellers.nomeNegozio')
                            ->where('sellers.user_id', $this->getAuthUserId())
                            ->get();

        return view('layout.backend.products.index', ['products' => $products]);

    }

    public function create() 
    {
        
        return view('layout.backend.products.create', ['shops' => SellerController::getShopsForSelect()]);

    }

    public function store(Request $request)
    {
        // regole validazione del form
        $rules = array(
            'titolo' => 'required',
            'categoria' => 'required',
            'marchio' => 'required',
            'provenienza' => 'required',
            'prezzo' => 'required|numeric',
            'QuantUnita' => 'required',
            'disponibilita' => 'required|numeric',
            'seller_id' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // controllo se il checkbox è stato cliccato
        if($request->has('presente')) {
            $request->presente = 1;
        }
        else{
            $request->presente = 0;
        }

        // controllo se l'utente ha caricato l'immagine del profilo
        if ($request->hasFile('imgProfilo')) {
            if ($request->file('imgProfilo')->isValid()) {
                $folder = 'uploads';
                $file = $request->imgProfilo->store($folder);
            }
        }

        // errore nella validazione
        if ($validator->fails()) {
            return Redirect::to('/admin/products/new')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            // validazione ok, salvo sul database
            $product = new Product;
            $product->titolo = $request->titolo;
            $product->seller_id = $request->seller_id;
            $product->categoria = $request->categoria;
            $product->marchio = $request->marchio;
            $product->provenienza = $request->provenienza;
            $product->prezzo = $request->prezzo;
            $product->QuantUnita = $request->QuantUnita;
            $product->disponibilita = $request->disponibilita;
            $product->PrezzoVecchio = $request->PrezzoVecchio;
            if(isset($file)){
                $product->imgProfilo = $file;
            }
            $product->save();

            Session::flash('message', 'Successfully created product!');
            return Redirect::to('/admin/products');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('layout.backend.products.edit', ['product' => $product, 'shops' => SellerController::getShopsForSelect()]);
    }


    public function update(Request $request, $id)
    {
        // regole validazione del form
        $rules = array(
            'titolo' => 'required',
            'categoria' => 'required',
            'marchio' => 'required',
            'provenienza' => 'required',
            'prezzo' => 'required|numeric',
            'QuantUnita' => 'required',
            'disponibilita' => 'required|numeric',
            'seller_id' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        // controllo se il checkbox è stato cliccato
        if($request->has('presente')) {
            $request->presente = 1;
        }
        else{
            $request->presente = 0;
        }

        // controllo se l'utente ha caricato l'immagine del profilo
        if ($request->hasFile('imgProfilo')) {
            if ($request->file('imgProfilo')->isValid()) {
                $folder = 'uploads';
                $file = $request->imgProfilo->store($folder);
            }
        }

        // errore nella validazione
        if ($validator->fails()) {
            return Redirect::to('/admin/products/'.$id.'/edit')
                ->withErrors($validator);
        } else {
            // validazione ok, salvo sul database
            $product = Product::find($id);
            $product->titolo = $request->titolo;
            $product->seller_id = $request->seller_id;
            $product->categoria = $request->categoria;
            $product->marchio = $request->marchio;
            $product->provenienza = $request->provenienza;
            $product->prezzo = $request->prezzo;
            $product->QuantUnita = $request->QuantUnita;
            $product->disponibilita = $request->disponibilita;
            $product->PrezzoVecchio = $request->PrezzoVecchio;
            if(isset($file)){
                $product->imgProfilo = $file;
            }
            $product->save();

            Session::flash('message', 'Successfully edited product!');
            return Redirect::to('/admin/products');
        }
    }

    public function delete($id)
    {
        // delete
        $product = Product::find($id);
        $product->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the product!');
        return Redirect::to('/admin/products');
    }

    public function getAuthUserId()
    {
        return Auth::user()->id;
    }
        
}

