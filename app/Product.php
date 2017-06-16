<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['titolo', 'categoria', 'marchio', 'provenienza',
    	'prezzo', 'pezzatura', 'QuantUnita', 'disponibilita',
    	'maturazione', 'TipoAgricoltura', 'km0', 'promozione', 'PrezzoVecchio',
    	'presente', 'descrizione', 'pzvenduti', 'tipo', 'seller_id',];
 
   	protected $hidden = ['seller_id',];


   	



}
