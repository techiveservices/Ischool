
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students
        <small>All Students</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Students</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row techer-form ">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
             

      <div class="col-md-1" style="float: right;">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
               </div>

            </div>
     <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Student</h4>
              </div>
              <div class="modal-body">
         
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
           
<form action="{{ url('/students/add_student')}}" method="post">
    @csrf
     <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">

   
     @if($user_type!='2')
    <div class="form-group" style="">
                <label style="width:100%;">Publication</label>
                <select class="form-control select2" name="p_id" style="width:100%;" id="publisher_id">
                  <option value="">Select Publisher</option>
                  
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

                  <option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @endif>{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>

              </div>
       @endif

        <div class="form-group">
    <label for="school">School:</label>
   
 <select class="form-control select2" name="school" style="width:100%;" id="school_id">
    <option value="">Select School</option>
   <?php  if($user_type=='2'){


      $school_list= \App\School::where('p_id','=',$pub_id)->get();
    if(!empty($school_list)){
      foreach($school_list as $school){ ?>
 <option value="{{$school->id}}">{{$school->name}}</option>

   <?php   }
    }

   }                    ?>



                </select>
  </div>
         
   <div class="form-group">
    <label for="email">Name</label>
    <input type="text" class="form-control" name="name" id="name">
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>

 
  <div class="form-group">
    <label for="pwd">Phone Number:</label>
    <input type="text" class="form-control" name="phone_no" id="phone_no">
  </div>
   

  <div class="form-group">
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>




            </div>
     
          </div>

                </div>




              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        

            <!-- /.box-header -->
            <div class="box-body">
       <?php  
          
            
            if($user_type=='1'){
              $list= \App\Student::all();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\Student::where('p_id','=',$pub_id)->get();

            }elseif($user_type=='4'){

              $school_id=\App\School::where('user_id',$user_id)->value('id');
            $list= \App\Student::where('school_id','=',$school_id)->get();
                   // print_r($list);
            }
             ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  @if($user_type!='2')
                  <th>Publication</th>
                  @endif
                  <th>School</th>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Ph.No</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php  $i=1;    ?>
                	@if(!empty($list))
                	
                	 @foreach($list as $new)
                	
                <tr>
                	<td>{{$i++}}</td>
                    @if($user_type!='2')
                   <td>

                   <?php  $pub_name= \App\Publisher::where('id','=',$new->p_id)->value('pblctn_name');                     ?>
                   {{$pub_name}}</td>
                    @endif
                  <td>
<?php  $school_name= \App\School::where('id',$new->school_id)->value('name');                         ?>

                    {{$school_name}}</td>
                  <td>{{$new->name}}</td>
                  <td>{{$new->email}}</td>
                  <td>{{$new->phone}}</td>
                  <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                  <br>
                       
              @if($user_type=='1')
               @if($new->status=='0')
                 <a href="{{url('/student/activate_student/'.$new->id.'/1')}}">
                  @else

                 <a href="{{url('/student/activate_student/'.$new->id.'/0')}}">

                  @endif
                
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" style="margin-top:10px;">
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>

            @endif
                  </td>
                </tr>


        <div class="modal fade modal-default modal-default1" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width: 60%; height: 50%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Student Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
           <form action="{{ url('/students/edit_student')}}" method="post">
    @csrf
     <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 

      $student_info=\App\Student::where('id',$new->id)->first();
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
         <input type="hidden" name="id" value="{{$student_info->id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">
        <input type="hidden" name="student_school" value="{{$student_info->school_id}}">
        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">

          @if($user_type=='1')

           <div class="form-group">
                <label style="width:100%;">Publication</label>
                <select class="form-control publisher_id2 select2" name="p_id" style="width:100%;" id="publisher_id2">
                  
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
                  <option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @endif @if($student_info->p_id==$list2->id) selected=""    @endif>{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
          
                </select>

              </div>

             <div class="form-group">
    <label for="school">School:</label>
   
 <select class="form-control school_id select2" name="school" style="width:100%;" id="school_id">
    <option value="">Select School</option>
   <?php  if($user_type!='2'){
      $school_list= \App\School::where('p_id','=',$student_info->p_id)->get();
    if(!empty($school_list)){
      foreach($school_list as $school){ ?>
 <option value="{{$school->id}}" @if($student_info->school_id==$school->id) selected=""    @endif>{{$school->name}}</option>

   <?php   }
    }

   }                    ?>



                </select>
  </div>



              @endif
   
  <div class="wt-100">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="{{$student_info->name}}">
  </div>
 
  <div class="wt-100">
    <label for="pwd">Phone Number:</label>
    <input type="text" class="form-control" name="phone_no" id="phone_no" value="{{$student_info->phone}}">
  </div>
  <div class="wt-100">
    <label for="email">Email:</label>
    <input type="text" class="form-control" name="email" id="email" value="{{$student_info->email}}">
  </div>
  <div class="mt-10" style="margin-top: 10px;">
   <button type="submit" class="btn btn-success">Submit</button>
 </div>
</form>
            
          </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

               
                @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                 <th>S.No</th>
                   @if($user_type!='2')
                  <th>Publisher</th>
                   @endif
                <th>School</th>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Ph.No</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              </div>
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
