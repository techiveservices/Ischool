
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accesscode Assing
        <small>List of Assingned Accesscode </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Accesscode Assing</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Assing Accesscode </h3>

               <div class="col-md-1" style="float: right;">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
               </div>

            </div>
             <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width:60%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Assing Accesscode</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
                  <form method="POST" enctype="multipart/form-data" action="{{ url('/assign/assign_code')}}">
                  
 @csrf
      <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>

 <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">


         <div class="row">
                <div class="col-md-4">
           <div class="form-group">
                <label style="width:100%;">Publisher:</label>
                <select class="form-control p_id select2" name="p_id" id="p_id" style="width:100%;">
                  

                  <?php 
                     if($user_type=='2'){
                  $list= \App\Publisher::where('status','=',1)->where('user_id','=',$user_id)->get(); 
                     
                     }else{

                     	 $list= \App\Publisher::where('status','=',1)->get(); 
                     }

                   
                         
                   ?>
                   @if(!empty($list))
                   @foreach($list as $list2)

                  <option value="{{$list2->id}}">{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>

              </div>
              </div>






         <div class="col-md-4">
           <div class="form-group">
                <label style="width:100%;">Teacher:</label>
                <select class="form-control teacher_id select2" name="teacher_id" id="teacher_id" style="width:100%;">
                  

                  <?php  
                      if($user_type=='2'){

                         $p_id= \App\Publisher::where('status','=',1)->where('user_id','=',$user_id)->value('id'); 
                      	$list= \App\Teacher::where('status','=',1)->where('p_id','=',$p_id)->get(); 
                      }else{

                      	 $list= \App\Teacher::where('status','=',1)->get(); 
                      }


                  
                         
                   ?>
                   @if(!empty($list))
                   @foreach($list as $list2)

                  <option value="{{$list2->id}}">{{$list2->name}}-({{$list2->email}})</option>
                   @endforeach
                   @endif
                  

                </select>

              </div>
              </div>

               <div class="col-md-4">
           <div class="form-group">
             <label style="width:100%;">Accesscode:</label>
               <select name="access_code[]" class="form-control access_code select2" id="access_code" required="" style="width:100%;" multiple="">
                 <option value="">---Select---</option>
             <?php
               if($user_type=='2'){
                $p_id= \App\Publisher::where('status','=',1)->where('user_id','=',$user_id)->value('id'); 

                $accesscode=\App\Book::where('status','=',1)->where('p_id','=',$p_id)->get();

               }else{
               	 $accesscode=\App\Book::where('status','=',1)->get();
               }
              // $accesscode=\App\Book::where('status','=',1)->get();


             ?>


               @if(!empty($accesscode))
                  @foreach($accesscode as $sub)
                   <option value="{{$sub->id}}">{{$sub->access_code}}</option>

                  @endforeach
               @endif

               </select>
              </div>
              </div>
               <!-- <div class="col-md-4">
           <div class="form-group">
           <label style="width:100%;">Series:</label>
          <input type="text" name="series" class="form-control" value="">
           </div>
         </div>
         <div class="col-md-12">
           <div class="form-group">
           <label style="width:100%;">Series Description:</label>
        <textarea name="series_desc" class="form-control"></textarea>
         
           </div>
         </div>
           <div class="col-md-12">
           <div class="form-group">
           <label style="width:100%;">Author Description:</label>
           <textarea name="author_desc" class="form-control"></textarea>
           </div>
         </div>
          <div class="col-md-12">
           <div class="form-group">
           <label style="width:100%;">Series Feature:</label>
           <textarea name="series_feature" class="form-control"></textarea>
           </div>
         </div> -->
         <div class="col-lg-12">
               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </div>
         </div>
          </form>



            </div>
            <!-- /.box-header -->
    

        
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
              $user_id=Auth::user()->id;
              $user_type=Auth::user()->account_type;
            
            if($user_type=='1'){
              $list= \App\Assign::all();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\Assign::where('p_id','=',$pub_id)->get();

            }
           
                   // print_r($list);

             ?>
             
            
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Publisher Name</th>
                  <th>Teacher</th>
                  <th>Accesscode</th>
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
                  <td>

                   <?php  $pub_name= \App\Publisher::where('id','=',$new->p_id)->value('pblctn_name');                     ?>


                    {{$pub_name}}</td>
                 
                  <td>
    <?php  $teacher_name= \App\Teacher::where('id','=',$new->teacher_id)->value('name');                     ?>



                    {{$teacher_name}}</td>
                 <td> 
               <?php

               $code= explode(',', $new->access_code);

               foreach($code as $key=>$value){
                  $li_value= \App\Book::where('id','=',$value)->value('access_code');  ?>
              <span class="alert-warning"><?php   echo $li_value; ?></span>   

              <?php }
               ?>

                
                   </td>
                
                
      <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                  <br>
         <a href="{{url('/assign/delete_assign/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a>
                 
              @if($user_type=='1')

                 @if($new->status=='0')
                 <a href="{{url('/assign/activate_assign/'.$new->id.'/1')}}">
                  @else
                 <a href="{{url('/assign/activate_assign/'.$new->id.'/0')}}">
                  @endif
                 
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" style="margin-top:10px;">
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>

            @endif
                  </td>
                </tr>


        <div class="modal fade" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Series Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

               <form method="POST" enctype="multipart/form-data" action="{{ url('/series/edit_series')}}">
                  
 @csrf
     

                    </form>



            </div>
           
           
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
                  <th>Sr.No</th>
                  <th>Publisher Name</th>
                  <th>Teacher</th>
                  <th>Accesscode</th>
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