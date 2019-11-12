
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schools
        <small>All Schools</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">School</a></li>
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
             <!--  <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button> -->
               </div>

            </div>
             <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add School</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif    
             <div class="alert" id="school_error" style="display: none"></div>
        <form method="POST" enctype="multipart/form-data" action="{{ url('/school/add_school')}}" id="add_school">
          @csrf
      <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}" id="user_type">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif" id="publisher_id">



          <div class="row">
           
           @if($user_type!='2')
            
           <div class="form-group">
                <label style="width:100%;">Publication:</label>
                <select class="form-control select2" name="p_id" id="p_id" style="width:100%;" required>
                  

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
                <label>School Name:</label>
                <input type="text" name="s_name" class="form-control" placeholder="School Name" autocomplete="off" required >
              </div>
             
           <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" placeholder="School Email" autocomplete="off" required >
              </div>
        
              <div class="form-group">
                <label>Password:</label>
                <input type="text" name="s_password" class="form-control" placeholder="School Password" autocomplete="off" required>
              </div>
          
           <div class="form-group">
                <label>Board/University:</label>
                <input type="text" name="board_university" class="form-control" placeholder="Board University" required="" autocomplete="off" >
              </div>
             
               <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address" autocomplete="off" required >
              </div>
             
               <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact_no" class="form-control" placeholder="Contact Number" autocomplete="off"  required>
              </div>
             
               <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" autocomplete="off" required>
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

   @if (session('success'))
    <div class="alert alert-success">
        <?php

       echo  $msg=session('success');
        // echo $msg[0];
        ?>


 
    </div>
@endif

   @if (session('failure'))
    <div class="alert alert-danger">
        <?php

       echo  $msg=session('failure');
      //   echo $msg[0];
        ?>


 
    </div>
@endif






       @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

          <?php  
          
            
            if($user_type=='1'){
              $list= \App\School::where('status','1')->where('is_new','1')->get();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\School::where('p_id','=',$pub_id)->where('status','1')->where('is_new','1')->get();

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
                  <th>School Name</th>
                  <th>Book</th>
                  <th>Email</th>
                  <th>Ph. No</th>
                  <th>Address</th>
                  <th>Name</th>
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
                  <a href="{{ url('/school/licence_info/'.$new->id)}}">

                    {{$new->name}}</a></td>

                   <td>
<?php
            $ebook_id= \App\EbookAssigned::where('school_id',$new->id)->value('ebook_id');
             $book_id=\App\EbookLicence::where('id',$ebook_id)->value('access_code_id');

             $book_info=\App\Book::where('id',$book_id)->first();
             print_r($book_info->title);

   ?>               </td>
                   <?php  $email= \App\User::where('id','=',$new->user_id)->value('email');                     ?>
                   <td>{{$email}}</td>
                  
                  <td>{{$new->contact}}</td>
                 
                  <td>{{$new->address}}</td>
                 

                 
                  <td>{{$new->contact_person}}</td>
                
                   <td>
    <div class="row">
          <div class="col-md-12">
             <button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>


             <button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal_default_edit_licence<?php  echo $new->id;     ?>"><i class="fa fa-plus"></i><span class="tooltiptext">Licence Request</span></button>

          <!--  <a href="{{url('/school/delete/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->

          </div>
          
    </div>



                  </td>
                </tr>


        <div class="modal fade" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit School Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form method="POST" enctype="multipart/form-data" action="{{ url('/school/update')}}">
          @csrf
           <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
      $school_info=\App\School::where('id','=',$new->id)->first();
       ?>
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}" id="user_type">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif" id="publisher_id">

        <input type="hidden" name="id" value="<?php echo $new->id; ?>">
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
     <div class="modal fade" id="modal_default_edit_licence<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update School Licence Info</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
 <form method="POST" class="licence_add_frm"  enctype="multipart/form-data" action="{{ url('/school/ebook_licence_new')}}">
      

              @csrf


 <?php
             
             $ebook_info=\App\EbookAssigned::where('school_id',$new->id)->first();
             $ebooks=\App\EbookLicence::where('id','=',$ebook_info->ebook_id)->first();
              $licence_list= explode(',',$ebooks->licence_type);
          // print_r($licence_list);
         // if(in_array("Software", $licence_list)){ echo 'selected'; }            
                

      ?>
      <input type="hidden" name="id" value="{{$ebook_info->id}}">

      <input type="hidden" class="form-control no_of_licence" id="no_of_available_licence" placeholder="Number Of Licence" name="no_of_available_licence" value="{{$ebooks->no_licence}}">

      <input type="hidden" class="form-control pull-right licence_from" id="licence_from" name="licence_date_from" value="{{date('d-m-Y',strtotime($ebooks->licence_from))}}">

      <input type="hidden" class="form-control pull-right licence_to" id="licence_to" name="licence_date_to" value="{{date('d-m-Y',strtotime($ebooks->licence_to))}}">


        <input type="hidden" class="form-control pull-right selected_school" id="selected_school" name="school" value="{{$new->id}}">
     <?php
      $school_id= \App\School::where('id',$new->id)->value('id');

?>         
 
 <div class="col-md-12">
  <input type="hidden" name="access_code_id" class="access_code_id" value="<?php  echo $ebook_info->ebook_id;  ?>">

 <input type="hidden" name="school_id" class="school_id" value="<?php  echo $school_id;  ?>">
 <div class="form-group">
    <label for="exampleInputEmail1">School</label>
<?php
      $schools_name= \App\School::where('id',$new->id)->value('name');

?>
<input type="text" class="form-control" id="school" placeholder="School Name" name="school" value="{{$schools_name}}" readonly>


  </div>
   </div> 
         
 
     <div class="col-md-12 " >
    <div class="form-group">
      <label for="exampleInputPassword1">Number of Licence </label>
      
      <input type="text" class="form-control no_of_licence" id="no_of_licence" placeholder="Number Of Licence" name="no_of_licence" value="">

    </div>
  </div>

  <div class="col-sm-6">
  
 <div class="form-group">
                <label>Date from:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker_from" id="datepicker1" name="date_from" value="">
                </div>
                <!-- /.input group -->
              </div>

  

 <div class="form-group">
                <label>Date To:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>

                  <input type="text" class="form-control pull-right datepicker_to" id="datepicker2" name="date_to" value="">
                </div>
                <!-- /.input group -->
              </div>

  </div>

<div class="col-sm-12">
    <button type="submit" class="btn btn-primary">Submit</button>
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
        <!-- Modal -->
<div class="modal fade" id="modal-default_cart_<?php  echo $new->id;     ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Accesscode Licence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" method="post">
          @csrf
          <input type="hidden" name="access_code_id" value="<?php  echo $new->id;     ?>">
           <div class="col-md-12">
  <div class="form-group">
    <label for="exampleInputEmail1">Select License Type <i class="fa fa-external-link popover-test" aria-hidden="true" title="Licence Type" data-content="Popover body content is set in this attribute."></i></label>
    <select class="form-control select2_new" name="licence_type[]" placeholder="Select Licence Type"  style="width:100%;" multiple="multiple">
      <option value="Software">Software</option>
      <option value="Hardware">Hardware</option>
    </select>
    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
</div>
   <div class="col-md-12">
  <div class="form-group">
    <label for="exampleInputPassword1">Number of Licence <i class="fa fa-external-link popover-test" aria-hidden="true" title="Number Of Licence" data-content="this licence is only valid for number of alloted user"></i></label>
    
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Number Of Licence" name="no_of_licence">

  </div>
</div>

  <div class="col-md-6">
 <div class="form-group">
                <label>Date from:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="datepicker1" name="date_from">
                </div>
                <!-- /.input group -->
              </div>

  </div>
   <div class="col-md-6">

 <div class="form-group">
                <label>Date To:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>

                  <input type="text" class="form-control pull-right datepicker" id="datepicker2" name="date_to">
                </div>
                <!-- /.input group -->
              </div>
  </div>
  

   
  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

               
                @endforeach
                @endif
                </tbody>
                <tfoot>
                  <tr>
                  <th>S.No</th>
                  @if($user_type!='2')
                  <th>Publication</th>
                  @endif
                  <th>School Name</th>
                  <th>Book</th>
                  <th>Email</th>
                  <th>Ph. No</th>
                  <th>Address</th>
                  <th>Name</th>
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