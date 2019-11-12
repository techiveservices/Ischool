<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\School;
use \App\User;
use Illuminate\Support\Facades\Redirect;
use \App\EbookLicence;
use \App\Assign;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Session;


class SchoolController extends Controller
{
    //

  public function index(){

  	return view('schools.index');
  }
  public function save(Request $request){
  
   $validator = Validator::make($request->all(), [
            's_name'=>'required',
            'contact_person'=>'required',
            'email'=>'required|unique:users',
            's_password'=>'required',
            'contact_no'=>'required',
            
        ]);
if($validator->passes())
     {
          
   if($request->user_type=='2'){

    $p_id=$request->publisher_id;
   }elseif($request->user_type=='1'){
   $p_id=$request->p_id;

   }
  $user=new User();
           $user->name=$request->s_name;
           $user->email=$request->email;
           $user->password=Hash::make($request->s_password);
           $user->account_type=4;
           $user->save();


    $data=new School();
        $data->p_id=$p_id;
        $data->user_id=$user->id;
        $data->email=$request->email;
        $data->password=$request->s_password;
        $data->name=$request->s_name;
        $data->address=$request->address;
        $data->contact=$request->contact_no;
        $data->university=$request->board_university;
        $data->contact_person=$request->contact_person;
        $data->created_at=date('Y-m-d h:i:s');
        $data->updated_at=date('Y-m-d h:i:s');
        $data->save();
    return response()->json([
       'message'   => 'Record Created Successfully',
       'class_name'  => 'alert-success',
       'status'=>'ok'
      ]);   


    // return redirect()->back()->with('success', ['Publisher Added Successfully']);   

     }else{
         
       return response()->json([
       'message'   => $validator->errors()->all(),
       'uploaded_image' => '',
       'class_name'  => 'alert-danger',
       'status'=>'notok'
      ]);
         
     }


  }
public function join_schools2(Request $request){
 
 echo 'ok'; 

 die;
}
public function join_schools(Request $request){
 
 $validator = Validator::make($request->all(), [
            'p_id'=>'required',
            'access_code'=>'required',
            'email'=>'required|unique:users',
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'school'=>'required',
            'school_address'=>'required',
            'sc_ph_no'=>'required',
            'board_university'=>'required',
            'concern_person'=>'required'
       ]);

if($validator->passes())
   {
    
      $user=new User();
      $user->name=$request->school;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->account_type=4;
      $user->status=0;
      $user->save();

      
      $data=new School();
        $data->p_id=$request->p_id;
        $data->user_id=$user->id;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->name=$request->school;
        $data->address=$request->school_address;
        $data->contact=$request->sc_ph_no;
        $data->university=$request->board_university;
        $data->contact_person=$request->concern_person;
        $data->created_at=date('Y-m-d h:i:s');
        $data->updated_at=date('Y-m-d h:i:s');
        $data->is_new='1';
        $data->status='1';
        $data->save();

        
        $ebook_id= \App\EbookLicence::where('access_code_id',$request->access_code)->value('id');

        $assign=new \App\EbookAssigned();
        $assign->ebook_id=$ebook_id;
        $assign->school_id=$data->id;
        $assign->licence_type='Software';
        $assign->no_of_licence='0';
        $assign->valid_from=date('Y-m-d');
        $assign->valid_till=date('Y-m-d');
        $assign->created_at=date('Y-m-d h:i:s');
        $assign->updated_at=date('Y-m-d h:i:s');
        $assign->is_new='1';
        $assign->status='1';
        $assign->save();

              
 return redirect()->back()->with('success', ['Your account is not yet activated please wait for activation mail from publisher side thank you']); 
 }else{
    
     return Redirect::back()->withErrors($validator);
    
}
 
  
}



  public function update(Request $request){
       $user= User::firstOrCreate(['id' => $request->my_user_id]);
           $user->name=$request->s_name;
           $user->save();

    	$data = School::firstOrCreate(['id' => $request->id]);
        $data->name=$request->s_name;
        $data->address=$request->address;
        $data->contact=$request->contact_no;
        $data->university=$request->board_university;
        $data->contact_person=$request->contact_person;
        $data->updated_at=date('Y-m-d h:i:s');
        $data->save();

        // Session::put('success', 'Record Updated Successfully!'); 
       return Redirect::back()->with('success_update', 'Record Updated Successfully!');
          return redirect()->back();



    }
    public function delete($id){

    $user_id=School::where('id','=',$id)->value('user_id');
             User::where('id','=',$user_id)->delete();


       School::where('id','=',$id)->delete();
       return Redirect::back()->withErrors(['msg', 'The Message']);
    }

  public function ebook_licence(Request $request){

   $ebook_id= $request->access_code_id;
   $school_id=$request->school;
   $licence_type=implode(',',$request->licence_type);
   $no_of_licence=$request->no_of_licence;

   $date_from=date('Y-m-d',strtotime($request->date_from));
   $date_to=date('Y-m-d',strtotime($request->date_to));
   
  
  ////////////////////////////////////////////////////////////////////////////
     $school_info=\App\School::where('id',$school_id)->first();
 
  $response= $this->check_book_validity($ebook_id,$date_from,$date_to);    
    if($response=='1'){
      //  dd('licence available');
     
    $already_alloted= $this->check_licence_availability2($ebook_id,$date_from,$date_to,$no_of_licence);
     
     if($already_alloted=='1'){
        $cnt= \App\EbookAssigned::where('school_id',$school_id)->where('ebook_id',$ebook_id)->count();
        if($cnt==0){
            
            $new_record=new \App\EbookAssigned();
            $new_record->ebook_id=$ebook_id;
            $new_record->school_id=$school_id;
            $new_record->licence_type=$licence_type;
            $new_record->no_of_licence=$no_of_licence;
            $new_record->valid_from =$date_from ;
            $new_record->valid_till =$date_to ;
            $new_record->save();
        }else{
            
       $id= \App\EbookAssigned::where('school_id',$school_id)->where('ebook_id',$ebook_id)->value('id');   
       $no_of_old_licence=\App\EbookAssigned::where('school_id',$school_id)->where('ebook_id',$ebook_id)->value('no_of_licence'); 
       
    $obj_user = \App\EbookAssigned::find($id);
          $obj_user->no_of_licence  =$no_of_old_licence+$no_of_licence;
          $obj_user->valid_from =$date_from ;
          $obj_user->valid_till =$date_to ;
          $obj_user->status =0 ;
            
          $obj_user->save(); 
    
    $response2= DB::table('schools')->where('id','=',$school_id)->update(["status"=>'0']);

  $user_id=\App\School::where('id',$school_id)->value('user_id');

    $response2= DB::table('users')->where('id','=',$user_id)->update(["status"=>'1']);

  
  $school_info=\App\School::where('id',$school_id)->first();
   
   $mypass=$school_info->password;
   $name=$school_info->name;
   $email=$school_info->email;

   Mail::send('email.welcome_email2', compact('mypass','name','email'), function ($message) use ($email) {
            $message->subject('Registration Confirmation ');
            $message->to($email, 'Techive Pvt Ltd');
        });

   //print_r($response);die;
   return redirect('/ebook_licence')->with('success', ' No of  Licence Updated successfully');
    
            
        }
    
    
 
    
    
     }else{
     
     
     return redirect('/ebook_licence')->with('failure', ' Your Requested number of Licence Not Available Contact to your Administrator');
      
         
     }
     
        
    }else{
        
      
      
       return redirect('/ebook_licence')->with('failure', ' Your requested licence duration not valid');
      
        //dd('licence not available');
        
    }
   
  ///////////////////////////////////////////////////////////////////

    
    }
    public function check_book_validity($books_list,$active_from,$active_to){
    
    $from=date('Y-m-d',strtotime($active_from));
    $to=date('Y-m-d',strtotime($active_to));
    
    $sqlQuery = "SELECT * FROM ebook_licence_info WHERE id='$books_list' and (licence_from <='$from' and licence_to >='$from') and (licence_from < '$to' and licence_to >='$to')";
    $result = DB::select(DB::raw($sqlQuery));
    
   
    if(!empty($result)){
        
        return 1;
      
      
    }else{
        
        return 0;
    }
        
    
    
    
    
}

public function check_licence_availability($ebook,$from,$to,$no_of_licence){
       $ebooks= \App\EbookLicence::find($ebook);
       $total_licence=$ebooks->no_licence;
       
         $sqlQuery = "SELECT SUM(no_of_licence) as no_licence FROM ebook_assigned_licence WHERE ebook_id='$ebook' and (valid_from <='$from' and valid_till >='$from') and (valid_from < '$to' and valid_till >='$to')";
    $result = DB::select(DB::raw($sqlQuery));
    $total_no_of_licence_assigned=0;
    
   foreach($result as $key=>$val){
      // echo $key;
      $total_no_of_licence_assigned=$val->no_licence;
       
   }
    $available= $total_licence-$total_no_of_licence_assigned;
    
     
     if($available>=$no_of_licence){
         
         return 1;
     }else{
         
         return 0;
     }
     
}
public function check_licence_availability2($ebook,$from,$to,$no_of_licence){
       $ebooks= \App\EbookLicence::find($ebook);
       $total_licence=$ebooks->no_licence;
     
    $sqlQuery = "SELECT SUM(no_of_licence) as no_licence FROM ebook_assigned_licence WHERE ebook_id='$ebook' and (valid_from BETWEEN '$from' AND '$to') and (valid_till BETWEEN '$from' AND '$to')";
    $result = DB::select(DB::raw($sqlQuery));
    $total_no_of_licence_assigned=0;
    //print_r($sqlQuery);
    
   foreach($result as $key=>$val){
      // echo $key;
      $total_no_of_licence_assigned=$val->no_licence;
       
   }
   
   
    $available= $total_licence-$total_no_of_licence_assigned;
    
   
     
     if($available>=$no_of_licence){
         
         return 1;
     }else{
         
         return 0;
     }
     
}

    public function e_book_verify(Request $request){
  $ebook_id= $request->access_code_id;
  $maximum=$request->maximum;
  $number_of_licence=$request->number_of_licence;

  $fromdata= date('Y-m-d',strtotime($request->datepicker_from));
  $todate= date('Y-m-d',strtotime($request->datepicker_to));

    $record=DB::table('ebook_licence_info')->where('id','=',$ebook_id)->whereBetween('licence_to',[$fromdata,$todate])->first();
   // echo $record;

   $sqlQuery = "SELECT * FROM ebook_licence_info where id='$ebook_id' and (licence_from <= '$fromdata' and licence_to >='$fromdata' ) and (licence_from <= '$todate' and licence_to >='$todate' )";
$result = DB::select(DB::raw($sqlQuery));
 
 $already_assigned_licence=DB::table('ebook_assigned_licence')->where('ebook_id','=',$ebook_id)->sum('no_of_licence');
     
 //echo $maximum;
 //die;
  if(!empty($result)){

    $total=$number_of_licence+$already_assigned_licence;


        if($total<=$maximum){
        echo '1';

        }else{
          $available_licence=$maximum-$already_assigned_licence;
         // echo $available_licence;
          if($available_licence>0){
            
            echo 'Total '.$available_licence.' Licence Available for this E-Book ';

           }else{
            
             echo 'No More Licence Available for this E-Book';
           }
         

        }

  }else{

    echo 'Licence from or Licence to date mis match from available E-Book licence';
  }
 
 
    }

    public function assign_licence($id){

      return view('ebooks.assing_ebook_licence',compact('id'));

    }


    public function genrate_test($accesscode_id){
   
    
     return view('school_dashboard.chapter_list_access_code_wise',compact('accesscode_id'));


   }
    public function profile(){

     $user_id= Auth::user()->id;
   return view('school_dashboard.school_profile',compact('user_id'));

    }
    public function update_profile(Request $request){
        $user_id=$request->user_id;
        $school_id=$request->id;
        $name=$request->name;
        $email=$request->email;
        $ph_no=$request->ph_no;
        $address=$request->address;

        $user= User::firstOrCreate(['id' => $user_id]);
           $user->name=$name;
           $user->save();

      $data = School::firstOrCreate(['id' => $school_id]);
        $data->name=$name;
        $data->address=$address;
        $data->contact=$ph_no;
        $data->updated_at=date('Y-m-d h:i:s');
        $data->save();

  return response()->json([
       'message'   => 'Profile Updated Successfully',
       'uploaded_image' => '',
       'class_name'  => 'alert-success',
       'status'=>'ok'
      ]);

      //  return Redirect::back()->with(['success', 'Profile Updated Successfully']);


    }
    public function view_test_paper(){
     
     $user_id= Auth::user()->id;
   return view('school_dashboard.genrated_test_paper',compact('user_id'));


    }
    public function change_password(Request $request){

$validator = Validator::make($request->all(), [
            'old_pass'=>'required',
            'password'=>'required_with:confirm_password|same:confirm_password|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-+]).{6,}$/',
            'confirm_password'=>'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
           
        ]);



if($validator->passes())
     {

   $user_id=$request->user_id;
  
  $email=$request->email;
  $old_pass=$request->old_pass;
  $new_pass=$request->password;       
        $user_check=\App\User::where('id',$user_id)->get();
            if(!empty($user_check)){

        $current_password = \App\User::where('id',$user_id)->value('password');
       if(\Hash::check($old_pass, $current_password))
        {         
       
          $user_id = $user_id;                       
          $obj_user = User::find($user_id);
          $obj_user->email=$request->email;
          $obj_user->password = \Hash::make($request->input('password'));
          $obj_user->save(); 

         $p_id=$request->id;
          $obj_user = School::find($request->id);
          $obj_user->email=$request->email;
          $obj_user->password = $request->input('password');
          $obj_user->save(); 

return response()->json([
       'message'   =>'You password Changed Successfully',
       'class_name'  => 'alert-success',
       'status'=>'ok'
      ]);

         // return redirect()->back()->with('success', ['You password Changed Successfully']);
        
        }else{
      return response()->json([
       'message'   =>'You Old Password Not Currect',
       'class_name'  => 'alert-danger',
       'status'=>'ok'
      ]);

        }



     }else{
       return response()->json([
       'message'   =>'You are unathorised',
       'class_name'  => 'alert-danger',
       'status'=>'ok'
      ]);

     }}else{

      return response()->json([
       'message'   =>$validator->errors()->all(),
       'class_name'  => 'alert-danger',
       'status'=>'ok'
      ]);

     }
      
        
 }

    public function contact_us(){
     $user_id= Auth::user()->id;
     return view('school_dashboard.school_contact',compact('user_id'));


    }
    public function licence_info($id){

      $school_id=$id;
      return view('schools.licence_info',compact('school_id'));
    }
    public function fetch(Request $request){


     $p_id= $request->p_id;

     $data = DB::table('schools')
       ->where('p_id','=', $request->p_id)
       ->where('status','=','0')
       ->get();
     $output = '<option value="">Select School</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
     }
     echo $output;
    }
    public function profile2(){

     if(Auth::check()){
       $user_id=Auth::user()->id;
       
       return view('schools.my_profile');
     }


    }
    
     public function my_profile(){
           
       return view('school_dashboard.school_profile');
    
    }
    public function start_reading($licence_id){
     
      return view('school_dashboard.start_reading',compact('licence_id'));
    }
   
   public function send_otp(Request $request){
   
session_start();
$rndno=rand(100000, 999999);//OTP generate

$to=$request->email;

$_SESSION['otp']=$rndno;

$otp=$rndno;



// Mail::send('email.otp_email',compact('otp','to'), function ($message) use ($to){
//       $message->from('contact@techive.in','Techive Pvt Ltd');
//       $message->to($to);
//       $message->subject('OTP For Book Reader');
//     });


$response=Mail::send('email.otp_email', compact('otp','to'), function ($message) use ($to) {
        $message->from('contact@techive.in','PRAGATI PRAKASHAN');
        $message->subject('OTP For Book Reader');
        $message->to($to);
        });
        
//echo $response;

echo $_SESSION['otp'];

   }

public function reader_start_reading(Request $request){
 
  //$url = Storage::url('html_templat/hindi_book2/index.html');
  //echo $url; die;

    $user_ip=$this->getRealUserIp();
   // echo $user_ip; die;
   $user_id=$request->user_id;
   $licence_id=$request->licence_id;
   $school_id=$request->school_id;
   $session_id=$request->session_id;
   $email=$request->email;
   $refrer=request()->headers->get('referer');
  
   $data=array(
   "session_id"=>$session_id,
   "user_id"=>$user_id,
   "ip"=>$user_ip,
   "school_id"=>$school_id,
   "book_id"=>$licence_id,
   "reader_name"=>$request->name,
   "reader_email"=>$email,
   "refrerr_url"=>$refrer,
   "login_at"=>date('Y-m-d h:i:s')
   );




   $check_old=DB::table('e_book_reader')->where('session_id',$session_id)->where('ip',$user_ip)->where('book_id',$licence_id)->where('status','=','0')->count();
    if($check_old=='0'){
      $response=DB::table('e_book_reader')->insert($data);
    }
  
     
   if (Auth::check()) {
      $active_reader=DB::table('e_book_reader')->where('school_id',$school_id)->where('book_id',$licence_id)->where('status','=','0')->count();

      $check_licence_availability=\App\EbookAssigned::where('id',$licence_id)->value('no_of_licence');

      if($check_licence_availability>$active_reader){

        $assigned_ebook=\App\EbookAssigned::where('id',$licence_id)->first();

   $ebook_info=  \App\EbookLicence::where('id',$assigned_ebook->ebook_id)->first();
  //print_r($ebook_info);
 $book_info=  \App\Book::where('id',$ebook_info->access_code_id)->first();
 $booktitle=$book_info->title;
 $slug=$book_info->book_slug;
 $view='ebooks_templat.'.$book_info->book_slug.'.mobile';
//echo $view;die;

 $number_of_page=150;
return view($view,compact('slug','booktitle','number_of_page'));
    




      }else{

  \Session::put('failure_availability', 'No any Active Licence Available right Not try again after somoe time');

 return Redirect::back()->with(['failure', 'No any Active Licence Available right Not try again after somoe time']);

      }
   //echo $licence_id;
    
    
     }else{

\Session::put('failure_availability', 'You are not authorized user');
      return Redirect::back()->with(['failure', 'You are not authorized user']);
     }

}

public function basic_html(){
  
  return view('ebooks_templat.hindi_book2.mobile');

}
public function mobile_html(){
  
  return view('ebooks_templat.hindi_book1.mobile');

}
public function show_e_book($folder,$subfile,$file){

echo 'ok'; die;
  if (Auth::check()) {
   $url ='/'.$folder.'/'.$subfile.'/'.$file;
   
   echo $url;
   die;
          return redirect($url);
  }else{
    echo 'You are unauthorised';
  }


}
public function on_closetab(Request $request){
    
      $first_att='html_templat';
      $second_att='hindi_book2';
      $third_att='index.html';

      //  $url = 'html_templat/hindi_book2/index.html';
      return redirect()->route('read_book', ['first_att' => $first_att, 'second_att' => $second_att,'third_att'=>$third_att]);
        //return redirect('/read_book');
 



   //  return redirect(storage_path('app\hindi_book2\index.html'));
}
public function read_book_start($first,$second,$third){
echo $first.'<br>';
echo $second.'<br>';
echo $third.'<br>';
die;


}
public function new_school_list(){

  return view('schools.new_school_list');
}




public function ebook_licence2_old(Request $request){
  // echo 'ok'; die;
   $ebook_id= $request->access_code_id;
   $school_id=$request->school_id;
   $no_of_licence=$request->no_of_licence;

   $date_from=date('Y-m-d',strtotime($request->date_from));
   $date_to=date('Y-m-d',strtotime($request->date_to));
  $id=$request->id;
   $old_record= DB::table('ebook_assigned_licence')->where('id','=',$id)->get();
   
   $no_record=count($old_record);
   
   if($no_record!='0'){
    
  $response= DB::table('ebook_assigned_licence')->where('id','=',$id)->update(["no_of_licence"=>$no_of_licence,"valid_from"=>$date_from,"valid_till"=>$date_to,"updated_at"=>date('Y-m-d h:i:s'),'status'=>'0','is_new'=>'0']);

  $response2= DB::table('schools')->where('id','=',$school_id)->update(['is_new'=>'0',"status"=>'0']);

  $user_id=\App\School::where('id',$school_id)->value('user_id');

    $response2= DB::table('users')->where('id','=',$user_id)->update(["status"=>'1']);

  
  $school_info=\App\School::where('id',$school_id)->first();
   
   $mypass=$school_info->password;
   $name=$school_info->name;
   $email=$school_info->email;

   Mail::send('email.welcome_email2', compact('mypass','name','email'), function ($message) use ($email) {
            $message->subject('Registration Confirmation ');
            $message->to($email, 'Techive Pvt Ltd');
        });

   //print_r($response);die;
   return redirect('/ebook_licence')->with('success', ' No of  Licence Updated successfully');

   }
 

}



 public function ebook_licence2(Request $request){
   $id=$request->id;
   $ebook_id= $request->access_code_id;
   $school_id=$request->school_id;
   $licence_type='Software';
   $no_of_licence=$request->no_of_licence;
   $date_from=date('Y-m-d',strtotime($request->date_from));
   $date_to=date('Y-m-d',strtotime($request->date_to));
   
   ////////////////////////////////////////////////////////////////////////////
     $school_info=\App\School::where('id',$school_id)->first();
 
   // print_r($school_info);
   // die;

  $response= $this->check_book_validity($ebook_id,$date_from,$date_to);    
    if($response=='1'){
      //  dd('licence available');
     
    $already_alloted= $this->check_licence_availability2($ebook_id,$date_from,$date_to,$no_of_licence);
     
     if($already_alloted=='1'){
        $cnt= \App\EbookAssigned::where('school_id',$school_id)->where('ebook_id',$ebook_id)->count();
        if($cnt==0){
            
            $new_record=new \App\EbookAssigned();
            $new_record->ebook_id=$ebook_id;
            $new_record->school_id=$school_id;
            $new_record->licence_type=$licence_type;
            $new_record->no_of_licence=$no_of_licence;
            $new_record->valid_from =$date_from ;
            $new_record->valid_till =$date_to ;
             $new_record->status ='0' ;
             $new_record->is_new ='0' ;
            $new_record->save();
        }else{
            
       $id= \App\EbookAssigned::where('school_id',$school_id)->where('ebook_id',$ebook_id)->value('id');   
       $no_of_old_licence=\App\EbookAssigned::where('school_id',$school_id)->where('ebook_id',$ebook_id)->value('no_of_licence'); 
       
    $obj_user = \App\EbookAssigned::find($id);
          $obj_user->no_of_licence  =$no_of_old_licence+$no_of_licence;
          $obj_user->valid_from =$date_from ;
          $obj_user->valid_till =$date_to ;
          $obj_user->status =0 ;
          $obj_user->is_new =0 ;
            
          $obj_user->save(); 
    
    $response2= DB::table('schools')->where('id','=',$school_id)->update(["is_new"=>'0',"status"=>'1']);

  $user_id=\App\School::where('id',$school_id)->value('user_id');

  $response2= DB::table('users')->where('id','=',$user_id)->update(["status"=>'1']);

  
 // $school_info=\App\School::find($school_id);
   
   $mypass=$school_info->password;
   $name=$school_info->name;
   $email=$school_info->email;

   Mail::send('email.welcome_email2', compact('mypass','name','email'), function ($message) use ($email) {
            $message->subject('Registration Confirmation ');
            $message->to($email, 'Techive Pvt Ltd');
        });

   //print_r($response);die;
   return redirect()->back()->with('success', ' No of  Licence Updated successfully');
    
            
        }
    
    
 
    
    
     }else{
     
     
     return redirect()->back()->with('failure', ' Your Requested number of Licence Not Available Contact to your Administrator');
      
         
     }
     
        
    }else{
        
      
      
       return redirect()->back()->with('failure', ' Your requested licence duration not valid');
      
        //dd('licence not available');
        
    }
   
  ///////////////////////////////////////////////////////////////////

    
    }










public  function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }

 public function activate_school($id){

 // echo $id;
 // die;
  $school=\App\School::find($id);
  if($school->status=='0'){
    $school->status=1;
  }else{
    $school->status=0;
  }
 
  $school->save();
  $my_user=\App\User::find($school->user_id);
  if($my_user->status=='0'){
     $my_user->status=1;
  }else{
   $my_user->status=0;

  }
  $my_user->save();
 
 if($my_user->status=='0'){
    return redirect()->back()->with('failure', ['School De-Activated Successfully']);   

   }else{
    return redirect()->back()->with('success', ['School Activated Successfully']);   
   }
  
 }


}
