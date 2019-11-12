<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Classes;
use \App\Book;
//use \App\Classes;
// use Illuminate\Http\Request;

class ClassController extends Controller
{
    //
    public function index(){

    	return view('class.index');
    }

    public function add_class(Request $request){
       //('ok');
      $class_obj=new \App\Classes();
      $class_obj->name=$request->class;
      $class_obj->save();

       return redirect()->back()->with('success', ['Addedd Successfully']);  


    }
     public function edit_class(Request $request){
      
      $class_obj=\App\Classes::find($request->id);
      $class_obj->name=$request->class;
      $class_obj->save();

       return redirect()->back()->with('success', ['Updated Successfully']);  


    }
    public function delete_class($id){
    $class_obj=\App\Classes::findOrFail($id);
    $class_obj->delete();
return redirect()->back()->with('success', ['Deleted Successfully']);   
  }

   public function activate_class($id,$status){
 
 $class_obj= \App\Classes::find($id);
 $class_obj->status=$status;
 $class_obj->save();
 return redirect()->back()->with('success', ['Status Changed Successfully']);   
  }
  public function fetchClass(Request $request){
      $code=$request->code;
        $class_id=Book::where('id','=',$code)->value('class');
          $class_name=Classes::where('id','=',$class_id)->value('name');
   // echo $code;
   // die;
     echo $class_name;

  }
}
