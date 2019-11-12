
	@extends('school_dashboard.include.dashboard_head')

<style>
/*.licence_button{

 border-radius: 50% !important;
 width: 50px; height: 50px; 

}*/
.read-more-btn{
background: transparent;
border-radius: 10px;
color: white;
}
.circle {
  display: block;
  background: black;
  border-radius: 50% !important;
  height: 50px;
  width: 50px;
  margin: 0;

  font-style:1.2rem !important; color: #fff !important; font-weight: bold !important;
  background: radial-gradient(circle at 100px 100px, #00ff3a, #054614);
}
.after-color{background: radial-gradient(circle at 100px 100px, #00ff3a, #054614);}

.active_after_color{background: radial-gradient(circle at 100px 100px, #fc081c, #e80c1e);}
</style>

@section('content')
	<section class="e-zone"> <!-- body section -->
		<div class="container">
			<div class="row">

@if(\Session::get('failure_availability'))
          <div class="alert alert-danger">
            <?php   echo  $msg= \Session::get('failure_availability');   

                 

                 ?>
              
          </div>
         @endif

<?php
              \Session::forget('failure_availability');
           
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
       $session_id = session()->getId();
       $user_id=Auth::user()->id;
       $school_id=  \App\School::where('user_id',$user_id)->value('id');
       
     $today=  date("Y-m-d");

      $assign= \App\EbookAssigned::where('school_id','=',$school_id)->whereDate('valid_from','<=',$today)->whereDate('valid_till','>=',$today)->get();
          
          foreach($assign as $value){
          $ebook_licence_info=\App\EbookLicence::where('id','=',$value->ebook_id)->first();


           $assigned_book_info= \App\Book::where('id','=',$ebook_licence_info->access_code_id)->first(); 

     
     ?>
	<div class="col-sm-12 mx-auto mb-5 pb-5 border-bottom">
		<div class="row bg-light py-4">
		 <div class="col-sm-3">
       <a href="#" data-toggle="modal" data-target="#myModal_<?php echo $assigned_book_info->id;  ?>">
						<div class="card text-center">
						  
						  <img class="card-img-top" src="{{ asset('images/book_img')}}/{{$assigned_book_info->book_img}}" alt="Card image cap" style="max-width:400px; max-height: 300px;">
						
						</div>
					</a>
					
		 </div>
		 <div class="col-sm-9 ">
            <div class="row">
			<div class="col-sm-12">
           <ul class="list-group list-group-flush" style="display:block!important; width:100%;">

		 
          <li class="list-group-item text-left" style="width:100%;"><strong style="font-size: 20px;">{{$assigned_book_info->title}} <br><sub class="text-capitalize">({{$assigned_book_info->author}})</sub></strong></li>

		<!--  <li class="list-group-item text-left"><strong>SUBJECT:</strong></li> -->
		  <li class="list-group-item text-left text-capitalize" style="width:100%;">

<?php           
        $subject_info=  \App\Subject::where('id','=',$assigned_book_info->subject)->first();

 ?>
 <?php           
        $class_info=  \App\Classes::where('id','=',$assigned_book_info->class)->first();

                         ?>


                            {{$subject_info->name}}, {{$class_info->name}}</li>
						    <!-- <li class="list-group-item text-left"><strong>CLASS:</strong></li> -->
						  

<!-- <li class="list-group-item text-left"><strong>ISBN:</strong></li> -->
<li class="list-group-item text-left p-0 m-0" style="width:100%;">
  @if($assigned_book_info->isbn!='')
   <span>Isbn:</span>{{$assigned_book_info->isbn}},
  @endif
  @if($assigned_book_info->c_isbn!='')
  <span>E-Isbn:</span> {{$assigned_book_info->c_isbn}}
  @endif

  </li>

<!-- <li class="list-group-item text-left"><strong>C-ISBN:</strong></li> -->
<li class="list-group-item text-left" style="width:100%;"><strong>
  


  
</strong></li>




<li class="list-group-item text-left" style="width:100%; text-transform: inherit;"><p><!-- {{$assigned_book_info->book_desc}} -->
<p style="font-size:14px;" class="text-height-fixed">

<?php   echo $desc=$assigned_book_info->book_desc;   ?>


</p>

<!-- <?php    $desc=$assigned_book_info->book_desc; 

$stlen= strlen($desc);

$small = substr($desc, 0, 200); 
 
 if($stlen>200){ 

$small2 = substr($desc, 200, $stlen); 
 $moreclass='read-more-btn more-link more_text_append_'.$value->id;
 $data='more_text_append_'.$value->id;
  ?>
  
  


 
   {{ucfirst($small)}}<span class=" more_text_2_{{ $value->id}} d-inline-block ">......</span><span class="more_text_{{ $value->id}} d-none"><?php echo $small2;   ?></span> <b><a class="{{$moreclass}}"  onclick="readmore('<?php echo $data ;?>')">+ Read More</a></b>

 <?php }else{ ?>
   
   <span> <?php echo $desc;   ?> </span>
<?php }

?>

</p> -->


            

 </li>


<?php
  $active_users= count($active_record);

?>


						  </ul>


			</div>
      <?php
     $session_id = session()->getId();
              $ip= \Request::ip();

    $check_old=\DB::table('e_book_reader')->where('session_id',$session_id)->where('ip',$ip)->where('book_id',$value->id)->where('status','=','0')->count();


        $total_licence=$value->no_of_licence;
     
     $active_reader=\DB::table('e_book_reader')->where('school_id',$school_id)->where('book_id',$value->id)->where('status','=','0')->count();



      ?>
  @if($total_licence>$active_reader)
        <div class="col-sm-12">
                <div class="btn btn-info" data-toggle="modal" data-target="<?php if($check_old=='0'){  ?>#access_licence_<?php echo $value->id;   ?>  <?php }?>" style="cursor: pointer;">
        Start Reading
      </div>
        </div>
  @else
  <div class="col-sm-12">
   <span>
    No Active Licence available
  </span>
   </div>
  @endif
    </div>
  </div>
			<div class="col-sm-12 mt-3">
              
       <?php
     //echo $value->no_of_licence;

         for($i=0;$i<$value->no_of_licence;){
               $user_id=Auth::user()->id;

              $session_id = session()->getId();
              $ip= \Request::ip();
              //echo $licence_id;
            $active_reader= \DB::table('e_book_reader')->where('user_id',$user_id)->where('book_id',$value->id)->where('status','=','0')->count();
              //echo  $licence=json_decode($licence_id);
              
        $school_id=  \App\School::where('user_id',$user_id)->value('id');

        $check_old=\DB::table('e_book_reader')->where('session_id',$session_id)->where('ip',$ip)->where('book_id',$value->id)->where('status','=','0')->count();
        //echo $check_old;

         ?> 



  <button type="button" class="btn circle <?php if($i<$active_reader){ echo 'active_after_color'; }else{  ?> after-color  <?php }?> licence_button" style="margin-top: 10px;cursor: default; box-shadow: 0px 3px 3px #000;" >
    <?php if($i<$active_reader){  }else{  ?>  <?php }?>
   <span class="badge badge-danger ml-2"></span>
  <span class="sr-only"></span>
  <?php
   $i++;
  ?>
  {{{$i}}}
</button>

        <?php }
       ?>


			</div>	
			    
<!-- <?php
    $licence_id= base64_encode($value->id);

?>

                       <a href="{{ url('/school/start_reading/'.$value->id)}}" target="_blank">
						   <button type="button" class="btn btn-primary mt-2">Start Reading</button>
					   </a> -->


		</div>

    </div>
			
<!-- Modal -->
<div class="modal fade" id="access_licence_<?php echo $value->id;   ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reader Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post" class="start_read_form_<?php echo $value->id;   ?>" id="start_read_form_<?php echo $value->id;   ?>" action="{{ url('/school/reader_start_reading')}}" target="_blank">
           @csrf

       <input type="text" name="ip_address" class="d-none" value="{{$ip}}">
        <input type="text" name="user_id" class="d-none" value="{{$user_id}}">

         <input type="text" name="licence_id" class="d-none" value="{{$value->id}}">

         <input type="text" name="school_id" class="d-none" value="{{$school_id}}">
         <input type="text" name="session_id" class="d-none" value="{{$session_id}}">

          
          <div class="form-group d-block" id="name">
            <input type="text" name="name" class="form-control name" id="name_<?php echo $value->id;   ?>" placeholder="Enter Your Name" required />
          </div>
          <div class="form-group email_id_<?php echo $value->id;   ?> d-block" id="email_id_<?php echo $value->id;   ?>">
            <input type="email" name="email" class="form-control email_<?php echo $value->id;   ?>" id="email_<?php echo $value->id;   ?>" placeholder="Enter Your Email" required />
          </div>
          <div class="form-group otp_test2_<?php echo $value->id;   ?> d-none" id="otp_test2_<?php echo $value->id;   ?>">
            <input type="text" class="form-control otp_test_<?php echo $value->id;   ?>" id="otp_test_<?php echo $value->id;   ?>" name="otp_test" value=""/>
          </div>
           <div class="form-group otp2_<?php echo $value->id;   ?> d-none" id="otp2_<?php echo $value->id;   ?>">
            <input type="text" class="form-control otp_<?php echo $value->id;   ?>" id="otp_<?php echo $value->id;   ?>" placeholder="Enter 6 digit Otp Here" value="" name="otp" />
          </div>
           <div class="form-group">
          <button type="button" class="btn btn-secondary start_read_submit" id="start_read_submit_<?php echo $value->id;   ?>">Submit</button>
          </div>
       


      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
				
				

		<?php    }  ?>
			
				
			</div>
		</div>
	</section>	


@endsection





