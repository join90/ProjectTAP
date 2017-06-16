<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    protected $fillable = ['nomeNegozio', 'id_user', 'piva',
    	'imgProfilo', 'GiorniApertura', 'OrariApertura', 'latitudine',
    	'longitudine', 'descrizione', 'presente',];
 
   	protected $hidden = ['id_user',];

}
