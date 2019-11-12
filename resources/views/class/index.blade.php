
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Classes
        <small>All Class</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Class</a></li>
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
             <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="width:60%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Class</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
                  <form method="POST" enctype="multipart/form-data" action="{{ url('/class_master/add_class')}}">
                  
 @csrf

         <div class="row">
                     
               
         
           <div class="form-group">
           <label style="width:100%;">Class:</label>
          <input type="text" name="class" class="form-control" value="">
           
           </div>
         
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
              $list= \App\Classes::all();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
           //   $list= \App\Classes::where('p_id','=',$pub_id)->get();
            $list= \App\Classes::all();
            }
           
                   // print_r($list);

             ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Class</th>
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
                  <td>{{$new->name}}</td>
                               
                   <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                
         <!-- <a href="{{url('/class_master/delete_class/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->
                 
              @if($user_type=='1')

                 @if($new->status=='0')
                 <a href="{{url('/class_master/activate_class/'.$new->id.'/1')}}">
                  @else
                 <a href="{{url('/class_master/activate_class/'.$new->id.'/0')}}">
                  @endif
                 
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" >
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
                <h4 class="modal-title">Edit Class Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
                 <form method="POST" enctype="multipart/form-data" action="{{ url('/class_master/edit_class')}}">
                  
         @csrf

         <div class="row">
        <?php  $class_info=\App\Classes::find($new->id) ;  ?>
               
               <input type="hidden" name="id" class="form-control" value="{{$class_info->id}}">
               
           <div class="col-md-12">
           <div class="form-group">
           <label style="width:100%;">Class:</label>
<input type="text" name="class" class="form-control" value="{{$class_info->name}}">
           
           </div>
           </div>
        
               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
             


         </div>


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
                  <th>Class</th>
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