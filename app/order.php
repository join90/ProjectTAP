<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = ['user_id', 'nome',
    	'cart', 'ordine', 'prezzoTot',];
 
   	protected $hidden = ['user_id',];

}
