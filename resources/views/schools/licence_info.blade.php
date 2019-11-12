@extends('super_admin.include.super_admin_dashboard_head')

@section('content')


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        School Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School</a></li>
        <li class="active">School Profile</li>
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

          $school_info= \App\School::where('id','=',$school_id)->first();

          $user_id=$school_info->user_id; 

      ?>


      
          <img src="{{ asset('admin/dist/img/user4-128x128.jpg')}}" class="profile-user-img img-responsive img-circle" alt="User Image">
        
          
           
 <?php $pblctn_name=\App\Publisher::where('user_id','=',$user_id)->value('pblctn_name');   ?>
              <h3 class="profile-username text-center"></h3>

              <p class="text-muted text-center">
              {{$school_info->name}} <br>
              {{$school_info->address}}

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
      <?php $pblr_about=\App\Publisher::where('user_id','=',$user_id)->value('pblr_about');   ?>
            <!--   <strong><i class="fa fa-book margin-r-5"></i> Education</strong> -->

              <p class="text-muted">
               <br>

                <b>Contact Person:-</b>{{$school_info->contact_person}}<br>
                <b>Contact Number:-</b>{{$school_info->contact}}

               

              </p>

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" ><a href="#settings" data-toggle="tab">Publisher</a></li>
              <li><a href="#activity" data-toggle="tab">Assigned Licence</a></li>
              <li><a href="#timeline" data-toggle="tab">Licence Information</a></li>
           </ul>
            <div class="tab-content">
              <div class="tab-pane" id="activity">
               

<table id="example1" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">E-Book
      </th>
      <th class="th-sm">Class</th>
      <th class="th-sm">Subject</th>
      <th class="th-sm">Licence Type
      </th>
      <th class="th-sm">NoOFLicence
      </th>
      <th class="th-sm">From
      </th>
      <th class="th-sm">Till
      </th>
      <th class="th-sm">Alloted
      </th>
      <th class="th-sm">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php   $school_licence=\App\EbookAssigned::where('school_id','=',$school_id)->get();                  ?>
   @if(!empty($school_licence))
     @foreach($school_licence as $list)
      <tr>
      <td>
    <?php  $book_info= \App\Book::where('id','=',$list->ebook_id)->first();                     ?> 
        
        {{$book_info->access_code}}({{$book_info->title}})

      </td>
      <td>
        <?php  $class_name= \App\Classes::where('id',$book_info->class)->value('name');                             ?>
             {{$class_name}}
      </td>
      <td>
       <?php  $subject_name= \App\Subject::where('id',$book_info->subject)->value('name');                             ?>  
         {{$subject_name}}

      </td>
      <td>{{$list->licence_type}}</td>
      <td>{{$list->no_of_licence}}</td>
      <td>{{date('d-m-Y',strtotime($list->valid_from))}}</td>
      <td>{{date('d-m-Y',strtotime($list->valid_till))}}</td>
      <td>0</td>
      <td>    <div class="row">
          <div class="col-md-12">
             <button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $list->id;     ?>"><i class="fa fa-plus"></i><span class="tooltiptext">Assign Licence</span></button>

          

          </div>
          
    </div></td>
    </tr>


     @endforeach
   @endif
   
   
   
  </tbody>
  <tfoot>
    <tr>
      <th>E-Book</th>
      <th>Class</th>
      <th>Subject</th>
      <th>Licence Type</th>
      <th>NoOfLicence</th>
      <th>Valid</th>
      <th>Valid</th>
      <th>Alloted</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>









               
             
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
               
              </div>
              <!-- /.tab-pane -->

              <div class="active  tab-pane" id="settings">
                <form enctype="multipart/form-data" method="POST" action="{{ url('/publisher/edit_publisher') }}">
           
            @csrf
             <?php   

      $school_info= \App\School::where('id','=',$school_id)->first();

          $p_id=$school_info->p_id; 
          
              $publisher_info= \App\Publisher::where('id',$p_id)->first();
                      
                 //print_r($publisher_info);   


                      ?>
                      @if(!empty($publisher_info))
             <input type="hidden" name="user_id" value="{{$publisher_info->user_id}}">
             <input type="hidden" name="id" value="{{$publisher_info->id}}">

              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Publisher Name</label>
                  <input type="text" class="form-control" name="publisher_name" id="publisher_name" placeholder="Publisher Name" value="{{$publisher_info->pblctn_name}}">
                   </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Conctact Person</label>
                  <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Concern Perosn" value="{{$publisher_info->cntct_psn_name}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{$publisher_info->pblr_email_id}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="text" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{$publisher_info->pblr_pwd}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Contact No</label>
                  <input type="text" class="form-control" name="contact_no" id="exampleInputEmail1" placeholder="Contact Number" value="{{$publisher_info->pblr_cntct_no}}">
                </div>

                
                <div class="form-group">
                  <label for="exampleInputFile">Logo</label>
                  <input type="file" id="exampleInputFile" name="logo">
                <img src="{{ asset('images/publisher_logo/')}}/{{$publisher_info->pblr_logo}}" height="60px" width="60px">
                
                </div>
                 <div class="form-group">
                  <label for="exampleInputFile">Banner</label>
                  <input type="file" id="exampleInputFile" name="banner">
             <img src="{{ asset('images/publisher_banners/')}}/{{$publisher_info->pblr_banner}}" height="60px" width="60px">
                 
                </div>
                
                   <div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
<textarea class="form-control" name="address">{{$publisher_info->pblctn_addrs}}</textarea>   

                  <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">About Publishers</label>
                  <textarea class="form-control" name="about">{{$publisher_info->pblr_about}}</textarea>        
         
                  <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>


              @endif
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