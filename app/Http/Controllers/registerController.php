<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
 use DB;
 use Auth;
class registerController extends Controller
{
    ////view
    public function index(){
    	 
    	$fetchRows = Register::paginate(3);
    	//print_r($fetchRows);
    	return view('registers.index',compact('fetchRows'));
    	//return view('registers.index');
    }
        //save
    public function save(Request $request){
    //dd($request->all());
     $errors = $this->validate($request,[
               'name'=>'required|max:15|min:3',
               'email'=>'required|email|unique:registers,email',
               'mobile'=>'required|numeric|min:10',
               'image'=>'required'
      ]);
     if($request->hasFile('image') && $request->image->isValid()){
      $extension = $request->image->extension();
      $filename = time().'_'.$extension;
      $request->image->move(public_path('images'),$filename);
     }else{
      $filename ='no image';
     }
    
    	$data = new Register;
      
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->mobile = $request->mobile;
      $data->image = $filename;
    	$insert = $data->save();
    	if($insert){
    		return redirect('/reg')->with('success_message','Data Inserted Successfully!');
    	}else{
      return redirect('/reg')->with('error_message','Somthing Error,Try agian!');
    	}
      

    }
    //delete
    public function delete($id){
           $delete = Register::find($id);
           $deleted = $delete->delete();
           if($deleted){
           	return redirect('/reg')->with('success_message','Data Deleted Successfully!');
           }else{
      return redirect('/reg')->with('error_message','Somthing Error,Try agian!');
    	}
    }
    //edit
    public function edit($id){
         //echo $id;
    	$fetchData = Register::find($id);


         return view('registers.edit',compact('fetchData'));
    }
    //update
    public function update(Request $request){
          //dd($request->all());
       if($request->hasFile('image') && $request->image->isValid()){
      $extension = $request->image->extension();
      $filename = time().'_'.$extension;
      $request->image->move(public_path('images'),$filename);
     }else{
      $filename = $request->pre_image;
     }
          
    	$updateData = Register::find($request->edit_id);
    	 $updateData->name = $request->name;
    	$updateData->email = $request->email;
    	$updateData->mobile = $request->mobile;
    	$updateData->status = $request->status;
      $updateData->image = $filename;
    	 $updated = $updateData->save();
    	 if($updated){
    	 	 return redirect('reg');
    	 }else{
    	 	 return redirect('/reg')->with('error_message','Somthing Error,Try agian!');
    	 }
    }
    //login index
    public function login_index(){
        return view('registers.login');
    }
 
       //login
    public function login(Request $request){

          //dd($request->all());
           $email = $request->email;
           $mobile = $request->mobile;
           $sel = db::select('select * from registers where email=? and mobile=?',[$email,$mobile]);
           //$user  = db::table('registers')->get();
           // print_r($user);
          // echo '<pre>';
         // print_r($sel);
          //print_r($sel[0]->name);
           $count = count($sel);
          if($count == 1){
            return view('registers.login',compact('sel'));
            //return redirect('/mylogin')->with('success_message','Hi '.$sel[0]->name.' You are Login');
            
          }else{
             return redirect('/mylogin')->with('error_message','Somthing Error,Try agian!');
          }
    }
    //logout
    public function logout(){
      $session_id = session()->getId();

     
      $curdate=date('Y-m-d h:i:s');
     \DB::table('e_book_reader')->where('session_id',$session_id)->update(["logout_at"=>$curdate,"status"=>1]);

   
        Auth::logout();
      


      return redirect('/');
    }

}//class
