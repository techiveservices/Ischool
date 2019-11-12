
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Teachers
        <small>All Teachers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?php    $user_type= Auth::user()->account_type; 
         $user_id= Auth::user()->id; ?>
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
                <h4 class="modal-title">Add Teachers</h4>
              </div>
              <div class="modal-body">
         
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
           
<form action="{{ url('/teachers/add_teacher')}}" method="post">
    @csrf
     <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;
     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">
        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">
     @if($user_type!='2' && $user_type!='4')
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
       @if($user_type!='4')
               <div class="form-group">
    <label for="school">School:</label>
   
 <select class="form-control select2" name="school" style="width:100%;" id="school_id">
    <option value="">Select School</option>
   <?php  if($user_type=='2'){
      $school_list= \App\School::where('p_id','=',$pub_id)->get();
    if(!empty($school_list)){
      foreach($school_list as $school){ ?>
 <option value="{{$school->id}}">{{$school->name}}</option>

   <?php   } }  } ?>
                </select>
  </div>
   @endif

<div class="form-group">
    <label for="email">Name</label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
             
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password" id="pwd">
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
              $list= \App\Teacher::all();
       }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\Teacher::where('p_id','=',$pub_id)->get();

       }elseif($user_type=='4'){

         $school_id=\App\School::where('user_id',$user_id)->value('id');
        $list= \App\Teacher::where('school_id','=',$school_id)->get();

            }
           
                  

             ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  @if($user_type=='1')
                  <th>Publication</th>
                  <th>School</th>
                  @endif
                  @if($user_type=='2')
                  <th>School</th>
                  @endif
                  <th>Name</th>
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
                  @if($user_type=='1')
                   <td>

                   <?php  $pub_name= \App\Publisher::where('id','=',$new->p_id)->value('pblctn_name');                     ?>


                    {{$pub_name}}</td>

                    <td>
  <?php $school_name= \App\School::where('id',$new->school_id)->value('name');                  ?>

                      {{$school_name}}</td>
                    @endif
                     @if($user_type=='2')
                    <td>
  <?php $school_name= \App\School::where('id',$new->school_id)->value('name');                  ?>

                      {{$school_name}}</td>
                    @endif
                     <td>{{$new->name}}</td>
                  
                   <td>{{$new->email}}</td>
                 
                  <td>{{$new->ph_no}}</td>
                            
                         
                  <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                  <br>
       <!--   <a href="{{ url('/teachers/delete_teachers/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->
               
                  
              @if($user_type=='1')


                 @if($new->status=='0')
                 <a href="{{url('/teachers/activate_teachers/'.$new->id.'/1')}}">
                  @else

                 <a href="{{url('/teachers/activate_teachers/'.$new->id.'/0')}}">

                  @endif



                  
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" style="margin-top:10px;">
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>

            @endif
                  </td>
                </tr>


        <div class="modal fade modal-default modal-default1" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Teacher Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
           <form action="{{ url('/teachers/edit_teachers')}}" method="post">
    @csrf
     <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;
         if($user_type=='2'){
                          $user_id=Auth::user()->id;
                          $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
         }elseif($user_type=='1'){
                         $user_id=0;
                          $pub_id=0;

         }elseif($user_type=='4'){
                  
                 $teacher_info= \App\Teacher::where('id',$new->id)->first();
                 
                $user_id= $teacher_info->user_id;
                $pub_id=$teacher_info->p_id;
         }

    $teacher_info= \App\Teacher::where('id',$new->id)->first();
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
         <input type="hidden" name="id" value="{{$teacher_info->id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">

          @if($user_type!='2' && $user_type!='4')

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

                  <option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @endif @if($teacher_info->p_id==$list2->id) selected=""    @endif>{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>

              </div>
              @endif
 @if($user_type!='4')
               <div class="form-group">
    <label for="school">School:</label>
   
 <select class="form-control school_id select2" name="school" style="width:100%;" id="school_id">
    <option value="">Select School</option>
   <?php  if($user_type=='2'){
      $school_list= \App\School::where('p_id',$teacher_info->p_id)->get();
    if(!empty($school_list)){
      foreach($school_list as $school){ ?>
 <option value="{{$school->id}}" <?php if($school->id==$teacher_info->school_id){ echo 'selected';   } ?>>{{$school->name}}</option>

   <?php   } }  } ?>
                </select>
  </div>
   @endif
    
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email_edit" value="{{$teacher_info->email}}">
  </div>        
 
  <div class="form-group">
    <label for="email">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="{{$teacher_info->name}}">
  </div>
   
  <div class="form-group">
    <label for="pwd">Phone Number:</label>
    <input type="text" class="form-control" name="phone_no" id="phone_no" value="{{$teacher_info->ph_no}}">
  </div>
 
  <button type="submit" class="btn btn-success">Submit</button>
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
                  @if($user_type=='1')
                  <th>Publication</th>
                  @endif
                 @if($user_type=='2')
                  <th>School</th>
                  @endif
                  <th>Name</th>
                 
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
