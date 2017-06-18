<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    protected $fillable = ['nomeNegozio', 'id_user', 'piva',
    	'imgProfilo', 'GiorniApertura', 'OrariApertura', 'latitudine',
    	'longitudine', 'descrizione', 'presente', 'indirizzo', 'citta'];
 
   	protected $hidden = ['id_user',];


   	public function scopePresente($query)
    {
        return $query->where('presente', '=', 1);
    }

}
