<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\EbookLicence;
use Illuminate\Support\Facades\Redirect;
use File;
use Auth;
use DB;
use Book;
use Subject;
class EbookLicenceController extends Controller
{
    //
   public function ebook_licence_list(){

       return view('ebooks.index');

   }




    public function store_licence_record(Request $request){
       //dd('ok');
        $book_info=  \App\Book::where('id',$request->access_code_id)->first();
         
        

        if($book_info->book_slug!=''){

         $path_check = public_path('html_templat/'.$book_info->book_slug.'/mobile/style/style.css');

        

    if(!File::exists($path_check)){

         $request->session()->put('failure_add', 'Record not Added becouse you not uploaded ebook data on location public/html_templat/'.$book_info->book_slug.'/');

        return Redirect::back()->with(['failure', 'Record not Added becouse you not uploaded ebook data on location public/html_templat/'.$book_info->book_slug.'/']);
       
    }else{
            
            $no_of_pages=$request->no_of_page;        
          $response=$this->set_configration($book_info->book_slug,$book_info->title,$no_of_pages);
        
        

         if($response=='1'){

          $user_type=$request->user_type;
       $publisher_id=$request->publisher_id;
       $pub_id=$request->p_id;
        if($user_type=='1'){
           $p_id=$pub_id;

        }elseif($user_type=='2'){
             $p_id=$publisher_id;

        }
          
        $data=new EbookLicence();
        $data->p_id=$p_id;
        $data->access_code_id=$request->access_code_id;
        $data->licence_type=implode(',',$request->licence_type);
        $data->no_licence=$request->no_of_licence;
        $data->licence_title=$book_info->book_slug;
        $data->licence_from=date('Y-m-d',strtotime($request->date_from));
        $data->licence_to=date('Y-m-d',strtotime($request->date_to));
        $data->created_at=date('Y-m-d h:i:s');
        $data->updated_at=date('Y-m-d h:i:s');
        
         $data->save();
          $request->session()->put('success_add', 'Record Added Successfully!');

        return Redirect::back()->with(['success', 'Record Added Successfully!']);

     

         }else{
             $request->session()->put('failure_add', 'Record Not Added!');

            return Redirect::back()->with(['failure', 'Record Not Added!']);

         }


       }
         
         }



    }
 public function set_configration($slug,$book_title,$no_of_pages){
 $oldMessage = "hindi_book2";
 $oldTitle="Hindi Book 2";
 $slug_name=$slug;
 $number_of_page=$no_of_pages;
     
 $resource_path = resource_path('/views/ebooks_templat/'.$slug);
 
     if(!File::isDirectory($resource_path)){
File::makeDirectory($resource_path, 0777, true, true);

$sourceFilePath=resource_path('/views/ebooks_templat/mobile.blade.php');
$destinationPath=resource_path('/views/ebooks_templat/'.$slug.'/mobile.blade.php');
$success = \File::copy($sourceFilePath,$destinationPath);

$sourcePath=resource_path('/views/ebooks_templat/'.$slug.'/mobile.blade.php');
$str_1_data=file_get_contents($sourcePath);

$str1_data=str_replace("$oldMessage", "$slug",$str_1_data);

file_put_contents($sourcePath, $str1_data);

$sourcePath2=resource_path('/views/ebooks_templat/'.$slug.'/mobile.blade.php');
$str_1_1_data=file_get_contents($sourcePath2);
$str1_1_data=str_replace("$oldTitle", "$book_title",$str_1_1_data);

file_put_contents($sourcePath, $str_1_1_data);

 }else{

$sourceFilePath=resource_path('/views/ebooks_templat/mobile.blade.php');
$destinationPath=resource_path('/views/ebooks_templat/'.$slug.'/mobile.blade.php');
$success = \File::copy($sourceFilePath,$destinationPath);

$sourcePath=resource_path('/views/ebooks_templat/'.$slug.'/mobile.blade.php');
$str_1_data=file_get_contents($sourcePath);

$str1_data=str_replace("$oldMessage", "$slug",$str_1_data);

file_put_contents($sourcePath, $str1_data);


$str_1_1_data=file_get_contents($sourcePath);
$str1_1_data=str_replace("$oldTitle", "$book_title",$str_1_1_data);

file_put_contents($sourcePath, $str_1_1_data);


    }


 if(!File::isDirectory($resource_path)){

        File::makeDirectory($resource_path, 0777, true, true);



    }
/////////////copy file master player css file in new ebook start/////////// 
$from_path_css_player1=public_path() . "/html_templat/master_config/style/player.css";

$destinationPath1=public_path()."/html_templat/".$slug_name."/mobile/style/player.css";
$success = \File::copy($from_path_css_player1,$destinationPath1);

$path_player_css = public_path()."/html_templat/".$slug_name."/mobile/style/player.css";
$str1=file_get_contents($path_player_css);

$str1=str_replace("$oldMessage", "$slug_name",$str1);

file_put_contents($path_player_css, $str1);
/////////////copy file master player css file in new ebook end/////////// 
/////////////copy file master style css  file in new ebook start/////////// 

$from_path_css_style=public_path() . "/html_templat/master_config/style/style.css";

$destinationPath2=public_path()."/html_templat/".$slug_name."/mobile/style/style.css";
$success = \File::copy($from_path_css_style,$destinationPath2);

$path_style_css = public_path()."/html_templat/".$slug_name."/mobile/style/style.css";
$str2=file_get_contents($path_style_css);

$str2=str_replace("$oldMessage", "$slug_name",$str2);
file_put_contents($path_style_css, $str2);
/////////////copy file master style css file in new ebook end/////////// 

///////copy file master template css file in new ebook start/////////// 

$from_path_css_template=public_path() . "/html_templat/master_config/style/template.css";

$destinationPath3=public_path()."/html_templat/".$slug_name."/mobile/style/template.css";
$success = \File::copy($from_path_css_template,$destinationPath3);

$path_template_css = public_path()."/html_templat/".$slug_name."/mobile/style/template.css";
$str3=file_get_contents($path_template_css);

$str3=str_replace("$oldMessage", "$slug_name",$str3);

file_put_contents($path_template_css, $str3);
/////////////copy file master template css file in new ebook end/////////// 

/////////////copy file master config js file in new ebook start/////////// 

$from_path_js_config=public_path() . "/html_templat/master_config/javascript/config.js";

$destinationPath4=public_path()."/html_templat/".$slug."/mobile/javascript/config.js";
$success = \File::copy($from_path_js_config,$destinationPath4);

$path_config_js = public_path()."/html_templat/".$slug."/mobile/javascript/config.js";
$str4=file_get_contents($path_config_js);

$str4=str_replace("$oldMessage", "$slug",$str4);
file_put_contents($path_config_js, $str4);

/////////////copy file master config js file in new ebook end/////////// 

/////////////copy file master config js file in new ebook start/////////// 

$configpath_config_js = public_path()."/html_templat/".$slug."/mobile/javascript/config.js";
$strconfig=file_get_contents($configpath_config_js);

              
$old_number_of_page='total_page';
$new_number_of_page=$number_of_page;

$configstr4=str_replace("$old_number_of_page", "$new_number_of_page",$strconfig);
file_put_contents($configpath_config_js, $configstr4);

/////////////copy file master config js file in new ebook end/////////// 

/////////////copy file master main js file in new ebook start/////////// 

$from_path_js_main=public_path() . "/html_templat/master_config/javascript/main.js";

$destinationPath5=public_path()."/html_templat/".$slug_name."/mobile/javascript/main.js";
$success = \File::copy($from_path_js_main,$destinationPath5);

$path_main_js = public_path()."/html_templat/".$slug_name."/mobile/javascript/main.js";
$str5=file_get_contents($path_main_js);

$str5=str_replace("$oldMessage", "$slug_name",$str5);

file_put_contents($path_main_js, $str5);

 return 1;   
/////////////copy file master main js file in new ebook end/////////// 




 }
    public function update(Request $request){


    	$data = EbookLicence::firstOrCreate(['id' => $request->id]);
         $data->licence_type=implode(',',$request->licence_type);
        $data->no_licence=$request->no_of_licence;
        $data->licence_from=date('Y-m-d',strtotime($request->date_from));
        $data->licence_to=date('Y-m-d',strtotime($request->date_to));
        $data->updated_at=date('Y-m-d h:i:s');
        $data->save();
        return Redirect::back()->withErrors(['msg', 'The Message']);




    }
    public function delete($id){
       EbookLicence::where('id','=',$id)->delete();
       return Redirect::back()->withErrors(['msg', 'The Message']);
    }

    public function ebook_link($id,$ebook_id){
     $book_id= base64_decode($id);
     $ebook=base64_decode($ebook_id);

    
    $member_id=Auth::user()->id;

   $teacher_id=\App\Teacher::where('user_id',$member_id)->value('id');

    $today=date('Y-m-d');


 $current_date=date('Y-m-d');
 $sqlQuery = "SELECT * FROM book_issue_to_member WHERE member_id='$teacher_id' and book_id='$ebook' and (issue_from <= '$today' and issue_till>='$today')";

 
//echo $sqlQuery; die;
$result = DB::select(DB::raw($sqlQuery));


    if(!empty($result)){

    if (Auth::check()) {
    
    return File::get(public_path() . '/ebooks/html_templat/index.html');
     }else{

      return Redirect::back()->withErrors(['msg', 'You are not authorized user']);
     }

    }else{
       return Redirect::back()->withErrors(['msg', 'You are not eligible to access this book']);
      //echo 'You are not eligible to access this book';
    }
     
     
    }
}
