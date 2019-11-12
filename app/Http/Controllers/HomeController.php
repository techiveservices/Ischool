<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Charts;
use \App\User;
use \App\School;
use \App\Book;
use DB;
use \App\BookReader;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

          $response=$this->free_e_book();

        $user_info=Auth::user()->account_type;
         $user_id= Auth::user()->id;

       
        if($user_info=='1' || $user_info=='2' ){
        
        if($user_info=='1')  {
           $chart1 = Charts::database(BookReader::all(), 'pie', 'highcharts')
    ->title('Book Reader Montly Wise')
    ->elementLabel("Monthly wise book reader")
    ->dimensions(600, 300)
    ->responsive(false)
    ->groupByMonth(date('Y'));



        }elseif($user_info=='2'){
         
         $p_id=\App\Publisher::where('user_id',$user_id)->value('id');

       $p_school_list=\App\School::where('p_id',$p_id)->get();
       $ar=array();
       foreach($p_school_list as $list){
        array_push($ar, $list->id);

       }
          $items = DB::table('e_book_reader')->whereIn('school_id', $ar)->get();


        $chart1 = Charts::database($items, 'pie', 'highcharts')
    ->title('Book Reader Montly Wise')
    ->elementLabel("Monthly wise book reader")
    ->dimensions(600, 300)
    ->responsive(false)
    ->groupByMonth(date('Y'));
        }


     if($user_info=='1'){
         $chart2 = Charts::database(BookReader::all(), 'line', 'highcharts')
    ->title('Book Reader Montly Wise')
    ->elementLabel("Monthly wise book reader")
    ->dimensions(600, 300)
    ->responsive(false)
    ->groupByMonth(date('Y'));

     }elseif($user_info=='2'){

     $p_id=\App\Publisher::where('user_id',$user_id)->value('id');

       $p_school_list=\App\School::where('p_id',$p_id)->get();
       $ar=array();
       foreach($p_school_list as $list){
        array_push($ar, $list->id);

       }
          $items2 = DB::table('e_book_reader')->whereIn('school_id', $ar)->get();

       $chart2 = Charts::database($items2, 'line', 'highcharts')
    ->title('Book Reader Montly Wise')
    ->elementLabel("Monthly wise book reader")
    ->dimensions(600, 300)
    ->responsive(false)
    ->groupByMonth(date('Y'));
     }
    if($user_info=='2'){
        
       $user_id= Auth::user()->id;
        $p_id=\App\Publisher::where('user_id',$user_id)->value('id');
        
        
        $chart3 = Charts::database(School::where('p_id',$p_id)->get(), 'bar', 'highcharts')
          ->title('Schools')
          ->elementLabel("Monthly wise School created")
          ->dimensions(400, 300)
          ->responsive(false)
          ->groupByMonth(date('Y'));
        
    }elseif($user_info=='1'){
         $chart3 = Charts::database(School::all(), 'bar', 'highcharts')
           ->title('Schools')
           ->elementLabel("Monthly wise School created")
           ->dimensions(400, 300)
           ->responsive(false)
           ->groupByMonth(date('Y'));
        
    }
      
     if($user_info=='1'){
     $chart4 = Charts::database(BookReader::all(), 'line', 'highcharts')
           ->title('Book Reader')
           ->elementLabel("Daily wise Book reader")
           ->dimensions(600, 300)
           ->responsive(false)
          ->dateFormat('j F')
          ->lastByDay(14, true);
        }elseif($user_info=='2'){
        
        
     $p_id=\App\Publisher::where('user_id',$user_id)->value('id');

       $p_school_list=\App\School::where('p_id',$p_id)->get();
       $ar=array();
       foreach($p_school_list as $list){
        array_push($ar, $list->id);

       }
          $items4 = DB::table('e_book_reader')->whereIn('school_id', $ar)->get();

           $chart4 = Charts::database($items4, 'line', 'highcharts')
           ->title('Book Reader')
           ->elementLabel("Daily wise Book reader")
           ->dimensions(600, 300)
           ->responsive(false)
           // ->dateFormat('j F y')
           ->dateFormat('j F')
          ->lastByDay(14, true);


        }
          
              
        
    return view('super_admin.super_dashboard',['chart1' => $chart1,'chart2'=>$chart2,'chart3'=>$chart3,'chart4'=>$chart4]);

        }elseif($user_info=='3'){
           // return view('home');
            return view('teacher_dashboard.index');
        }elseif($user_info=='4'){
           // return view('home');
            return view('school_dashboard.index');
        }else{
          return view('home');

        }
        //return view('home');
    }

    public function free_e_book(){

      $current=  date("Y-m-d H:i:s");
      $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." -10 minutes"));
      
 $inactive_record= \DB::table('e_book_reader')->where('status','=','0')->get();
 $active_record= \DB::table('e_book_reader')->where('login_at','>',$newTime)->get();

    
   foreach($inactive_record as $list){
    
$record= \DB::table('sessions')->where('id','=',$list->session_id)->get(); 
$record1= \DB::table('sessions')->where('id','=',$list->session_id)->first();

  $cnt=count($record);
  if($cnt=='0'){

    \DB::table('e_book_reader')->where('id','=',$list->id)->update(["logout_at"=>$current,"status"=>1]);
  }else{
     
   $user_last_activity= date("Y-m-d H:i:s", $record1->last_activity);
   $current=  date("Y-m-d H:i:s");
   $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." -10 minutes"));
   
   if($user_last_activity<$newTime){

   \DB::table('e_book_reader')->where('session_id','=',$list->session_id)->update(["logout_at"=>$current,"status"=>1]);

   $record4= \DB::table('sessions')->where('id','=',$list->session_id)->delete();
   }

  }        
    }



    }
}
