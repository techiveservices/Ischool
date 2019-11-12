@extends('super_admin.include.super_admin_dashboard_head')

@section('content')


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Publisher</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

<?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('admin/dist/img/user4-128x128.jpg')}}" class="profile-user-img img-responsive img-circle" alt="User Image" height="100px" width="300px">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="profile-user-img img-responsive img-circle" alt="User Image" height="100px" width="300px">
          @endif






             <!--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
 -->
 <?php $pblctn_name=\App\Publisher::where('user_id','=',$user_id)->value('pblctn_name');   ?>
              <h3 class="profile-username text-center">{{$pblctn_name}}</h3>

              <p class="text-muted text-center">
              @if($user_type=='1')

                Super Admin
              @endif
              @if($user_type=='2')

               Publisher
              @endif


              </p>

      
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <!--<div class="box-body">-->
     
            
            <!--</div>-->
             <?php $pblr_about=\App\Publisher::where('user_id','=',$user_id)->value('pblr_about');  

          $user_id=Auth::user()->id;  

              $publisher_info= \App\Publisher::where('user_id',$user_id)->first();


       ?>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" ><a href="#settings" data-toggle="tab">Profile</a></li>
              <li><a href="#activity" data-toggle="tab">Change Password</a></li>
             
           </ul>
            <div class="tab-content">
 <div class="tab-pane" id="activity">
               
     
 @if ($errors->any())
     @foreach ($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
<!-- <?php
   $pass_sess= \Session::get('pass_success');
   if($pass_sess!=''){ ?>

<div class="alert alert-success">{{$pass_sess}}</div>
 <?php  }   ?>


<?php
   $pass_failure= \Session::get('pass_failure');
   if($pass_failure!=''){ ?>

<div class="alert alert-danger">{{$pass_failure}}</div>
 <?php  }   ?> -->



 <div class="" id="reset_pass_error"></div>

 <form enctype="multipart/form-data" method="POST" id="reset_password_publisher" name="">
           
            @csrf
             <?php $pblr_about=\App\Publisher::where('user_id','=',$user_id)->value('pblr_about');  

          $user_id=Auth::user()->id;  

              $publisher_info= \App\Publisher::where('user_id',$user_id)->first();


       ?>
             <input type="hidden" name="user_id" value="{{ $publisher_info->user_id}}">
             <input type="hidden" name="id" value="{{ $publisher_info->id}}">
             <input type="hidden" name="email" value="{{ $publisher_info->pblr_email_id}}">

              <div class="box-body pt-2">
                
                     <div class="col-md-12 px-0">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="text" class="form-control" name="old_pass" id="old_pass" placeholder="Old Password" value="" required="">
                </div>
                    
                </div>
                 <div class="col-md-12 px-0">
                    <div class="form-group">
                  <label for="exampleInputEmail1">New Password </label>
                  <input type="text" class="form-control" name="password" id="new_pass" placeholder="New Password" value="" onchange="change_new_pass(this)" required="">
                  <span class="new_pass_mis d-none" style="color:red;"></span>
                </div>
                    
                </div>
                 <div class="col-md-12 px-0">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password </label>
                  <input type="text" class="form-control" name="confirm_password" id="c_password" placeholder="Confirm Password" value="" onchange="change_c_pass(this)" required="">
                  <span class="c_pass_mis d-none" style="color:red;"></span>


                    <b>*Password should be Minimum 6 character and must contain: Lowercase, Uppercase, Digit(0-9) and Special character (!,@,#,$,%,^,&,*,+,-)</b>


                </div>
                    
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
               

                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
               
              </div>
              <!-- /.tab-pane -->
              

              <div class="active  tab-pane" id="settings">
                  
                                 
           @if (\Session::has('success'))
    <div class="alert alert-success">
       
            <?php
               $msg=   \Session::get('success');
                 echo 'Profile Updated Successfully';
            ?>

          
    </div>
          @endif
            @if (\Session::has('failure'))
    <div class="alert alert-failure">
       
            <?php
               $msg=   \Session::get('failure');
                 echo 'Something Wend Wrong';
            ?>

          
    </div>
          @endif
                    
                    
                    @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
           
           
           
           
           
           
                  @if (\Session::has('success_new'))
    <div class="alert alert-success">
       
            <?php
               $msg=   \Session::get('success_new');
                 echo $msg[0];
            ?>

          
    </div>
          @endif
                    
           
            
              
               <form enctype="multipart/form-data" method="POST" action="{{ url('/publisher/update_publisher') }}"  name="update_publisher_info">
           
            @csrf
             <?php   

                    $user_id=Auth::user()->id;  

              $publisher_info= \App\Publisher::where('user_id',$user_id)->first();
                      
                          ?>
             <input type="hidden" name="user_id" value="{{$publisher_info->user_id}}">
             <input type="hidden" name="id" value="{{$publisher_info->id}}">

              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Publisher Name</label>
                  <input type="text" class="form-control" name="publisher_name" id="publisher_name" placeholder="Publisher Name" value="{{$publisher_info->pblctn_name}}">
                   </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <input type="text" class="form-control" name="address" value="{{$publisher_info->pblctn_addrs}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Conctact Person</label>
                  <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Concern Perosn" value="{{$publisher_info->cntct_psn_name}}">
                </div>
                 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Contact No</label>
                  <input type="text" class="form-control mobile" name="contact_no" id="exampleInputEmail1" placeholder="Contact Number" value="{{$publisher_info->pblr_cntct_no}}" onchange="checkmobile(this);" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    <span id="message" class="message" style="color: red;display:none"><small>Mobile no. should be of 10 digits only</small></span>
                </div>
                 <div class="wt-100 mb-3" style=" margin-bottom:15px;">
                  <label for="exampleInputEmail1">About Publishers</label>
                  <textarea class="form-control" name="about">{{$publisher_info->pblr_about}}</textarea>        
                </div>
                
                <div class="form-group" style="vertical-align: top;">
                   <label for="exampleInputFile">Logo </label><br>
                  <font style="size:6px;"><small>( jpeg/png/jpg/gif/svg | Max.Width=1000px | Max.Height=1000px )</small></font>
                  <input type="file" id="exampleInputFile"  class="logo" name="logo" accept="image/*">
                  
                <img  class="blah" src="@if($publisher_info->pblr_logo!=''){{ asset('images/publisher_logo/')}}/{{$publisher_info->pblr_logo}} @else  asset('images/image_not.png')}}   @endif" height="60px" width="60px" >
                
                </div>
                 <div class="form-group">
                  <label for="exampleInputFile">Banner</label><br>
                  <font style="6px;"><small>( jpeg/png/jpg/gif/svg | Width=1200 , Height=500 ) </small>       </font> 
                  <input type="file" id="exampleInputFile" class="banner" name="banner" accept="image/*">
           
           
             @if($publisher_info->pblr_banner!='')
           
             <img class="blah2" src="{{ asset('images/publisher_banners/')}}/{{$publisher_info->pblr_banner}}" height="60px" width="60px">
            @else
             <img class="blah2" src="{{asset('images/image_not.png')}} " height="60px" width="60px">
            
            @endif
                </div>
                
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->













@endsection