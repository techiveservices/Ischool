<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
   /* Protected function getNameAttribute($value){
    	return strtoupper($value);
    }*/
    Protected function setNameAttribute($value){
    	$this->attributes['name'] = strtoupper($value);
    }
      protected $hidden = ['mobile'];
    
}
