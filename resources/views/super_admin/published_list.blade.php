
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Publishers
        <small>All Publishers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Publishers</a></li>
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
             <!--  <h3 class="box-title">Publishers</h3> -->

               <div class="col-md-1" style="float: right;">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
               </div>

            </div>
             <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="height: 80%;width: 70%">
            <div class="modal-content" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Publishers</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
                       <!-- /.box-header -->
            <!-- form start -->
            
@if(Session::has('success'))
          <div class="alert alert-success">
            <?php  echo   $msg= Session::get('success');   

                // echo $msg[0];

                 ?>
              
          </div>
         @endif
         @if(Session::has('failure_pub'))
          <?php     $msg2= Session::get('failure_pub');  ?> 
      @foreach ($msg2 as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
         @endif



 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif    
             <div class="alert2" id="publisher_error"  ></div>

            <form enctype="multipart/form-data" method="POST" action="{{ url('/publisher/add_publisher') }}" id="add_publisher_list">
           
            @csrf
              <div class="box-body">
                <div class="row">
                <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Publication</label>
                  <input type="text" class="form-control" name="publisher_name" id="publisher_name" placeholder="Publication">
                   </div>
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Contact Person Name</label>
                  <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Name">
                </div>
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control email" name="email" id="email" placeholder="Enter email">

                   <span class="email_mis" style="color:red;display:none;"></span>
                    
                </div>
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Ph. No</label>
                  <input type="text" class="form-control phone_no" name="contact_no" id="exampleInputEmail1" placeholder="Ph No" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">
                
                <span id="message" class="message d-none text-danger" style="color:red;display:none;"></span>
                </div>

                 
                
                 <div class="form-group col-md-6 m-auto">
                 <label for="exampleInputFile">Logo </label><br>
                  <div style="width:80%; display:inline-block;">
                      <font style="size:6px;"><small>(jpeg/png/jpg/gif/svg|Max-Width=1000px | Max. Height 1000px)</small></font>
                  <input type="file" id="logo" class="logo" name="logo" accept="image/*">
                  </div>
                   <img style="display:inline-block; vertical-align:top;" id="blah" class="blah" src="#" alt=""  height="70px" width="70px" />
                 
                </div>

                     <div class="form-group col-md-6 m-auto">
                 <label style="width:100%; display:flex;" for="exampleInputFile">Banner</label>
                  <div style="width:80%; display:inline-block;">
                      <font style="6px;"><small>(jpeg/png/jpg/gif/svg | Width 1200 | Height 500 )</small></font> 
                      <input type="file" id="banner" class="banner"  name="banner"accept="image/*">
                  </div>
                  <img style="display:inline-block; vertical-align:top;" id="blah2" class="blah2" src="#" alt="" height="70px" width="70px" />
                </div>                               
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">About</label>
                  <textarea rows="4" class="form-control" name="about"></textarea>        
                </div>
                <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputPassword1">Address</label>
                 <textarea rows="4" class="form-control" name="address"></textarea>   
                </div>                
               <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="text" class="form-control password" name="password" id="password" placeholder="Enter Password" onchange="password_validate(this)">
                  <span>*Password should be Minimum 6 character and must contain: Lowercase, Uppercase, Digit(0-9) and Special character (!,@,#,$,%,^,&,*,+,-)</span>
                    <span class="password_mis" style="color:red;display:none;"></span>
                    
                  
                </div>

              <div class="box-footer col-md-6">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>                                 
                </div>
               
              </div>
              <!-- /.box-body -->


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



          <?php   $list= \App\Publisher::all(); ?>
                   

            
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Publication</th>
                  <th>Address</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Ph.No</th>
                   <th>Logo</th>
                   <th>Banner</th>
                   <th>About</th>
                   <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php  $i=1;    ?>
                  @if(!empty($list))
                  
                   @foreach($list as $new)
                  
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$new->pblctn_name}}</td>
                  <td>{{$new->pblctn_addrs}}</td>
                  <td>{{$new->cntct_psn_name}}</td>
                  <td>{{$new->pblr_email_id}}</td>
                  <td>{{$new->pblr_cntct_no}}</td>
                  <td><img src="{{ asset('images/publisher_logo/')}}/{{$new->pblr_logo}}" height="60px" width="60px"></td>
                  <td><img src="{{ asset('images/publisher_banners/')}}/{{$new->pblr_banner}}" height="60px" width="60px"></td>
                  <td>{{$new->pblr_about}}</td>
                 
                  <td><button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

                  <br>
                <!--  <a href="{{url('/publisher/delete_publisher/'.$new->id.'/'.$new->user_id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->

         <a href="{{url('/publisher/activate_publisher/'.$new->id)}}">
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" style="margin-top:10px;">
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>
                  </td>
                </tr>


        <div class="modal fade modal-default" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width: 80%; height: 70%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Publishers Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
                                     
           @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif    
             <div class="alert2 " class="publisher_error2" style="display: none"></div>
            <!-- /.box-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ url('/publisher/edit_publisher') }}" class="edit_publisher">
           
            @csrf
             <?php    $publisher_info= \App\Publisher::where('id',$new->id)->first();
                      
                            //  $user_info=\App\User::find($publisher_info->user_id);
                      //echo '<pre>';
                     //  print_r($user_info);


                      ?>
             <input type="hidden" name="user_id" value="{{$publisher_info->user_id}}">
             <input type="hidden" name="id" value="{{$publisher_info->id}}">

              <div class="box-body">
                <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Publication</label>
                  <input type="text" class="form-control" name="publisher_name" id="publisher_name" placeholder="Publication" value="{{$publisher_info->pblctn_name}}">
                   </div>

                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Contact Person Name</label>
                  <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Name" value="{{$publisher_info->cntct_psn_name}}">
                </div>
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{$publisher_info->pblr_email_id}}" readonly>
                </div>

                   <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">Ph. No</label>
                  <input type="number" class="form-control phone_edit" name="contact_no" id="exampleInputEmail1" placeholder="Contact Number" value="{{$publisher_info->pblr_cntct_no}}" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">
                <span id="message_edit" class="message_edit d-none text-danger" style="color:red;display:none;"></span>
                
                </div>

                <!-- <div class="form-group col-md-6 m-auto">-->
                <!--  <label for="exampleInputEmail1">Password</label>-->
                <!--  <input type="text" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{$publisher_info->pblr_pwd}}">-->
                <!--</div>-->

                <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputFile">Logo (only in jpeg/png/jpg/gif/svg width 300 and height 100 allowed)</label>
                  <input type="file" id="logo" name="logo" class="logo">
               
                <img  class="blah" id="blah" src="{{ asset('images/publisher_logo/')}}/{{$publisher_info->pblr_logo}}" height="60px" width="60px">
                
                </div>
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputFile">Banner (only in jpeg/png/jpg/gif/svg width 1200 and height 500 allowed)</label>
                  <input type="file" id="banner" name="banner" class="banner">
             <img class="blah2" src="{{ asset('images/publisher_banners/')}}/{{$publisher_info->pblr_banner}}" height="60px" width="60px">
                 
                </div>                                
                 <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputEmail1">About</label>
                  <textarea class="form-control" name="about">{{$publisher_info->pblr_about}}</textarea>        
         
                  <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                </div>
                <div class="form-group col-md-6 m-auto">
                  <label for="exampleInputPassword1">Address</label>
<textarea class="form-control" name="address">{{$publisher_info->pblctn_addrs}}</textarea>   

                  <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>                
                


                                
              <div class="box-footer col-md-12 m-auto"">
               <center> <button type="submit" class="btn btn-primary">Submit</button></center>
              </div>                
               
              </div>
              <!-- /.box-body -->


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
                  <th>SN</th>
                  <th>Publication</th>
                  <th>Address</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Ph.No</th>
                   <th>Logo</th>
                   <th>Banner</th>
                   <th>About</th>
                  
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