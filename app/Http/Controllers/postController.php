<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postController extends Controller
{
    //show data
    public function index($id=1){
    	$posts = App\Post::all();
       return view('posts/index',compact($posts));
    }

     public function show($id=1){
       return view('posts/index');
    }
}
