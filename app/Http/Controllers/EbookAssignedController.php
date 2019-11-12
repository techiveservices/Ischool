<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class EbookAssignedController extends Controller
{
    //

    public function provided_licence_list($id){

      $list= \App\EbookAssigned::where('ebook_id','=',$id)->get();
      return view('ebooks.assigned_ebook_list',compact('list'));      

    }
    public function my_books(){


       return view('ebooks.my_books');

     }
    public function issue_ebooks(){

       return view('ebooks.issue_books');

    }
    public function fetch(Request $request){
        
     $user_id= Auth::user()->id;

    $school_id= \App\School::where('user_id',$user_id)->value('id');

    
     $type=$request->type;

     if($type=='1'){
      $data = DB::table('tbl_teachers')
       ->where('school_id','=', $school_id)
       ->get();

     }elseif($type=='2'){
         $data = DB::table('students')
       ->where('school_id','=', $school_id)
       ->get();

     }
      
     $output = '<option value="">Select Member</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->name.'('.$row->email.')</option>';
     }
     echo $output;


    }
    public function issue_to_member(Request $request){

     $user_id= Auth::user()->id;
    
     $school_id= \App\School::where('user_id',$user_id)->value('id');
    $licence_info= \App\EbookAssigned::where('ebook_id',$request->books)->where('school_id',$school_id)->first();
    $licence_info->no_of_licence;
    $valid_from=date('Y-m-d',strtotime($request->issue_from));
    $valid_till=date('Y-m-d',strtotime($request->issue_to));
    if(($valid_from >=$licence_info->valid_from && $valid_from<$licence_info->valid_till) && $valid_till<= $licence_info->valid_till){

  $current_date=date('Y-m-d');
 $sqlQuery = "SELECT * FROM book_issue_to_member WHERE school_id='$school_id' and book_id='$request->books' and (issue_from <= '$valid_from' and issue_till>='$valid_from')";

 
//echo $sqlQuery; die;
$result = DB::select(DB::raw($sqlQuery));

      $licence_alloted_no= count($result);
         
  //die;
   // $issue_record= DB::table('book_issue_to_member')->where('school_id',$school_id)->where('book_id',$request->books)->count();
    if($licence_alloted_no <$licence_info->no_of_licence){

    $data['book_id']=$request->books;
    $data['school_id']=$school_id;
      $data['member_type']=$request->member_type;
      $data['member_id']=$request->member;
      $data['issue_from']=date('Y-m-d',strtotime($request->issue_from));
      $data['issue_till']=date('Y-m-d',strtotime($request->issue_to));
      $data['created_at']=date('Y-m-d h:i:s');
      $data['updated_at']=date('Y-m-d h:i:s');

     


      DB::table('book_issue_to_member')->insert($data);
 return redirect()->back()->with('success', ['book issued Successfully']);  
     }else{

     	return redirect()->back()->with('failure', ['You have used your all alloted licence try to contact publisher']);
     } 

    }else{
return redirect()->back()->with('failure', ['In valid Date Range']);   


    }

     

     



    }
}
