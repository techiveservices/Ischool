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
        <li class="active">My profile</li>
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


        
          <img src="{{ asset('images/techive.png')}}" class="profile-user-img img-responsive img-circle" alt="User Image">
                
         <!--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
 -->
 <?php $pblctn_name=\App\School::where('user_id','=',$user_id)->value('name');   ?>
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
            <div class="box-body">
      <?php   
      $user_id=Auth::user()->id;  
      $school_info= \App\School::where('user_id',$user_id)->first();



      ?>
            <strong><i class="fa fa-key margin-r-5"></i> Change Password</strong> 

       @if (\Session::has('success'))
    <div class="alert alert-success">
       
            <?php
               $msg=   \Session::get('success');
                 echo $msg[0];
            ?>

          
    </div>
@endif
@if (\Session::has('failure'))
    <div class="alert alert-warning">
        
              <?php
$msg2=   \Session::get('failure');
                 echo $msg2[0];
 ?>

          
    </div>
@endif

<form method="post" action="{{ url('publisher/change_password')}}">
              @csrf
     <input type="hidden" name="p_id" value="{{$school_info->id}}">
    <input type="hidden" name="user_id" value="{{$school_info->user_id}}">
      <div class="wt-100">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{$school_info->pblr_email_id}}">
                </div>
                 <div class="wt-100">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="password" class="form-control" name="old_password" id="password" placeholder="Old Password" value="">
                </div>
                <div class="wt-100">
                  <label for="exampleInputEmail1">New Password</label>
                  <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" value="">
                </div>
             <div class="form-group" style="margin-top: 10px;">
                 <button type="submit" class="btn btn-primary">Submit</button>

             </div>

            </form>       

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" ><a href="#settings" data-toggle="tab">Personal</a></li>
              <li><a href="#activity" data-toggle="tab">Logo</a></li>
              <li><a href="#timeline" data-toggle="tab">Banner</a></li>
           </ul>
            <div class="tab-content">
              <div class="tab-pane" id="activity">
               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
               
              </div>
              <!-- /.tab-pane -->

              <div class="active  tab-pane" id="settings">
                  <form method="POST" enctype="multipart/form-data" action="{{ url('/school/update')}}">
          @csrf
           <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;
        $school_info=\App\School::where('user_id','=',$user_id)->first();
     $pub_id= \App\Publisher::where('id','=',$school_info->p_id)->value('id'); 
    
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}" id="user_type">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif" id="publisher_id">

        <input type="hidden" name="id" value="<?php echo $school_info->user_id; ?>">
        <input type="hidden" name="my_user_id" value="<?php echo $school_info->user_id; ?>">



          <div class="row">
           
           @if($user_type!='2')
            
           <div class="form-group">
                <label style="width:100%;">Publication</label>
                <select class="form-control select2" name="p_id" id="p_id" style="width:100%;">
                  

                  <?php   $list= \App\Publisher::where('status','=',1)->get();  
                          $user_type=Auth::user()->account_type;
                          if($user_type=='2'){
                          $user_id=Auth::user()->id;
                          $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
                          }elseif($user_type=='1'){
                         $user_id=0;
                          $pub_id=0;

                          }

                      


                       ?>
                   @if(!empty($list))
                   @foreach($list as $list2)

<option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @elseif($school_info->p_id==$list2->id)  selected=""  @endif >{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>

              </div>
              @endif
             
          
           <div class="form-group">
                <label>School Name:</label>
                <input type="text" name="s_name" class="form-control" placeholder="School Name" autocomplete="off" value="{{$school_info->name}}" >
              </div>
             
           <div class="form-group">
                <label>Board/University:</label>
                <input type="text" name="board_university" class="form-control" placeholder="Board University" required="" autocomplete="off" value="{{$school_info->university}}" >
              </div>
             
               <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off" value="{{$school_info->address}}" >
              </div>
              
               <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact_no" class="form-control" placeholder="Contact Number" autocomplete="off" value="{{$school_info-> contact}}">
              </div>
             
               <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" autocomplete="off" value="{{$school_info->contact_person}}">
              </div>
              
              

            </div>
            <div class="row">
              <div class="col-lg-12">
               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </div>
            </div>
            <!-- /.col -->
          

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