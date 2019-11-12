<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use \App\User;
use \App\Publisher;
class SuperController extends Controller
{
    //
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('super_admin.login');
    }
     public function register()
    {
        return view('super_admin.register');
    }
    public function publisher(){

       return view('super_admin.published_list');
    }

   public function reset_password(){

    return view('super_admin.reset_password');

     
   }
public function change_password(Request $request){
 $validator = Validator::make($request->all(), [
            'old_pass'=>'required',
            'password'=>'required_with:confirm_password|same:confirm_password|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-+]).{6,}$/',
            'confirm_password'=>'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            
        ]);
    if($validator->passes())
     {
      $user_id=$request->id;
  
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
          $obj_user->email=$email;
          $obj_user->password = \Hash::make($request->input('password'));
          $obj_user->save(); 
       
         $user_type=  Auth::user()->account_type;

       if($user_type=='2'){

        $p_id= Publisher::where('user_id',$user_id)->value('id');

          $obj_user1 = Publisher::find($p_id);
          $obj_user1->pblr_email_id=$email;
          $obj_user1->pblr_pwd =$request->input('password');
          $obj_user1->save(); 
      
       }

         return redirect()->back()->with('success', ['You password Changed Successfully']);
        
        }
        else
        {  
     
         return redirect()->back()->with('failure', ['You Old Password Not Currect']);;
         
        } 

    }else{

    
    return redirect()->back()->with('failure', ['You are not authorized']);
     
    }
           
     }else{
         
         return redirect()->back()->withErrors($validator);    
         
     }
        
 }
 public function total_book_reader(){
     $user_type= Auth::user()->account_type;
     $user_id=Auth::user()->id;

     if($user_type=='1'){

     // $readers_list= \App\BookReader::groupBy('reader_email')->get();
        $readers_list = DB::select(DB::raw("SELECT * FROM `e_book_reader` GROUP BY `reader_email`") );


     }elseif($user_type=='2'){

        $p_id=\App\Publisher::where('user_id',$user_id)->value('id');
        $p_school_list=\App\School::where('p_id',$p_id)->get();


       $ar=array();
       foreach($p_school_list as $list){
        array_push($ar, $list->id);

       }

     $readers_list= DB::table('e_book_reader')->whereIn('school_id', $ar)->groupBy('reader_email')->get();
     
     //$readers_list = DB::select(DB::raw("SELECT * FROM `e_book_reader`  GROUP BY `reader_email` ") );
     
     }
      return view('super_admin.reader_list',compact('readers_list'));



 }

}
