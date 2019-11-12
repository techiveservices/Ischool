<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siteController extends Controller
{
    //
    public function index(){
    	return view('site.about-us');
    }
}
