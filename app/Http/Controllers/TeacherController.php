<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Teacher;
use \App\User;
use \App\Assign;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class TeacherController extends Controller
{
    //

    public function index(){
    	return view('teacher.index');
    }
    public function add_teacher(Request $request){
          	
    if($request->user_type=='2'){

    $p_id=$request->publisher_id;
    $school_id=$request->school;
   }elseif($request->user_type=='1'){
   $p_id=$request->p_id;
   $school_id=$request->school;
   }elseif($request->user_type=='4'){
   //$p_id=$request->publisher_id;
   $user_id=$request->user_id;
   $school_id= \App\School::where('user_id',$user_id)->value('id');
   $p_id= \App\School::where('user_id',$user_id)->value('p_id');
   

   }
           $user=new User();
           $user->name=$request->name;
           $user->email=$request->email;
           $user->password=Hash::make($request->password);
           $user->account_type=3;
           $user->save();

    	$data=new Teacher();
    	$data->p_id=$p_id;
      $data->school_id=$school_id;
    	$data->user_id=$user->id;
     	$data->email=$request->email;
    	$data->name=$request->name;
    	$data->password=$request->password;
    	$data->ph_no=$request->phone_no;
    	
        $data->save();

         return redirect()->back()->with('success', ['Teacher Addedd Successfully']);   
  

    }


    public function join_teacher(Request $request){
 
     $user_info= \App\User::where('email','=',$request->email)->get();
     $cnt=count($user_info);
   if($cnt!=0){
    //\Session::flash('failure', 'Email Already Registered' );
    return redirect()->back()->with('failure', ['Email Already Registered']); 
   }else{
      $user=new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->account_type=3;
      $user->save();


      $data=new Teacher();
      $data->p_id=$request->p_id;
      $data->user_id=$user->id;
       $code=implode(',', $request->access_code);
      $data->accesscodes=$code;
      $data->email=$request->email;
      $data->username=$request->name;
      $data->name=$request->name;
      $data->password=$request->password;
      $data->ph_no=$request->phone_no;
      $data->address=$request->address;
      $data->school=$request->school;
      $data->schl_addr=$request->school_address;
      $data->schl_ph_no=$request->sc_ph_no;
        $data->save();
 
          $p_id= $request->p_id;
          $teacher_id=$data->id;
          $access_code= $request->access_code;
         
        $code= implode(',', $access_code);
        //echo $code;
        $assign=new Assign();

        $assign->p_id=$p_id;
        $assign->teacher_id=$teacher_id;
        $assign->access_code=$code;
        $assign->save();

        // \Session::flash('success', 'Teacher Addedd Successfully' );
         return redirect()->back()->with('success', ['Registered Successfully']); 
       }
  
}
    public function edit_teacher(Request $request){
     

     DB::table('users')->where('id',$request->id)->update(['name'=>$request->name,'email'=>$request->email]);
           

    	$data=Teacher::find($request->id);
      if($request->user_type=='1'){
      $data->p_id=$request->p_id;

      }

      if($request->school!='')
       $data->school_id=$request->school;
    	 if($request->name!=''){
       $data->name=$request->name;
       }
        if($request->email!=''){
       $data->name=$request->email;
       }
        if($request->phone_no!=''){
        $data->ph_no=$request->phone_no;
       }
        	
        $data->save();

         return redirect()->back()->with('success', ['Teacher Updated Successfully']);  


    }
   public function delete_teacher($id){
    
     $teacher_info=Teacher::where('id','=',$id)->first();
    $teacher_info->user_id;

     $user_obj=User::findOrFail($teacher_info->user_id);
     $user_obj->delete();


    $teacher_obj = Teacher::findOrFail($id);
 
    $teacher_obj->delete(); 


  return redirect()->back()->with('success', ['Teacher deleted Successfully']);   

   }
   public function activate_teacher($id,$status){
   $teacher_info=Teacher::where('id','=',$id)->first();
    $teacher_info->user_id;

     $user_obj=User::find($teacher_info->user_id);
     $user_obj->status=$status;
     $user_obj->save();

    $teacher_obj = Teacher::find($id);
 
    $teacher_obj->status=$status; 
    $teacher_obj->save();

  return redirect()->back()->with('success', ['Record Activated Successfully']);   

   }
   public function fetchteacher(Request $request){

    $data = DB::table('tbl_teachers')
       ->where('p_id','=', $request->p_id)
       ->get();
     $output = '<option value="">Select Teacher</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
     }
     echo $output;

}
public function genrate_test($accesscode_id){
   
    
     return view('teacher_dashboard.chapter_list_access_code_wise',compact('accesscode_id'));


}
public function view_test_paper(){
   $user_id= Auth::user()->id;
   return view('teacher_dashboard.genrated_test_paper',compact('user_id'));

}
public function teacher_profile(){
 $user_id= Auth::user()->id;
   return view('teacher_dashboard.teacher_profile',compact('user_id'));


}
public function contact_us(){
  $user_id= Auth::user()->id;
   return view('teacher_dashboard.teacher_contact',compact('user_id'));


}

}
