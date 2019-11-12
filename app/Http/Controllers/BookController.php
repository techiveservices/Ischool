<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Publisher;
use \App\Book;
use \App\User;
//Use DB;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect;
use \App\Chapter;
use Auth;
use File;
use Image;
Use Session;

class BookController extends Controller
{
    //

  public function index(){
   
    
     //  session()->forget('success_add');
     $subject=DB::table('subjects')->get();
     $classes=DB::table('classes')->get();
     
     $user_type=Auth::user()->account_type;
     if($user_type=='2'){
        // $series=DB::table('tbl_series_info')->get();
         $series=array();
         
     }else{

         $series=array();
     }
     
     
     //dd($subject);
  	return view('access_code.index',compact('subject','classes','series'));
  }

 public function add_book(Request $request){
  
 $validator = Validator::make($request->all(), [
      'book_pdf' =>'mimes:pdf|max:10000',
      'book_img' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1000,max_height=1000',
        ]);

if($validator->passes())
     {
          
$book_pdf='';
$book_img='';
$manual='';
        $image = $request->file('book_pdf');
        if(!empty($image)){
             $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/book_pdf');
        $image->move($destinationPath, $input['imagename']);
         $book_pdf=time().'.'.$image->getClientOriginalExtension();
            
        }

        $image = $request->file('book_img');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/book_img');
       
   if(!File::exists($destinationPath)) File::makeDirectory($destinationPath, 775);
        $img = Image::make($image->getRealPath());
        $img->resize(null, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
            
        $book_img=time().'.'.$image->getClientOriginalExtension();
        }
        $image = $request->file('manual');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/manual');
        $image->move($destinationPath, $input['imagename']);
       
        $manual=time().'.'.$image->getClientOriginalExtension();
        }

  if($request->user_type=='1'){

  	$pid=$request->p_id;
  }elseif($request->user_type=='2'){
    $pid=$request->publisher_id;
  }
     $subject_info=\App\Subject::where('id',$request->subject)->first();
         $slug=$subject_info->slug_name;

         $class_info=\App\Classes::where('id',$request->class)->first();
         $class=$class_info->name;

         $book_slug=$slug.'_'.$class;

    $book_id= \App\Book::all()->last()->id;
              $all_books=\App\Book::all();
              if(!empty($all_books)){
          $newbook_id=$book_id+1;

              }else{
                $newbook_id=1;
              }
    
    $book=new \App\Book();
        $book->p_id=$pid;
        $book->title=$request->title;
        $book->subject= $request->subject;
        $book->Series=$request->series;
        $book->class=$request->class;
        $book->book_pdf=$book_pdf;
        $book->book_img=$book_img;
        $book->manual=$manual;
        $book->ebook=$request->ebook;
        $book->animation= $request->animation;
        $book->author=$request->author;
        $book->book_desc=$request->book_desc;
        $book->price=$request->price;
        $book->isbn=$request->isbn;
        $book->c_isbn=$request->c_isbn;
        $book->access_code=$request->accesscode;
        // $book->strt_yr=date('Y',strtotime($request->licence_from));
        // $book->strt_mnth=date('m',strtotime($request->licence_from));
        // $book->end_yr=date('Y',strtotime($request->licence_to));
        // $book->end_mnth=date('m',strtotime($request->licence_to));
        // $book->licence_from=date('Y-m-d',strtotime($request->licence_from));
        // $book->licence_to=date('Y-m-d',strtotime($request->licence_to));
        //$book->book_slug=$book_slug.'_'.$newbook_id;
        
        $book->save();

            $book2= \App\Book::find($book->id);
            $book2->book_slug=$book_slug.'_'.$book->id;
            $book2->save();

           $directory_name=$book2->book_slug;
        if($book2->book_slug!=''){
        $path = public_path().'/html_templat/' . $directory_name;
        File::makeDirectory($path, $mode = 0777, true, true);
        
        }

   $chapters=$request->chapter_name;

   $ch_no=$request->ch_no;
  
   if(!empty($chapters)){
    $i=1;
   foreach($chapters as $key=>$value){
      $last_row = DB::table('tbl_chapter')->where('p_id','=',$pid)->where('access_code','=',$book->id)->orderBy('id', 'DESC')->first();
      
       $ch=new Chapter();
       $ch->p_id=$pid;
       $ch->access_code=$book->id;
       if(!empty($last_row)){
        $ch->ch_no=$i;
       }else{
        $ch->ch_no=$i;
       }
       $ch->ch_name=$value;
       $ch->save();

       $i=$i+1; 
   }
   
   }
     
     // $request->session()->put('success_add', 'Book Created Successfully');


       return response()->json([
       'message'   => 'Book Created Successfully',
       'uploaded_image' => '<img src="public/images/book_img/'.$book_img.'" class="img-thumbnail" width="300" />',
       'class_name'  => 'alert alert-success',
       'status'=>'ok'
      ]);   
 //return redirect()->back()->with('success', ['Accesscode Added Successfully']);   
             
         
     }else{
         
          // $request->session()->put('not_add', 'Book Created Successfully');
       return response()->json([
       'message'   => $validator->errors()->all(),
       'uploaded_image' => '',
       'class_name'  => 'alert alert-danger',
       'status'=>'notok'
      ]);
         
     }

 //return redirect()->back()->with('success', ['Accesscode Added Successfully']);   


  }
  public function edit_book(Request $request){

      
 $this->validate($request, [
      'book_pdf' =>'mimes:pdf|max:10000',
      'book_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1000,max_height=1000',
      'manual'=> 'mimes:pdf|max:10000',
        ]);
$book_pdf='';
$book_img='';
$manual='';


        $image = $request->file('book_pdf');

        if(!empty($image)){
        	$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/book_pdf');
        $image->move($destinationPath, $input['imagename']);
       
        $book_pdf=time().'.'.$image->getClientOriginalExtension();

        }
        
        $image = $request->file('book_img');
        if(!empty($image)){
$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/book_img');
        // $image->move($destinationPath, $input['imagename']);
       

        $img = Image::make($image->getRealPath());
        $img->resize(null, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        $book_img=$input['imagename'];
  
        }
        

        $image = $request->file('manual');
        if(!empty($image)){

        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/manual');
        $image->move($destinationPath, $input['imagename']);
       
        $manual=time().'.'.$image->getClientOriginalExtension();

        }
  
  if($request->user_type=='1'){

  	$sno=$request->sno;
  }elseif($request->user_type=='2'){
    $pid=$request->publisher_id;
  }
    //\App\Publisher::find($request->id);
    $book= \App\Book::find($request->sno);
        $book->title=$request->title;
        $book->subject= $request->subject;
        $book->Series=$request->series;
        $book->class=$request->class;
        if($book_pdf!=''){
        	$book->book_pdf=$book_pdf;
        }
        if($book_img!=''){
        	 $book->book_img=$book_img;
        }
        if($manual!=''){

        	$book->manual=$manual;
        }
        $book->ebook=$request->ebook;
        $book->animation= $request->animation;
        $book->author=$request->author;
        $book->book_desc=$request->book_desc;
        $book->price=$request->price;
        $book->isbn=$request->isbn;
        $book->access_code=$request->accesscode;
        // $book->strt_yr=date('Y',strtotime($request->licence_from));
        // $book->strt_mnth=date('m',strtotime($request->licence_from));
        // $book->end_yr=date('Y',strtotime($request->licence_to));
        // $book->end_mnth=date('m',strtotime($request->licence_to));
        // $book->licence_from=date('Y-m-d',strtotime($request->licence_from));
        // $book->licence_to=date('Y-m-d',strtotime($request->licence_to));
              
        $book->save();
 return redirect()->back()->with('success', ['Book Updated Successfully!']);   



  }

  public function delete_book($id){
    $book = \App\Book::findOrFail($id);
 
    $book->delete(); //DELETE OCCURS HERE AFTER RECORD FOUND
  return redirect()->back()->with('success', ['Book deleted Successfully']);   

  }
  public function activate_book($id,$status){
 $book= \App\Book::find($id);
 $book->status=$status;
 $book->save();
 return redirect()->back()->with('success', ['Book Status Changed Successfully']);   
  }

public function fetchcode(Request $request){

    $data = DB::table('tbl_accesscode')
       ->where('p_id','=', $request->p_id)
       ->where('status','=','1')
       ->get();
     $output = '<option value="">Select Accesscode</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->access_code.'('.$row->title.')</option>';
     }
     echo $output;

}

public function fetch_series(Request $request){
  $data = DB::table('tbl_series_info')
       ->where('p_id','=', $request->p_id)
       ->where('subject_id','=', $request->sub_id)
       ->get();
     $output = '<option value="">Select Series</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->series.'</option>';
     }
     echo $output;

}
public function assign_accesscode(){

  return view('access_code.assign_to_teacher');
}


}
