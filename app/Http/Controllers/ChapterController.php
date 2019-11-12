<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Chapter;
use DB;

class ChapterController extends Controller
{
    //

    public function index(){
   
     return view('chapter.index');

    }
    public function add_chapter(Request $request){
        
        $data=new Chapter();

        $data->p_id=$request->p_id;
        $data->access_code=$request->access_code;
        $data->ch_no=$request->ch_no;
        $data->ch_name=$request->ch_name;
        $data->save();

      return redirect()->back()->with('success', ['Chapter Added Successfully']);  

    }
        public function delete_chapter($id){
    $class_obj=\App\Chapter::findOrFail($id);
    $class_obj->delete();
return redirect()->back()->with('success', ['Deleted Successfully']);   
  }

   public function activate_chapter($id,$status){
 
 $class_obj= \App\Chapter::find($id);
 $class_obj->status=$status;
 $class_obj->save();
 return redirect()->back()->with('success', ['Status Changed Successfully']);   
  }
  public function fetch(Request $request){
     $access_code=$request->code;
      $data = DB::table('tbl_chapter')
       ->where('access_code','=', $access_code)
       ->get();
     $output = '<option value="">Select Chapter</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->ch_name.'</option>';
     }
     echo $output;

  }

  public function edit_chapter_list(Request $request){
  $chapters_no=$request->ch_no;
  $chapters=$request->ch_name;
  print_r($chapters);
  die;

  }
  public function chapter_list($id){
     $access_code_id=$id;
    return view('chapter.index',compact('access_code_id'));


  }
  public function edit_chapter(Request $request){
       $id=$request->id;
       $ch_no=$request->ch_no;
       $ch_name=$request->ch_name;
       $class_obj= \App\Chapter::find($id);
 $class_obj->ch_no=$ch_no;
 $class_obj->ch_name=$ch_name;
 $class_obj->save();
 return redirect()->back()->with('success', ['Status Changed Successfully']);   

  }
}
