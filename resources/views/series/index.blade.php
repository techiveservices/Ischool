
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Series
        <small>All Series</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Series</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">

     @if(Session::has('success'))
          <div class="alert alert-success">
            <?php     $msg= Session::get('success');   

                 echo $msg[0];

                 ?>
              
          </div>
         @endif
         @if(Session::has('failure'))
          <div class="alert alert-danger">
            <?php     $msg2= Session::get('failure');   

                 echo $msg2[0];

                 ?>
              
          </div>
         @endif



          
            <div class="box-header">
           

               <div class="col-md-1" style="float: right;">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
               </div>

            </div>
             <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Series</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
             
                  <form method="POST" enctype="multipart/form-data" action="{{ url('/series/add_series')}}">
                  
 @csrf
      <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>

 <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">


         <div class="row">
         @if($user_type!='2')
           <div class="form-group">
                <label style="width:100%;">Publication:</label>
                <select class="form-control select2" name="p_id" id="p_id" style="width:100%;">
                  

                  <?php   $list= \App\Publisher::where('status','=',1)->get(); 
                          $subject=\App\Subject::all();


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

             <?php    $subject=\App\Subject::all();   ?>
                <label style="width:100%;">Select Subject:</label>
               <select name="subject" class="form-control select2" id="subject_id" required="" style="width:100%;">
                 <option value="">---Select---</option>

               @if(!empty($subject))
                  @foreach($subject as $sub)
                   <option value="{{$sub->id}}">{{$sub->name}}</option>

                  @endforeach
               @endif

               </select>
              </div>
             <div class="form-group">
           <label style="width:100%;">Author</label>
          
          <input type="text" name="author_desc" class="form-control" value="">

           <!-- <textarea name="author_desc" class="form-control"></textarea> -->
           </div>
         
              
           <div class="form-group <?php if($user_type=='2'){  echo 'modal-content-input ';?> <?php }  ?>">
           <label style="width:100%;">Series:</label>
          <input type="text" name="series" class="form-control" value="">
           </div>
            
        
           <div class="form-group">
           <label style="width:100%;">Series Description:</label>
        <textarea name="series_desc" class="form-control"></textarea>
         
           </div>
             
          
         
         
           <div class="form-group">
           <label style="width:100%;">Series Feature:</label>
           <textarea name="series_feature" class="form-control"></textarea>
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
              $list= \App\Series::all();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\Series::where('p_id','=',$pub_id)->get();

            }
           
                   // print_r($list);

             ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  @if($user_type!='2')
                  <th>Publication</th>
                  @endif
                  <th>Subject</th>
                  <th>Series</th>
                  <th>Series Desc.</th>
                  <th>Author Desc.</th>
                  <th>Series features</th>
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
    <?php  $subject_name= \App\Subject::where('id','=',$new->subject_id)->value('name');                     ?>



                    {{$subject_name}}</td>
                  <td>{{$new->series}}</td>
                  <td>
        <?php      $series_desc = substr($new->series_desc, 0, 100);  ?>

                    {{$series_desc}}</td>
                  <td>
 <?php      $author_desc = substr($new->author_desc, 0, 100);  ?>

                    {{$author_desc}}</td>
                  <td>


<?php   


   $series_feature = substr($new->series_features, 0, 100); 
  echo $feature= htmlspecialchars_decode(stripslashes($series_feature)); 

    ?>

                    {{$feature}}</td>
                   <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                  <br>
       <!--   <a href="{{url('/series/delete_series/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->
                 
              @if($user_type=='1')

                 @if($new->status=='0')
                 <a href="{{url('/series/activate_series/'.$new->id.'/1')}}">
                  @else
                 <a href="{{url('/series/activate_series/'.$new->id.'/0')}}">
                  @endif
                 
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" style="margin-top:10px;">
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>

            @endif
                  </td>
                </tr>


        <div class="modal fade modal-default" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Series Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
             <form method="POST" enctype="multipart/form-data" action="{{ url('/series/edit_series')}}">
                  
 @csrf
      <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;
           $series_info=\App\Series::where('id','=',$new->id)->first();

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>
<input type="hidden" name="id" value="{{$series_info->id}}">
 <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">


         <div class="row">
          @if($user_type!='2')
           <div class="form-group">
                <label style="width:100%;">Publisher Id:</label>
                <select class="form-control select2" name="p_id" id="p_id" style="width:100%;">
                  

                  <?php   $list= \App\Publisher::where('status','=',1)->get(); 
                          $subject=\App\Subject::all();


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

                  <option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @endif @if($series_info->p_id==$list2->id) selected=""  @endif>{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>

              </div>
              @endif
           <div class="form-group">

             <?php    //print_r($subject);    ?>
                <label style="width:100%;">Select Subject:</label>
               <select name="subject" class="form-control select2" id="subject_id" required="" style="width:100%;">
                 <option value="">---Select---</option>
               @if(!empty($subject))
                  @foreach($subject as $sub)
                   <option value="{{$sub->id}}" @if($series_info->subject_id==$sub->id) selected=""  @endif>{{$sub->name}}</option>

                  @endforeach
               @endif

               </select>
              </div>
            

             <div class="form-group">
           <label style="width:100%;">Author:</label>
          <input type="text" name="author_desc" class="form-control" value="{{$series_info->author_desc}}">
           </div>
             
           <div class="form-group <?php if($user_type=='2'){  echo 'modal-content-input ';?> <?php }  ?>">
           <label style="width:100%;">Series:</label>
          <input type="text" name="series" class="form-control" value="{{$series_info->series}}">
           </div>

           
         
         



           <div class="form-group">
           <label style="width:100%;">Series Description:</label>
        <textarea name="series_desc" class="form-control textArea" onclick="textAreaAdjust(this)" style="overflow:hidden">{{$series_info->series_desc}}</textarea>
         
           </div>
<!--          </div>
           <div class="col-md-12">
           <div class="form-group">
           <label style="width:100%;">Author Description:</label>
           <textarea name="author_desc" class="form-control textArea" onclick="textAreaAdjust(this)" style="overflow:hidden">{{$series_info-> author_desc}}</textarea>
           </div>
         </div> -->
         <!--  <div class="col-md-12"> -->
           <div class="form-group">
           <label style="width:100%;">Series Feature:</label>
           <textarea name="series_feature" class="form-control textArea" onclick="textAreaAdjust(this)" style="overflow:hidden">{{$series_info->series_features}}</textarea>
           </div>
         <!-- </div>
         <div class="col-lg-12"> -->
               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- </div> -->


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
                  <th>S.No</th>
                    @if($user_type!='2')
                  <th>Publication</th>
                    @endif
                  <th>Subject</th>
                  <th>Series</th>
                  <th>Series Desc.</th>
                  <th>Author Desc.</th>
                  <th>Series features</th>
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