<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Subject;
class SubjectController extends Controller
{
    //
  
     public function index(){

    	return view('subject.index');
    }

    public function add_subject(Request $request){
       //('ok');
      $subject_obj=new Subject();
      $subject_obj->name=$request->name;
      $subject_obj->save();

       return redirect()->back()->with('success', ['Addedd Successfully']);  


    }
     public function edit_subject(Request $request){
      
      $subject_obj=Subject::find($request->id);
      $subject_obj->name=$request->name;
      $subject_obj->save();

       return redirect()->back()->with('success', ['Updated Successfully']);  


    }
    public function delete_subject($id){
    $subject_obj=Subject::findOrFail($id);
    $subject_obj->delete();
return redirect()->back()->with('success', ['Deleted Successfully']);   
  }

 public function activate_subject($id,$status){
 $subject_obj= \App\Subject::find($id);
 $subject_obj->status=$status;
 $subject_obj->save();
 return redirect()->back()->with('success', ['Status Changed Successfully']);   

  }


}
