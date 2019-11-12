
@extends('school_dashboard.include.dashboard_head')
@section('content')
<style>
    .nav-item a:hover{
        
        color:#28a745 !important;
        
    }
</style>
<div class="container mt-5" >
	<div class="row">
        <div class="col-md-12">
        
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
   
   <li class="nav-item">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
      aria-selected="false">Profile</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" id="home-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="home"
      aria-selected="true">Security</a>
  </li>

  <!--<li class="nav-item">-->
  <!--  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"-->
  <!--    aria-selected="false">Contact</a>-->
  <!--</li>-->
</ul>
<div class="tab-content" id="myTabContent">
 
  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      
     <!--<div style="float:right;margin-top:10px;margin_bottum:10px;"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
     <!-- </div>            -->
      
           @if (\Session::has('success_new'))
    <div class="alert alert-success">
       
            <?php
               $msg=   \Session::get('success_new');
                 echo $msg[0];
            ?>

          
    </div>
          @endif
                    
                    
                    @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
 
 
              <div class="alert d-none" id="profile_error">sdsdf</div>
 
 
                <form enctype="multipart/form-data" method="POST"  id="school_profile">
           
            @csrf
             <?php   
              $user_id=Auth::user()->id;  
               $email=Auth::user()->email;  
              $school_info= \App\School::where('user_id',$user_id)->first();
          
                          ?>
             <input type="hidden" name="user_id" value="{{ $school_info->user_id}}">
             <input type="hidden" name="id" value="{{ $school_info->id}}">

              <div class="box-body" style="margin_top:25px;">
                <div class="row">
                     <div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="School Name" value="{{ $school_info->name}}">
                   <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                    
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $email}}" readonly>
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                    
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <input type="text" class="form-control" name="ph_no" id="ph_no" placeholder="Phone Number" value="{{ $school_info->contact}}">
                  <span class="text-danger">{{ $errors->first('contact') }}</span>
                </div>
                    
                </div>
        
                 
                <div class="col-md-12">
                     <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  
                  <textarea name="address" class="form-control" name="address" id="address" placeholder="Address">{{$school_info->address}}</textarea>
                 
                </div>
                    
                    
                </div>
                    
                    
                    
                </div>
               
              </div>
              <!-- /.box-body -->

            <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
            </div>
               <div class="box-footer">
                 <button type="submit" id="send_form" class="btn btn-success">Submit</button>
              </div>
            </form>
      </div>
       <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="home-tab">
            @if (\Session::has('success_new'))
    <div class="alert alert-success">
       
            <?php
               $msg=   \Session::get('success_new');
                 echo $msg[0];
            ?>

          
    </div>
          @endif
                    
                    
                    @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
         <div class="alert d-none" id="reset_pass_error">sdsdf</div>
 
                <form enctype="multipart/form-data" method="POST"  id="reset_school_password">
           
            @csrf
             <?php   
              $user_id=Auth::user()->id;  
              $teacher_info= \App\School::where('user_id',$user_id)->first();
          
                          ?>
             <input type="hidden" name="user_id" value="{{ $teacher_info->user_id}}">
             <input type="hidden" name="id" value="{{ $teacher_info->id}}">
               <input type="hidden" name="email" value="{{ $teacher_info->email}}">
              <div class="box-body">
                
                     <div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="text" class="form-control" name="old_pass" id="old_pass2" placeholder="Old Password" value="">
                </div>
                    
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputEmail1">New Password</label>
                  <input type="text" class="form-control" name="password" id="new_pass" placeholder="New Password" value="" onchange="change_new_pass(this)">
                    <span class="new_pass_mis" style="color:red;"></span>

                </div>
                    
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="text" class="form-control" name="confirm_password" id="c_password" placeholder="Confirm Password" value="" onchange="change_c_pass(this)">
                 <span class="c_pass_mis" style="color:red;"></span>


                 <label for="exampleInputEmail1"> <font style="color:red">*</font> Password (Must include 1 lowercase,1 uppercase,1 digit and 1 special character with minimum lenght 6)</label>

                </div>
                    
                </div>
             
              
          
             
                    
                    
                    
               
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
       </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Contact Us Section</div>
</div>
        
        

        </div>


	</div>
</div>



    @endsection