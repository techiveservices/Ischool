
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
       
      </h1>
     
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
  

            <div class="box-header">
             <!--  <h3 class="box-title">Publishers</h3> -->

             

            </div>
    
        

            <!-- /.box-header -->
            <div class="box-body">


 


@if (\Session::has('success'))
    <div class="alert alert-success">
       
            <?php
               $msg=   \Session::get('success');
                 echo $msg[0];
            ?>

          
    </div>
          @endif
                   
@if (\Session::has('failure'))
    <div class="alert alert-danger">
       
            <?php
               $msg=   \Session::get('failure');
                 echo $msg[0];
            ?>

          
    </div>
          @endif 
                    
                 
                    @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif
        <!--  <div class="alert d-none" id="reset_pass_error2"></div>
  -->
                <form enctype="multipart/form-data" action="{{url('/change_password')}}" method="POST"  id="reset_password2">
           
            @csrf
             <?php 

          $user_id=Auth::user()->id;  
           $email=Auth::user()->email; 
             
       ?>
            
             <input type="hidden" name="id" value="{{$user_id}}">
             <input type="hidden" name="email" value="{{ $email}}">
             
              <div class="box-body pt-2">
                
                     <div class="col-md-12 px-0">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="text" class="form-control" name="old_pass" id="old_pass" placeholder="Old Password" value="" required>
                </div>
                    
                </div>
                 <div class="col-md-12 px-0">
                    <div class="form-group">
                  <label for="exampleInputEmail1">New Password <span class="new_pass_mis d-none" style="color:red;"></span></label>
                  <input type="text" class="form-control" name="password" id="new_pass" placeholder="New Password" value="" onchange="change_new_pass2(this)" required>
                </div>
                    
                </div>
                 <div class="col-md-12 px-0">
                    <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password <span class="c_pass_mis d-none" style="color:red;"></span></label>
                  <input type="text" class="form-control" name="confirm_password" id="c_password" placeholder="Confirm Password" value="" onchange="change_c_pass2(this)" required>

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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





@endsection