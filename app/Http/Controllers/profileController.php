<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    //public function
    public function show($id=1){
    	$user = array('Ravi','Techive','PHP Developer','Noida Uttar Pradesh');
       return view('profile',compact('user'));

    }
     public function contact(){
    	return view('contact');

    }
}
