<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use \App\Classes;
use PDF;
use App;
use File;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use Excel;
class QuestionController extends Controller
{
    //

    public function index(){
        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_long_quest')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_long_quest')->whereIn('access_code_id',$code)->get();
    
     
         }
     
    	return view('question_upload.index',compact('list'));
    }
    public function index2(){
       // $list=DB::table('tbl_sort_question')->get();
       
        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_sort_question')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_sort_question')->whereIn('access_code_id',$code)->get();
    
     
         }

    	return view('question_upload.index2',compact('list'));
    }
    public function index3(){
       // $list=DB::table('tbl_mcq_question')->get();

        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_mcq_question')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_mcq_question')->whereIn('access_code_id',$code)->get();
    
     
         }

    	return view('question_upload.index3',compact('list'));
    }
     public function index4(){
       // $list=DB::table('tbl_true_false_question')->get();

        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_true_false_question')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_true_false_question')->whereIn('access_code_id',$code)->get();
    
     
         }

    	return view('question_upload.index4',compact('list'));
    }
     public function index5(){
      // $list=DB::table('tbl_fill_in_blanks')->get();

        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_fill_in_blanks')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_fill_in_blanks')->whereIn('access_code_id',$code)->get();
    
     
         }
    	return view('question_upload.index5',compact('list'));
    }
     public function index6(){
       //  $list=DB::table('tbl_match_column_question')->get();

        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_match_column_question')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_match_column_question')->whereIn('access_code_id',$code)->get();
    
     
         }
    	return view('question_upload.index6',compact('list'));
    }
     public function index7(){
       // $list=DB::table('tbl_one_word_question')->get();
        $user_id=Auth::user()->id;
        $user_type=Auth::user()->account_type;

        if($user_type=='1'){
         $list=DB::table('tbl_one_word_question')->get();

        }elseif($user_type=='2'){

         
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->get(); 
      
       $code=array();
       foreach($access_code as $val){

       	array_push($code,$val->id);
       }
            $my_code='['.implode(',', $code).']';
            
           
       $list=DB::table('tbl_one_word_question')->whereIn('access_code_id',$code)->get();
    
     
         }

    	return view('question_upload.index7',compact('list'));
    }


    public function add_long_question(Request $request){
    	
    	$question_no=$request->input('ques_no');
        $question_list=$request->input('quest');
        $anslist=$request->input('ans');

        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        $question_count= count($question_list);
       
       //echo $question_count;die;
        $ar=array();

        for($i=0;$i<$question_count;$i++){
            
             $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $i+1,
                        'ques' => $question_list[$i],
                        'ans' => $anslist[$i],
                        ];
                array_push($ar,$insert_long);

        }
        $insertData = DB::table('tbl_long_quest')->insert($ar);
        
        // echo '<br>';


    }
    public function add_short_question(Request $request){
        $question_no=$request->input('ques_no');
        $question_list=$request->input('quest');
        $anslist=$request->input('ans');

        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        $question_count= count($question_list);
       
       //echo $question_count;die;
        $ar=array();

        for($i=0;$i<$question_count;$i++){
            
             $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $i+1,
                        'ques' => $question_list[$i],
                        'ans' => $anslist[$i],
                        ];
                array_push($ar,$insert_long);

        }
        $insertData = DB::table('tbl_sort_question')->insert($ar);
        
        // echo '<br>';



    }
    public function add_mcq_question(Request $request){
        

      $this->validate($request, [
      'option_a_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'option_b_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'option_c_img'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'option_d_img'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

      $option_a_img='';
      $option_b_img='';
      $option_c_img='';
      $option_d_img='';

        $image = $request->file('option_a_img');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_a_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_a_img=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('option_b_img');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_b_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_b_img=time().'.'.$image->getClientOriginalExtension();
     }
        
        $image = $request->file('option_c_img');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_c_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_c_img=time().'.'.$image->getClientOriginalExtension();
       }

       $image = $request->file('option_d_img');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_d_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_d_img=time().'.'.$image->getClientOriginalExtension();
       }

        $access_code=$request->access_code_id;
        $chapter_id= $request->chapter_id;

         $ques_no= $request->ques_no;
         $ques= $request->ques;
         $option_a= $request->option_a;
         $option_b= $request->option_b;
         $option_c= $request->option_c;
         $option_d= $request->option_d;


        $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' =>$chapter_id,
                        'ques_no' => $ques_no,
                        'ques' => $ques,
                        'a' => $option_a,
                        'a_img'=>$option_a_img,
                        'b' => $option_b,
                        'b_img'=>$option_b_img,
                        'c' => $option_c,
                        'c_img'=>$option_c_img,
                        'd' => $option_d,
                        'd_img'=>$option_d_img,
                        'ans' => $request->ans,
                        ];

              $insertData = DB::table('tbl_mcq_question')->insert($insert_long);
        
             return back();


    }
    public function add_tf_question(Request $request){

        $question_no=$request->input('ques_no');
        $question_list=$request->input('ques');
        $anslist=$request->input('ans');
        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        $question_count= count($question_list);
       
       //echo $question_count;die;
        $ar=array();

        for($i=0;$i<$question_count;$i++){
            
             $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $i+1,
                        'ques' => $question_list[$i],
                        'a'=>1,
                        'b'=>0,
                        'ans' => $anslist[$i],
                        ];
                array_push($ar,$insert_long);

        }
        $insertData = DB::table('tbl_true_false_question')->insert($ar);
        
        // echo '<br>';

    }
    public function add_fill_blanks_question(Request $request){

       $question_no=$request->input('ques_no');
        $question_list=$request->input('quest');
        $anslist=$request->input('ans');

        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        $question_count= count($question_list);
       
       //echo $question_count;die;
        $ar=array();

        for($i=0;$i<$question_count;$i++){
            
             $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $i+1,
                        'ques' => $question_list[$i],
                        'ans' => $anslist[$i],
                        ];
                array_push($ar,$insert_long);

        }
        $insertData = DB::table('tbl_fill_in_blanks')->insert($ar);
        
        // echo '<br>';
    }
    public function add_o_w_question(Request $request){
      $question_no=$request->input('ques_no');
        $question_list=$request->input('quest');
        $anslist=$request->input('ans');

        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        


        $question_count= count($question_list);
       
       //echo $question_count;die;
        $ar=array();

        for($i=0;$i<$question_count;$i++){
            
             $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $i+1,
                        'ques' => $question_list[$i],
                        'ans' => $anslist[$i],
                        ];
                array_push($ar,$insert_long);

        }
        $insertData = DB::table('tbl_one_word_question')->insert($ar);
        


    }
    public function add_match_question(Request $request){
     
      
        $question_no=$request->input('ques_no');
        
        $sub_a=$request->input('sub_a');
        $col_a=$request->input('col_a');
        $sub_b=$request->input('sub_b');
        $col_b=$request->input('col_b');
        $anslist=$request->input('ans');

        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        $question_count= count($anslist);
      
      $ar=array();

        for($i=0;$i<$question_count;$i++){
            $insert_long = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => $sub_a[$i],
                        'col_a' => $col_a[$i],
                        'col_a_img' =>'',
                        'sub_b' => $sub_b[$i],
                        'col_b' => $col_b[$i],
                        'col_b_img' =>'',
                        'ans' => $anslist[$i],
                        ];
                array_push($ar,$insert_long);

        }



      
        $insertData = DB::table('tbl_match_column_question')->insert($ar);
        



    }
    public function add_match_col_question_img(Request $request){

    
        $question_no=$request->input('ques_no');
        $access_code=$request->input('access_code_id');
        $chapter_id= $request->input('chapter_id');
        

        $sub_a_1=$request->input('sub_a_1');
        $col_a_1=$request->input('col_a_1');
        $sub_b_1=$request->input('sub_b_1');
        $col_b_1=$request->input('col_b_1');
        $anslist_1=$request->input('ans_1');   
                  
      $this->validate($request, [
      'col_a_img_1' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_1' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_1='';
      $col_b_img_1='';

        $image = $request->file('col_a_img_1');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_1=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_1');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_1=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_1!='' || $col_a_img_1!='') && ($col_b_1!='' || $col_b_img_1!='')){

         $insert_long_1 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 1,
                        'col_a' => $col_a_1,
                        'col_a_img' =>$col_a_img_1,
                        'sub_b' => 'a',
                        'col_b' => $col_b_1,
                        'col_b_img' =>$col_b_img_1,
                        'ans' => $anslist_1,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_1);

         }
     


        $sub_a_2=$request->input('sub_a_2');
        $col_a_2=$request->input('col_a_2');
        $sub_b_2=$request->input('sub_b_2');
        $col_b_2=$request->input('col_b_2');
         $anslist_2=$request->input('ans_2');    
                  
      $this->validate($request, [
      'col_a_img_2' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_2' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_2='';
      $col_b_img_2='';

        $image = $request->file('col_a_img_2');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_2=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_2');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_2=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_2!='' || $col_a_img_2!='') && ($col_b_2!='' || $col_b_img_2!='')){

         $insert_long_2 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 2,
                        'col_a' => $col_a_2,
                        'col_a_img' =>$col_a_img_2,
                        'sub_b' => 'b',
                        'col_b' => $col_b_2,
                        'col_b_img' =>$col_b_img_2,
                        'ans' => $anslist_2,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_2);

         }
           

     
        $sub_a_3=$request->input('sub_a_3');
        $col_a_3=$request->input('col_a_3');
        $sub_b_3=$request->input('sub_b_3');
        $col_b_3=$request->input('col_b_3');
         $anslist_3=$request->input('ans_3');    
                  
      $this->validate($request, [
      'col_a_img_3' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_3' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_3='';
      $col_b_img_3='';

        $image = $request->file('col_a_img_3');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_3=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_3');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_3=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_3!='' || $col_a_img_3!='') && ($col_b_3!='' || $col_b_img_3!='')){

         $insert_long_3 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 3,
                        'col_a' => $col_a_3,
                        'col_a_img' =>$col_a_img_3,
                        'sub_b' => 'c',
                        'col_b' => $col_b_3,
                        'col_b_img' =>$col_b_img_3,
                        'ans' => $anslist_3,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_3);

         }
           
        $sub_a_4=$request->input('sub_a_4');
        $col_a_4=$request->input('col_a_4');
        $sub_b_4=$request->input('sub_b_4');
        $col_b_4=$request->input('col_b_4');
        $anslist_4=$request->input('ans_4');    
                  
      $this->validate($request, [
      'col_a_img_4' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_4' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_4='';
      $col_b_img_4='';

        $image = $request->file('col_a_img_4');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_4=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_4');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_4=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_4!='' || $col_a_img_4!='') && ($col_b_4!='' || $col_b_img_4!='')){

         $insert_long_4 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 4,
                        'col_a' => $col_a_4,
                        'col_a_img' =>$col_a_img_4,
                        'sub_b' =>'d',
                        'col_b' => $col_b_4,
                        'col_b_img' =>$col_b_img_4,
                        'ans' => $anslist_4,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_4);

         }
    
       $sub_a_5=$request->input('sub_a_5');
        $col_a_5=$request->input('col_a_5');
        $sub_b_5=$request->input('sub_b_5');
        $col_b_5=$request->input('col_b_5');
        $anslist_5=$request->input('ans_5');    
                  
      $this->validate($request, [
      'col_a_img_5' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_5' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_5='';
      $col_b_img_5='';

        $image = $request->file('col_a_img_5');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_5=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_5');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_5=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_5!='' || $col_a_img_5!='') && ($col_b_5!='' || $col_b_img_5!='')){

         $insert_long_5 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 5,
                        'col_a' => $col_a_5,
                        'col_a_img' =>$col_a_img_5,
                        'sub_b' => 'e',
                        'col_b' => $col_b_5,
                        'col_b_img' =>$col_b_img_5,
                        'ans' => $anslist_5,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_5);

         }

        $sub_a_6=$request->input('sub_a_6');
        $col_a_6=$request->input('col_a_6');
        $sub_b_6=$request->input('sub_b_6');
        $col_b_6=$request->input('col_b_6');
        $anslist_6=$request->input('ans_6');    
                  
      $this->validate($request, [
      'col_a_img_6' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_6' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_6='';
      $col_b_img_6='';

        $image = $request->file('col_a_img_6');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_6=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_6');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_6=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_6!='' || $col_a_img_6!='') && ($col_b_6!='' || $col_b_img_6!='')){

         $insert_long_6 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 6,
                        'col_a' => $col_a_6,
                        'col_a_img' =>$col_a_img_6,
                        'sub_b' => 'f',
                        'col_b' => $col_b_6,
                        'col_b_img' =>$col_b_img_6,
                        'ans' => $anslist_6,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_6);

         }

        $sub_a_7=$request->input('sub_a_7');
        $col_a_7=$request->input('col_a_7');
        $sub_b_7=$request->input('sub_b_7');
        $col_b_7=$request->input('col_b_7');
        $anslist_7=$request->input('ans_7');    
                  
      $this->validate($request, [
      'col_a_img_7' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_7' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_7='';
      $col_b_img_7='';

        $image = $request->file('col_a_img_7');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_7=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_7');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_7=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_7!='' || $col_a_img_7!='') && ($col_b_7!='' || $col_b_img_7!='')){

         $insert_long_7 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 7,
                        'col_a' => $col_a_7,
                        'col_a_img' =>$col_a_img_7,
                        'sub_b' => 'g',
                        'col_b' => $col_b_7,
                        'col_b_img' =>$col_b_img_7,
                        'ans' => $anslist_7,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_7);

         }
    
      
    
        $sub_a_8=$request->input('sub_a_8');
        $col_a_8=$request->input('col_a_8');
        $sub_b_8=$request->input('sub_b_8');
        $col_b_8=$request->input('col_b_8');
        $anslist_8=$request->input('ans_8');    
                  
      $this->validate($request, [
      'col_a_img_8' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img_8' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img_8='';
      $col_b_img_8='';

        $image = $request->file('col_a_img_8');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img_8=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img_8');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img_8=time().'.'.$image->getClientOriginalExtension();
     }
     
         if(($col_a_8!='' || $col_a_img_8!='') && ($col_b_8!='' || $col_b_img_8!='')){

         $insert_long_8 = [
                        'access_code_id'=>$access_code,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $question_no,
                        'sub_a' => 8,
                        'col_a' => $col_a_8,
                        'col_a_img' =>$col_a_img_8,
                        'sub_b' => 'h',
                        'col_b' => $col_b_8,
                        'col_b_img' =>$col_b_img_8,
                        'ans' => $anslist_8,
                        ];
        
      
        $insertData = DB::table('tbl_match_column_question')->insert($insert_long_8);

         }
        
      return back();

    }
  public function delete_question($table,$id){
 
  DB::table($table)->where('id','=',$id)->delete();
  
  return redirect()->back()->with('success', ['deleted Successfully']);   


    }
    public function edit_question(Request $request){
           $id=$request->id;
           $table=$request->tb_name;
           $q_type=$request->q_type;

           if($q_type=='1'){
           
            $ques=$request->ques;
            $ans=$request->ans;
            DB::table($table)->where('id','=',$id)->update(['ques' => $ques,'ans'=>$ans]);   

            return back();
           }
            if($q_type=='2'){
           
            $ques=$request->ques;
            $ans=$request->ans;
            DB::table($table)->where('id','=',$id)->update(['ques' => $ques,'ans'=>$ans]);   

            return back();
           }
           if($q_type=='3'){
           $this->validate($request, [
      'option_a_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'option_b_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'option_c_img'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'option_d_img'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

      $option_a_img='';
      $option_b_img='';
      $option_c_img='';
      $option_d_img='';

        $image = $request->file('option_a_img');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_a_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_a_img=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('option_b_img');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_b_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_b_img=time().'.'.$image->getClientOriginalExtension();
     }
        
        $image = $request->file('option_c_img');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_c_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_c_img=time().'.'.$image->getClientOriginalExtension();
       }

       $image = $request->file('option_d_img');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/option_d_img');
        $image->move($destinationPath, $input['imagename']);
       
        $option_d_img=time().'.'.$image->getClientOriginalExtension();
       }

        $access_code=$request->access_code_id;
        $chapter_id= $request->chapter_id;

         $ques_no= $request->ques_no;
         $ques= $request->ques;
         $option_a= $request->option_a;
         $option_b= $request->option_b;
         $option_c= $request->option_c;
         $option_d= $request->option_d;
        $data['ques']=$ques;
        $data['a']=$option_a;
        if($option_a_img!=''){
        	$data['a_img']=$option_a_img;
        }
        
        $data['b']=$option_b;
        if($option_b_img!=''){
        	$data['b_img']=$option_b_img;
        }
        
        $data['c']=$option_c;
        if($option_c_img!=''){
        $data['c_img']=$option_c_img;
        }
        $data['d']=$option_d;
        if($option_d_img!=''){
        $data['d_img']=$option_d_img;
       }
        $data['ans']=$request->ans;
       

          $insertData = DB::table($table)->where('id','=',$id)->update($data);
        
             return back();






           }
           if($q_type=='4'){
           $data2['ques']=$request->ques;
           $data2['ans']=$request->ans;

      $insertData = DB::table($table)->where('id','=',$id)->update($data2);
        
             return back();



           }
           if($q_type=='5'){

           $data3['ques']=$request->ques;
           $data3['ans']=$request->ans;

      $insertData = DB::table($table)->where('id','=',$id)->update($data3);
        
             return back();


           }
           if($q_type=='6'){

                 $this->validate($request, [
      'col_a_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'col_b_img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      
        ]);

      $col_a_img='';
      $col_b_img='';
        $image = $request->file('col_a_img');
        if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_a_img=time().'.'.$image->getClientOriginalExtension();
       }
       
       $image = $request->file('col_b_img');
       if(!empty($image)){
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/match_column');
        $image->move($destinationPath, $input['imagename']);
       
        $col_b_img=time().'.'.$image->getClientOriginalExtension();
     }

          
           $data6['sub_a']=$request->sub_a;
           $data6['col_a']=$request->col_a;

           if($col_a_img!=''){
           	$data6['col_a_img']=$col_a_img;
           }
           
           $data6['sub_b']=$request->sub_b;
           $data6['col_b']=$request->col_b;
           if($col_b_img!=''){
           $data6['col_b_img']=$col_b_img;
            }
           $data6['ans']=$request->ans;
      $insertData = DB::table($table)->where('id','=',$id)->update($data6);
        
             return back();


           }
           if($q_type=='7'){

           $ques=$request->ques;
            $ans=$request->ans;
            DB::table($table)->where('id','=',$id)->update(['ques' => $ques,'ans'=>$ans]);   

            return back();

           }

    }
    public function get_ques_no(Request $request){

     $accesscode= $request->accesscode;
     $class_name= $request->class_id;
     $chapter= $request->ch_id;
     
      $class_id= Classes::where('name','=',$class_name)->value('id');
      
     $tbl_record=DB::table('tbl_match_column_question')->where('access_code_id','=',$accesscode)->where('chapter_id','=',$chapter)->orderBy('id', 'desc')->limit(1)->value('ques_no');  

   
      if(!empty($tbl_record)){

        echo $tbl_record;
      }else{
        echo '0';
      }
     


    }

    public function genrate_pdf(Request $request){
      
       $userId= Auth::user()->id;
       $filename2 = md5(date('Y-m-d H:i:s:u'));
       $filename = $filename2."_"."test_paper_{$userId}";

       $filename2 = $filename2."_"."test_paper_{$userId}"."_with_answer_copy";

       $new_file=$filename.'.pdf';

       $new_file_ans=$filename.'_with_answer_copy'.'.pdf';


        $data=array(
       "user_id"=>$userId,
      "title"=>$request->title,
      "subject"=>$request->subject,
      "class_id"=>$request->classes,
      "mm"=>$request->mm,
      "paper_date"=>$request->date,
      "duration"=>$request->duration,
      "chapter"=>$request->chapter,
      "long_title"=>$request->long_title,
      "long_mark"=>$request->long_marks,
      "long_list"=>$request->long_list,
      "long_do_any"=>$request->long_do_any,
      "long_count"=>$request->long_count,
      "long_total"=>$request->long_total,
      "short_title"=>$request->short_title,
      "short_mark"=>$request->short_marks,
      "short_list"=>$request->short_list,
       "short_do_any"=>$request->short_do_any,
       "short_count"=>$request->short_count,
      "short_total"=>$request->short_total,
      "mcq_title"=>$request->mcq_title,
      "mcq_mark"=>$request->mcq_marks,
      "mcq_list"=>$request->mcq_list,
       "mcq_do_any"=>$request->mcq_do_any,
       "mcq_count"=>$request->mcq_count,
      "mcq_total"=>$request->mcq_total,
       "tf_title"=>$request->tf_title,
      "tf_marks"=>$request->tf_marks,
      "tf_list"=>$request->tf_list,
       "tf_do_any"=>$request->tf_do_any,
       "tf_count"=>$request->tf_count,
      "tf_total"=>$request->tf_total,
      "fill_title"=>$request->fill_title,
      "fill_mark"=>$request->fill_marks,
      "fill_list"=>$request->fill_list,
      "fill_do_any"=>$request->fill_do_any,
      "key_required"=>$request->key_required,
      "fill_count"=>$request->fill_count,
      "fill_total"=>$request->fill_total,
      "match_title"=>$request->match_title,
      "match_mark"=>$request->match_marks,
      "match_list"=>$request->match_list,
      "match_do_any"=>$request->match_do_any,
      "match_count"=>$request->match_count,
      "match_total"=>$request->match_total,
      "ow_title"=>$request->ow_title,
      "ow_mark"=>$request->ow_marks,
      "ow_list"=>$request->ow_list,
      "ow_do_any"=>$request->ow_do_any,
      "ow_count"=>$request->ow_count,
      "ow_total"=>$request->ow_total,
      "pdf_file"=>$new_file,
      "pdf_file_ans"=>$new_file_ans,
     "total_ques"=>$request->all_ques_count,
     "total_mark"=>$request->all_ques_mark
    );

         $tbl_record=DB::table('gen_pdf')->insert($data);  
  
 
        $path = public_path('pdf/test_paper');

        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0755, true, true);

        } 
        else {}
        $customPaper = array(0,0,720,1440);
        $pdf = PDF::loadView('my_test_paper', compact('data'))->setPaper($customPaper,'portrait')->save(''.$path.'/'.$filename.'.pdf');
        ;


       $path2 = public_path('pdf/test_paper_answer');

        if(!File::exists($path2)) {
            File::makeDirectory($path2, $mode = 0755, true, true);

        } 
        else {}
        $customPaper = array(0,0,720,1440);
        $pdf2 = PDF::loadView('my_test_paper_wise_ans', compact('data'))->setPaper($customPaper,'portrait')->save(''.$path2.'/'.$filename2.'.pdf');
        ;

      //  return $pdf->download(''.$filename.'.pdf');
    $test_paper_name=$request->title.'_'.$request->classes.'_'.$request->subject.'.pdf';

    $test_paper_name2=$request->title.'_'.$request->classes.'_'.$request->subject.'_ans.pdf';




 
 Mail::send('email.feedback', compact('data'), function($message) use($pdf,$pdf2,$test_paper_name,$test_paper_name2)
{
    $message->from('support@techive.in', 'Techive Pvt Ltd');

    $message->to('varun_laravel@techive.in')->subject('Test Paper');

    $message->attachData($pdf->output(), $test_paper_name);
    $message->attachData($pdf2->output(), $test_paper_name2);
});
      
    }
    public function bulk_question(){

   return view('question_upload.bulk_import');


    }

    public function bulk_import(Request $request){
       //validate the xls file

        $accesscode=$request->access_code;
        $chapter_id=$request->chapter_id;
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
         if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
             

              $data_long = Excel::selectSheets('LONG')->load($path, function($reader) {
                })->get();
              //dd($data_long);
          if(!empty($data_long) && $data_long->count()){
 
                    foreach ($data_long as $key => $value) {
                        $insert_long[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' =>$chapter_id,
                        'ques_no' => $value->quesno,
                        'ques' => $value->long_question,
                        'ans' => $value->answer,
                        ];

                        
                    }
                 if(!empty($insert_long)){
 
                        $insertData = DB::table('tbl_long_quest')->insert($insert_long);
                       
                    }
                }





         $data_sort = Excel::selectSheets('SHORT')->load($path, function($reader) {
                })->get();


        if(!empty($data_sort) && $data_sort->count()){
 
                    foreach ($data_sort as $key => $value) {
                        $insert_short[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $value->quesno,
                        'ques' => $value->short_question,
                        'ans' => $value->answer,
                        ];

                        
                    }
                 if(!empty($insert_short)){
 
                   $insertData = DB::table('tbl_sort_question')->insert($insert_short);
                       
                    }
                }






         $data_mcq = Excel::selectSheets('MCQ')->load($path, function($reader) {
                })->get();

         if(!empty($data_mcq) && $data_mcq->count()){
 
                    foreach ($data_mcq as $key => $value) {
                        $insert_mcq[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $value->quesno,
                        'ques' => $value->mcq_question,
                        'a' => $value->option_a,
                        'b' => $value->option_b,
                        'c' => $value->option_c,
                        'd' => $value->option_d,
                        'ans' => $value->answer,
                        ];

                        
                    }
                 if(!empty($insert_mcq)){
 
                   $insertData = DB::table('tbl_mcq_question')->insert($insert_mcq);
                       
                    }
                }

         $data_true_false = Excel::selectSheets('TRUE_FALSE')->load($path, function($reader) {
                })->get();

        if(!empty($data_true_false) && $data_true_false->count()){
 
                    foreach ($data_true_false as $key => $value) {
                        $insert_tf[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $value->quesno,
                        'ques' => $value->true_false_question,
                        'a' => 1,
                        'b' => 0,
                        'ans' => $value->answer,
                        ];

                        
                    }
                 if(!empty($insert_tf)){
 
                   $insertData = DB::table('tbl_true_false_question')->insert($insert_tf);
                       
                    }
                }


         $data_fill_blanks = Excel::selectSheets('FILL_UPS')->load($path, function($reader) {
                })->get();

              if(!empty($data_fill_blanks) &&  $data_fill_blanks->count()){
 
                    foreach ($data_fill_blanks as $key => $value) {
                        $insert_fblanks[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $value->quesno,
                        'ques' => $value->fill_ups_question,
                        'ans' => $value->answer,
                        ];

                        
                    }
                 if(!empty($insert_fblanks)){
 
            $insertData = DB::table('tbl_fill_in_blanks')->insert($insert_fblanks);
                       
                    }
                
              }


               $data_one_word = Excel::selectSheets('ONE_WORD')->load($path, function($reader) {
                })->get();

              if(!empty($data_one_word) &&  $data_one_word->count()){
 
                    foreach ($data_one_word as $key => $value) {
                        $insert_one_word[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $value->quesno,
                        'ques' => $value->one_word_question,
                        'ans' => $value->answer,
                        ];
                        
                    }
                 if(!empty($insert_one_word)){
 
            $insertData = DB::table('tbl_one_word_question')->insert($insert_one_word);
                       
                    }
                
              }

               $data_match_the_column = Excel::selectSheets('MATCH_COLUMNS')->load($path, function($reader) {
                })->get();

              if(!empty($data_match_the_column) &&  $data_match_the_column->count()){
 
                    foreach ($data_match_the_column as $key => $value) {
                        $insert_match_column[] = [
                        'access_code_id'=>$accesscode,
                        'chapter_id' => $chapter_id,
                        'ques_no' => $value->quesno,
                        'sub_a' => $value->sno_a,
                        'col_a' => $value->column_a,
                        'sub_b' => $value->sno_b,
                        'col_b' => $value->column_b,
                        'ans' => $value->answer,
                        ];

                        
                    }
                 if(!empty($insert_match_column)){
 
            $insertData = DB::table('tbl_match_column_question')->insert($insert_match_column);
                       
                    }
                
              }
          

         return back();

      }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }





    }

    public function bulk_question_delete(){

       return view('question_upload.bulk_question_delete');
    }
    public function question_bulk_delete(Request $request){
       $book_id=$request->access_code;
       $chapter_id=$request->chapter_id;


      $long_quest= \App\LongQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();

       \App\LongQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();

      $short_quest=\App\ShortQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();

       \App\ShortQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();


      $mcq_quest= \App\McqQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();

       \App\McqQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();

      $tf_quest= \App\TfQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();

       \App\TfQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();

      $match_quest= \App\MatchQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();

       \App\MatchQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();


       $fill_quest=\App\fillQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();

       \App\fillQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();

        $ow_quest=\App\OnewordQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->count();


       \App\OnewordQuestion::where('access_code_id','=',$book_id)->where('chapter_id',$chapter_id)->delete();

         $total=$long_quest+$short_quest+$mcq_quest+$tf_quest+$match_quest+$fill_quest+$ow_quest;
       
        return redirect()->back()->with('success', ['Total Number Of Question deleted is '.$total]); 
       

    }
}
