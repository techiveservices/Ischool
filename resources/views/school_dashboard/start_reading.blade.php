
	@extends('school_dashboard.include.dashboard_head')

@section('content')
	<section class="e-zone"> <!-- body section -->
		<div class="container">
			<div class="row">

<?php
            $user_id=Auth::user()->id;

              $session_id = session()->getId();
              $ip= \Request::ip();
              //echo $licence_id;
            $active_reader= \DB::table('e_book_reader')->where('user_id',$user_id)->where('book_id',$licence_id)->where('status','=','0')->count();
              //echo  $licence=json_decode($licence_id);
              
        $school_id=  \App\School::where('user_id',$user_id)->value('id');

          $assign= \App\EbookAssigned::where('id','=',$licence_id)->get();
          
         foreach($assign as $value){
          $ebook_licence_info=\App\EbookLicence::where('id','=',$value->ebook_id)->first();
         
           //  print_r($ebook_licence_info->access_code_id);

           $assigned_book_info= \App\Book::where('id','=',$ebook_licence_info->access_code_id)->first(); 

     
     ?>
	<div class="col-sm-12 mx-auto mb-5 pb-5 border-bottom">
		<div class="row">
	 <div class="col-sm-3">		
		 <div class="col-sm-12">
       <a href="#" data-toggle="modal" data-target="#myModal_<?php echo $assigned_book_info->id;        ?>">
						<div class="card text-center">
						  
						  <img class="card-img-top" src="{{ asset('images/book_img')}}/{{$assigned_book_info->book_img}}" alt="Card image cap">
						
						</div>
					</a>
					
		 </div>
		 <div class="col-sm-6 ">
            
				 
		
                    
		 </div>
		</div>
		<div class="col-sm-9">
       
         <h4>No of Licence</h4>
       <?php
     //echo $value->no_of_licence;

         for($i=0;$i<$value->no_of_licence;$i++){

        
          ?>
        

  <button type="button" class="btn <?php if($i<$active_reader){ echo 'btn-danger'; }else{  ?> btn-primary  <?php }?>" style="margin-top: 10px;" data-toggle="modal" data-target="<?php if($i<$active_reader){ echo ''; }else{  ?> #access_licence  <?php }?>">
    <?php if($i<$active_reader){ echo 'Reader Active'; }else{  ?> start reading  <?php }?>
   <span class="badge badge-danger ml-2"></span>
  <span class="sr-only">unread messages</span>
</button>

        <?php }
       ?>



		</div>
      
		</div>

    </div>
			

				
				

		<?php    }  ?>
			
				
			</div>
		</div>
	</section>	

<!-- Modal -->
<div class="modal fade" id="access_licence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reader Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post" id="start_read_form" action="{{ url('/school/reader_start_reading')}}">
           @csrf

       <input type="text" name="ip_address" class="d-none" value="{{$ip}}">
        <input type="text" name="user_id" class="d-none" value="{{$user_id}}">

         <input type="text" name="licence_id" class="d-none" value="{{$licence_id}}">

         <input type="text" name="school_id" class="d-none" value="{{$school_id}}">
         <input type="text" name="session_id" class="d-none" value="{{$session_id}}">

          <div class="form-group d-block" id="email_id">
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email" required />
          </div>
          <div class="form-group d-none" id="otp_test2">
            <input type="text" class="form-control" id="otp_test" value=""/>
          </div>
           <div class="form-group d-none" id="otp2">
            <input type="text" class="form-control" id="otp" placeholder="Enter 6 digit Otp Here" value="" />
          </div>
           <div class="form-group">
          <button type="button" class="btn btn-secondary" id="start_read_submit">Submit</button>
          </div>
       


      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection





