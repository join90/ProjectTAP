<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    protected $fillable = ['nome', 'id_user', 'indirizzo', 'cap',
    	'citta', 'piva', 'email', 'password', 'cellulare',
    	'telefono', 'imgProfilo', 'GiorniApertura', 'OrariApertura', 'latitudine',
    	'longitudine', 'descrizione', 'presente',];
 
   	protected $hidden = ['id_user',];

}
