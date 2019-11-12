
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Chapter
        <small>List of Chapter</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Chapter</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
         
               <div class="col-md-1" style="float: right;">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
               </div>

            </div>
             <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width:60%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Chapter</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form method="POST" enctype="multipart/form-data" action="{{ url('/chapter/add_chapter')}}">
          @csrf
      <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}" id="user_type">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif" id="publisher_id">



          <div class="row">
           

            
           <div class="form-group">
                <label style="width:100%;">Publication:</label>
                <select class="form-control p_id select2" name="p_id" id="p_id" style="width:100%;">
                  
                 <?php 
                     if($user_type=='2'){

 $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 

                  $list= \App\Publisher::where('status','=',1)->where('id','=',$pub_id)->get(); 
                     
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
              
           <div class="form-group">
             <label style="width:100%;">Book:</label>
               <select name="access_code" class="form-control access_code select2" id="access_code" required="" style="width:100%;">
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
             
           <div class="form-group">
           <label style="width:100%;">Chapter No:</label>
          <input type="text" name="ch_no" class="form-control" value="">
           </div>
       
           <div class="form-group">
           <label style="width:100%;">Chapter Name:</label>
          <input type="text" name="ch_name" class="form-control" value="">
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
          
        
              $list= \App\Chapter::where('access_code','=',$access_code_id)->get();

            
           
                   // print_r($list);

             ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Publication</th>
                  <th>Book</th>
                  <th>Ch.No</th>
                  <th>Chapter Id</th>
                  <th>Chapter</th>
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
 <?php  $access_code= \App\Book::where('id','=',$new->access_code)->value('access_code');                     ?>


                  	{{$access_code}}</td>
                   <td>{{$new->ch_no}}</td>
                   <td>{{$new->id}}</td>
                    <td>{{$new->ch_name}}</td>
             
                  <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                 
        <!--  <a href="{{url('/chapter/delete_chapter/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->
               
                  
              @if($user_type=='1')


                 @if($new->status=='0')
                 <a href="{{url('/chapter/activate_chapter/'.$new->id.'/1')}}">
                  @else

                 <a href="{{url('/chapter/activate_chapter/'.$new->id.'/0')}}">

                  @endif
                  
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>">
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>

            @endif
                  </td>
                </tr>


        <div class="modal fade modal-default" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Chapter Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
           
            <!-- /.box-header -->
            <!-- form start -->
                <form method="POST" enctype="multipart/form-data" action="{{ url('/chapter/edit_chapter')}}">
          @csrf
 


          <div class="row">
            <input type="hidden" name="id" value="{{$new->id}}">
           
              <div class="col-md-4">
           <div class="form-group">
           <label style="width:100%;">Chapter No:</label>
          <input type="text" name="ch_no" class="form-control" value="{{$new->ch_no}}">
           </div>
         </div>  

        <div class="col-md-8">
           <div class="form-group">
           <label style="width:100%;">Chapter Name:</label>
          <input type="text" name="ch_name" class="form-control" value="{{$new->ch_name}}">
           </div>
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
                  <th>Publication</th>
                  <th>Book</th>
                  <th>Ch.No</th>
                  <th>Chapter</th>
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