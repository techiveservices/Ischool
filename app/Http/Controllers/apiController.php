<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;

class apiController extends Controller
{
    //
    public function index($request){
    	//dd($request);
    $users = Register::find($request);
    
   // return (string)$users;

    return $users->tojSON(JSON_PRETTY_PRINT);
    return $users->toArray();
    }

    
}

