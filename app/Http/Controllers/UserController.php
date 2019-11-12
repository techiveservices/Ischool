<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use File;
class UserController extends Controller
{
    //
      public function index(){
        
        return view('welcome');
        
    }
    public function about(){
  
  
        return view('about');
    }
    public function AuthRouteAPI(Request $request){
    return $request->user();
 }
 public function replace_matching_string($slug,$book_title){
 $oldMessage = "hindi_book2";
 $oldTitle="Hindi Book 2";

 $slug_name=$slug;

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

/////////////copy file master confid js file in new ebook start/////////// 


$from_path_js_config=public_path() . "/html_templat/master_config/javascript/config.js";

$destinationPath4=public_path()."/html_templat/".$slug_name."/mobile/javascript/config.js";
$success = \File::copy($from_path_js_config,$destinationPath4);


$path_config_js = public_path()."/html_templat/".$slug_name."/mobile/javascript/config.js";
$str4=file_get_contents($path_config_js);

$str4_1=str_replace("$oldMessage", "$slug_name",$str4);
file_put_contents($path_config_js, $str4_1);
$str4_2=str_replace("$oldTitle", "$book_title",$str4);
file_put_contents($path_config_js, $str4_2);

/////////////copy file master config js file in new ebook end/////////// 


/////////////copy file master main js file in new ebook start/////////// 

$from_path_js_main=public_path() . "/html_templat/master_config/javascript/main.js";

$destinationPath5=public_path()."/html_templat/".$slug_name."/mobile/javascript/main.js";
$success = \File::copy($from_path_js_main,$destinationPath5);

$path_main_js = public_path()."/html_templat/".$slug_name."/mobile/javascript/main.js";
$str5=file_get_contents($path_main_js);

$str5=str_replace("$oldMessage", "$slug_name",$str5);

file_put_contents($path_main_js, $str5);

 return redirect()->back();   
/////////////copy file master main js file in new ebook end/////////// 




 }
}
