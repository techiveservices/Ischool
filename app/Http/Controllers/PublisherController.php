<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Publisher;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Image;
use Redirect;
class PublisherController extends Controller
{
    //

  public function add_publisher(Request $request){
  //echo $request->publisher_name;
   $validator = Validator::make($request->all(), [
            'publisher_name'=>'required',
            'contact_person'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'contact_no'=>'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100, max_width=300,max_height=300',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max-width=1200,max-height=500',
        ]);
if($validator->passes())
     {
          
$logo_name='';
$banners='';


        $image = $request->file('logo');
        if(!empty($image)){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/publisher_logo');
        $image->move($destinationPath, $input['imagename']);
       
        $logo_name=time().'.'.$image->getClientOriginalExtension();
            
        }
        

        $image = $request->file('banner');
         if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/publisher_banners');
        $image->move($destinationPath, $input['imagename']);
       
        $banners=time().'.'.$image->getClientOriginalExtension();
         }
        //$this->postImage->add($input);
     
      $user=new User();
      $user->name=$request->publisher_name;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->account_type='2';
      $user->save();

     $publisher=new \App\Publisher();
     $publisher->user_id=$user->id;
    $publisher->pblctn_name=$request->publisher_name;
    $publisher->pblctn_addrs=$request->address;
    $publisher->cntct_psn_name=$request->contact_person;
    $publisher->pblr_email_id=$request->email;
    $publisher->pblr_pwd=$request->password;
    $publisher->pblr_cntct_no=$request->contact_no;
    $publisher->pblr_logo=$logo_name;
    $publisher->pblr_banner=$banners;
    $publisher->pblr_about=$request->about;
     $publisher->save();

         // \Session::put('success', 'Record Created Successfully');
  return response()->json([
       'message'   => 'Record Created Successfully',
       'class_name'  => 'alert alert-success',
       'status'=>'ok'
      ]);   

     }else{
         


   // \Session::put('failure_pub', $validator->errors()->all());

    return response()->json([
       'message'   => $validator->errors()->all(),
       'uploaded_image' => '',
       'class_name'  => 'alert alert-danger',
       'status'=>'notok'
      ]);
         
     }

  }
  public function edit_publisher(Request $request){

//echo $request->publisher_name;
   $validator = Validator::make($request->all(), [
            'publisher_name'=>'required',
            'contact_person'=>'required',
            'contact_no'=>'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100, max_width=300,max_height=300',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1200,max_height=500',
        ]);
if($validator->passes())
     {
          
$logo_name='';
$banners='';
        
        $image = $request->file('logo');
        if(!empty($request->file('logo'))){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/publisher_logo');
        $image->move($destinationPath, $input['imagename']);
       
        $logo_name=time().'.'.$image->getClientOriginalExtension();

        }

        

        $image = $request->file('banner');
         if(!empty($request->file('banner'))){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/publisher_banners');
        $image->move($destinationPath, $input['imagename']);
       
        $banners=time().'.'.$image->getClientOriginalExtension();

         }
       
      $user= User::find($request->user_id);
      $user->name=$request->publisher_name;
      //$user->email=$request->email;
     // $user->password=Hash::make($request->password);
      $user->save();

       

     $publisher= \App\Publisher::find($request->id);
    $publisher->pblctn_name=$request->publisher_name;
    $publisher->pblctn_addrs=$request->address;
    $publisher->cntct_psn_name=$request->contact_person;
    //$publisher->pblr_email_id=$request->email;
    
    $publisher->pblr_cntct_no=$request->contact_no;

    if($logo_name!=''){
    	 $publisher->pblr_logo=$logo_name;
    }
    if($banners!=''){
    	$publisher->pblr_banner=$banners;
    }
       
    $publisher->pblr_about=$request->about;
     $publisher->save();

    return response()->json([
       'message'   => 'Record Updated Successfully',
       'class_name'  => 'alert alert-success',
       'status'=>'ok'
      ]);   
   //  return redirect()->back()->with('success', ['Publisher Updated Successfully']);   
     }else{
         
          return response()->json([
       'message'   => $validator->errors()->all(),
       'uploaded_image' => '',
       'class_name'  => 'alert alert-danger',
       'status'=>'notok'
      ]); 
    //  return redirect()->back()->with('failure', $validator->errors()->all());
         
     }


  }
  public function update_publisher(Request $request){
     

   $validator = Validator::make($request->all(), [
            'publisher_name'=>'required',
            'contact_person'=>'required',
            'contact_no'=>'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100, max_width=300,max_height=300',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1200,max_height=500',
        ]);
if($validator->passes())
     {
          
$logo_name='';
$banners='';
        
        $image = $request->file('logo');
            $destinationPath = public_path('/images/publisher_logo');
         
       if(!empty($image)){
         $image_logo = time().'_'.$_FILES["logo"]["name"];
         
         
          $img = Image::make($image->getRealPath());
                $img->resize(null, 50, function ($constraint) {
                 $constraint->aspectRatio();
              })->save($destinationPath.'/'.$image_logo);
        
       $logo_name=$image_logo;
       }
       
           $image = $request->file('banner');
           $destinationPath = public_path('/images/publisher_banners');
         
       if(!empty($image)){
         $image_banner = time().'_'.$_FILES["banner"]["name"];
         
         
          $img = Image::make($image->getRealPath());
                $img->resize(1200, 500, function ($constraint) {
                 $constraint->aspectRatio();
              })->save($destinationPath.'/'.$image_banner);
        
       $banners=$image_banner;
       }
    
            
      $user= User::find($request->user_id);
      $user->name=$request->publisher_name;
      //$user->email=$request->email;
     // $user->password=Hash::make($request->password);
      $user->save();

       

     $publisher= \App\Publisher::find($request->id);
    $publisher->pblctn_name=$request->publisher_name;
    $publisher->pblctn_addrs=$request->address;
    $publisher->cntct_psn_name=$request->contact_person;
    //$publisher->pblr_email_id=$request->email;
    
    $publisher->pblr_cntct_no=$request->contact_no;

    if($logo_name!=''){
       $publisher->pblr_logo=$logo_name;
    }
    if($banners!=''){
      $publisher->pblr_banner=$banners;
    }
       
    $publisher->pblr_about=$request->about;
     $publisher->save();

   


    return redirect()->back()->with('success', ['Publisher Updated Successfully']);   
     }else{
        
       return back()->withErrors($validator);
         
     }
     
     
 }
  public function delete_publisher($id,$user_id){

  	//echo $id;

 $user = User::findOrFail($user_id);
 
    $user->delete(); //DELETE OCCURS HERE AFTER RECORD FOUND
  	
$publisher = \App\Publisher::findOrFail($id);
 
    $publisher->delete(); //DELETE OCCURS HERE AFTER RECORD FOUND
  return redirect()->back()->with('success', ['Publisher deleted Successfully']);   
	



  	//echo $user_id;
  }

 public function profile(){

 return view('super_admin.my_profile');

 }
 public function activate_publisher($id){

  $publisher=\App\Publisher::find($id);
  if($publisher->status=='0'){
    $publisher->status=1;
  }else{

    $publisher->status=0;
  }
  
  $publisher->save();

  //$publisher->user_id;
  $my_user=\App\User::find($publisher->user_id);
  if($my_user->status=='0'){
     $my_user->status=1;
  }else{
   $my_user->status=0;

  }
 
  $my_user->save();


 if($my_user->status=='0'){
$pub_book=DB::table('tbl_accesscode')->where('p_id','=',$id)->update(["status"=>0]);

 }else{
$pub_book=DB::table('tbl_accesscode')->where('p_id','=',$id)->update(["status"=>1]);

 }
 if($my_user->status=='1'){
    return redirect()->back()->with('failure', ['Publisher De-Activated Successfully']);   

   }else{
    return redirect()->back()->with('Success', ['Publisher Activated Successfully']);   
   }
  
 }
 public function change_password(Request $request){
  
  $validator = Validator::make($request->all(), [
            'old_pass'=>'required',
            'password'=>'required_with:confirm_password|same:confirm_password|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-+]).{6,}$/',
            'confirm_password'=>'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
           
        ]);

if($validator->passes())
     {
   
   $p_id=$request->id;
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
          $obj_user->email=$email;
          $obj_user->password = \Hash::make($request->input('password'));
          $obj_user->save(); 

         $p_id=$request->id;
          $obj_user = Publisher::find($p_id);
          $obj_user->pblr_email_id=$email;
          $obj_user->pblr_pwd = $request->input('password');
          $obj_user->save(); 


\Session::put('pass_success', 'Your password Changed Successfully');
return response()->json([
       'message'   =>'Your password Changed Successfully',
       'class_name'  => 'alert alert-success',
       'status'=>'ok'
      ]);
      
         // return redirect()->back()->with('success_pass', ['You password Changed Successfully']);
        
        }else{

    \Session::put('pass_failure', 'Your Old Password Not Currect');
      return response()->json([
       'message'   =>'Your Old Password Not Currect',
       'class_name'  => 'alert alert-danger',
       'status'=>'notok'
      ]);

         //  return redirect()->back()->with('failure_pass', ['Your Old Password Not Currect']);

        }

     }else{

     \Session::put('pass_failure', 'You are unathorised');
       return response()->json([
       'message'   =>'You are unathorised',
       'class_name'  => 'alert alert-danger',
       'status'=>'notok'
      ]);
      // return redirect()->back()->with('failure_pass', ['You are unathorised']);

     }}else{
 \Session::put('pass_failure_array', $validator->errors()->all());
      return response()->json([
       'message'   =>$validator->errors()->all(),
       'class_name'  => 'alert alert-danger',
       'status'=>'notok'
      ]);

      // return back()->withErrors($validator);

     }
      
        
 }

}
