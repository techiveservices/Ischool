<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function emailtest(Request $request){
        
            $old_user= \App\User::where('email',$request->email)->count();
       
           if($old_user=='0'){
               
               echo 0;
           }else{
               
               echo 1;
           }
        
    }
}
