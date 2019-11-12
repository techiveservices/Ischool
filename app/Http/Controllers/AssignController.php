<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Assign;

class AssignController extends Controller
{
    //



    public function assign_code(Request $request){

          $p_id= $request->p_id;
          $teacher_id=$request->teacher_id;
          $access_code= $request->access_code;
         
        $code= implode(',', $access_code);
        //echo $code;
        $assign=new Assign();

        $assign->p_id=$p_id;
        $assign->teacher_id=$teacher_id;
        $assign->access_code=$code;
        $assign->save();

        return redirect()->back()->with('success', ['Accesscode Assigned Successfully']); 

    }
    public function delete_assign($id){

    	 $book = \App\Assign::findOrFail($id);
 
    $book->delete(); //DELETE OCCURS HERE AFTER RECORD FOUND
  return redirect()->back()->with('success', ['Record deleted Successfully']);  
    }

     public function activate_assign($id,$status){
 $book= \App\Assign::find($id);
 $book->status=$status;
 $book->save();
 return redirect()->back()->with('success', ['Accesscode Status Changed Successfully']);   
  }
}
