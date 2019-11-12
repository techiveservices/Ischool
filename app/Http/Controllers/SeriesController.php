<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Series;
use Auth;

class SeriesController extends Controller
{
    //

 
 public function index(){
  
  return view('series.index');

 }
 public function add_series(Request $request){
    
   $series_obj=new Series();
  if($request->user_type==2){
  $series_obj->p_id=$request->publisher_id;

  }else{
  $series_obj->p_id=$request->p_id;

  }   
   $series_obj->subject_id=$request->subject;
   $series_obj->series=$request->series;
   $series_obj->series_desc=$request->series_desc;
   $series_obj->author_desc=$request->author_desc;
   $series_obj->series_features=$request->series_feature;
   
   $series_obj->save();
   return redirect()->back()->with('success', ['Series Addedd Successfully!']);   
  }

public function edit_series(Request $request){
   

   $series_obj=Series::find($request->id);
   if($request->p_id!=''){
   	$series_obj->p_id=$request->p_id;
   }
   if($request->subject!=''){
   $series_obj->subject_id=$request->subject;
   }
   if($request->series!=''){
   	$series_obj->series=$request->series;
   }
   if($request->series_desc!=''){
    $series_obj->series_desc=$request->series_desc;
   }
   if($request->author_desc!=''){
   $series_obj->author_desc=$request->author_desc;
   }
   if($request->series_feature!=''){
   	$series_obj->series_features=$request->series_feature;
   }
   
   
   $series_obj->save();
   return redirect()->back()->with('success', ['Updated Successfully!']);   

}
  public function delete_series($id){
    $series_obj=Series::findOrFail($id);
    $series_obj->delete();
return redirect()->back()->with('success', ['Series Deleted Successfully!']);   
  }

   public function activate_series($id,$status){
 $book= \App\Series::find($id);
 $book->status=$status;
 $book->save();
 return redirect()->back()->with('success', ['Series Status Changed Successfully!']);   
  }


}
