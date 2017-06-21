<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\seller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Session;



class SellerController extends Controller
{

    public function index() 
    {
        
        $shops = seller::where('user_id', $this->getAuthUserId())->get();

        return view('layout.backend.shops.index', ['shops' => $shops]);

    }

    public function create() 
    {
        
        return view('layout.backend.shops.create');

    }

    public function store(Request $request)
    {
        // regole validazione del form
        $rules = array(
            'nomeNegozio' => 'required',
            'piva' => 'required|numeric',
            'GiorniApertura' => 'required',
            'OrariApertura' => 'required',
            'latitudine' => 'required|numeric',
            'longitudine' => 'required|numeric',

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
            return Redirect::to('/admin/shops/new')
                ->withErrors($validator)
                ->withInput($request->all());
        } else {
            // validazione ok, salvo sul database
            $shop = new seller;
            $shop->nomeNegozio = $request->nomeNegozio;
            $shop->user_id = $this->getAuthUserId();
            $shop->piva = $request->piva;
            $shop->GiorniApertura = $request->GiorniApertura;
            $shop->OrariApertura = $request->OrariApertura;
            $shop->latitudine = $request->latitudine;
            $shop->longitudine = $request->longitudine;
            $shop->descrizione = $request->descrizione;
            $shop->indirizzo = $request->indirizzo;
            $shop->citta = $request->citta;
            $shop->presente = $request->presente;
            if(isset($file)){
                $shop->imgProfilo = $file;
            }
            $shop->save();

            Session::flash('message', 'Successfully created shop!');
            return Redirect::to('/admin/shops');
        }
    }

    public function edit($id)
    {
        $shop = seller::find($id);
        return view('layout.backend.shops.edit', compact('shop'));
    }


    public function update(Request $request, $id)
    {
        // regole validazione del form
        $rules = array(
            'nomeNegozio' => 'required',
            'piva' => 'required|numeric',
            'GiorniApertura' => 'required',
            'OrariApertura' => 'required',
            'latitudine' => 'required|numeric',
            'longitudine' => 'required|numeric',

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
            return Redirect::to('/admin/shops/'.$id.'/edit')
                ->withErrors($validator);
        } else {
            // validazione ok, salvo sul database
            $shop = seller::find($id);
            $shop->nomeNegozio = $request->nomeNegozio;
            $shop->piva = $request->piva;
            $shop->GiorniApertura = $request->GiorniApertura;
            $shop->OrariApertura = $request->OrariApertura;
            $shop->latitudine = $request->latitudine;
            $shop->longitudine = $request->longitudine;
            $shop->descrizione = $request->descrizione;
            $shop->indirizzo = $request->indirizzo;
            $shop->citta = $request->citta;
            $shop->presente = $request->presente;
            if(isset($file)){
                $shop->imgProfilo = $file;
            }
            $shop->save();

            Session::flash('message', 'Successfully edited shop!');
            return Redirect::to('/admin/shops');
        }
    }

    public function delete($id)
    {
        // delete
        $shop = seller::find($id);
        $shop->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the shop!');
        return Redirect::to('/admin/shops');
    }

    public function getAuthUserId()
    {
        return Auth::user()->id;
    }

    public static function getShopsForSelect(){
        
        $shops = seller::where('user_id', Auth::user()->id)->pluck('nomeNegozio','id');
        
        return $shops;   
    }

    /* REDIS */

    public static function AllShops(){

        return seller::presente()->get();
    }

}
