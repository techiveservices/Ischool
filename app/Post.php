<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //select data
    public function(){
    	$results = DB::select('select * from posts where id = 1', array(1));
    	return $results;
    }
}
