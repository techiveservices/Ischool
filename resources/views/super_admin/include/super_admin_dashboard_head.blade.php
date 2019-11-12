<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Book-Library</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
{!! Charts::styles() !!}
 
  <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css" media="screen">
 /*Add+ Css Style*/
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: absolute;
    z-index: 9;
    right: 0;
}
.box-header .col-md-1 {
    width: 100%;
}
.modal{ z-index: 99999; padding-top: 6%; }
.modal-header {
    
    background-color: #3c8dbc !important;
    color:#ffff !important;
    text-align: center !important;
}
#example1_filter{ text-align: left; }
#example1_filter label {width: 100%;}
#example1_filter label input{width: 50%;}
.box-header.with-border{ display: none; }
.box.box-primary{ border:0;  }
.modal-default .modal-open .modal{ overflow: hidden;     }
.modal-default .form-group, .modal-default  .box-footer{ float: none !important; display: inline-block !important; width: 49%; border: 0; }
.modal-default .box-header.with-border{display: block;
    position: relative;}
.modal-default1 .form-group:nth-child(odd){ margin-right: 1.4%;  }
.modal-default .btn-default { display: none; }
.modal-default1 .box-header.with-border{ display: none !important; }
.modal-footer button{ display: none; }
/*End Add+ Css Style*/ 
.modal-content {
    /*height: 65vh;*/
    box-shadow: 0px 0px 10px 0px #fff;
}
.modal-content-input{ width: 100% !important; }
.modal-content2{

height: auto;

}
.modal-dialog{

  width: 80%; height: 70%;
}
div.dataTables_wrapper div.dataTables_filter {
    text-align: left;
} 
div.dataTables_wrapper div.dataTables_filter label { width:100%;}
div.dataTables_wrapper div.dataTables_filter label input{ width:50%;}
</style>
<style>
// example style
* {
  border-radius:10px;
}
#selected{
  text-transform:uppercase;
  color:teal;
  padding:0 5px;
  border: { 
    width:1px;
    style:solid;
    color:grey;
  }
  font:{
    family:Consolas;
    size:0.8em;
  }
}
[value=getFile]{
  background:teal;
  cursor:pointer;
  color:white;
  padding:0 5px;
  font-family:Trebuchet MS;
  border:0;
  &:hover{
    background:#0aa;
  }
}
tr.disabled {
    background-color: grey;
}
.tooltip {
  position: relative;
  display: inline-block;
  opacity: 1; 
  border-bottom: 1px dotted black;
}
.textArea{
    border: #a9a9a9 1px solid;
    overflow: hidden;
    width:  expression( document.getElementById("spnHidden").clientWidth );
    height: expression( document.getElementById("spnHidden").clientHeight );
}
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}
.select2-container{z-index: 999999; padding: 1px;
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de !important;
    margin-top: -4px;}
.select2-container--default.select2-container--focus .select2-selection--multiple,.select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single{padding: 1px;
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de !important;
    }
    span.select2-selection.select2-selection--single, span#select2-subject_id-container{ height: 34px; line-height: 34px; }
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  top: -5px;
  right: 105%; 
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{ color: #000 !important; }
.techer-form .box-header.with-border{ display: block; position: relative;}
.form-group{ display: inline-block; width: 49%; }
.form-group:nth-child(odd) {margin-right: 1.4%;}
.margin-top .form-group:nth-child(even) {margin-right: 1.4%;}
.margin-top .form-group:nth-child(odd) {margin-right: 0;}
.margin-top .form-group:nth-last-child(1){    margin-top: -42px;
    position: relative;
    top: -87px;}
.form-group-margin-right{margin-right: 1.4%;}

.css-serial-counter {

  counter-reset: serial-number;  /* Set the serial number counter to 0 */

}



.css-serial-counter td:first-child:before {

  counter-increment: serial-number;  /* Increment the serial number counter */

  content: counter(serial-number);  /* Display the counter */

}
</style>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>EB</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E-Book</b>Library</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu" style="display: none;">
           
            <ul class="dropdown-menu">
             
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                     <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

          if($user_type=='4'){
             
            $p_id= \App\School::where('user_id',$user_id)->value('p_id');

          }

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
          @if($user_type=='4')
         <?php $pblr_logo=\App\Publisher::where('user_id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif

                      </div>
                     
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">

                         <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
              @if($user_type=='4')
         <?php $pblr_logo=\App\Publisher::where('user_id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
                       <!--  <img src="{{ asset('admin/dist/img/user3-128x128.jpg')}}" class="img-circle" alt="User Image"> -->
                      </div>
                     
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">

   <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
              @if($user_type=='4')
         <?php $pblr_logo=\App\Publisher::where('user_id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
                  </div>
                    
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                         <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
              @if($user_type=='4')
         <?php $pblr_logo=\App\Publisher::where('user_id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
                     
                      </div>
                     
                      
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">

   <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif
              @if($user_type=='4')
         <?php $pblr_logo=\App\Publisher::where('user_id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 80px !important;">
          @endif


                       <!--  <img src="{{ asset('admin/dist/img/user4-128x128.jpg')}}" class="img-circle" alt="User Image"> -->
                      </div>
                     
                     
                    </a>
                  </li>
                </ul>
              </li>
            
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">


       <?php  
          
            
            if($user_type=='1'){
              $list= \App\School::where('status','1')->where('is_new','1')->get();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\School::where('p_id','=',$pub_id)->where('status','1')->where('is_new','1')->get();
       
            }
           $cnt= count($list);
           

             ?>

              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{$cnt}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{$cnt}} new schools request</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @if(!empty($list))
                @foreach($list as $new)
               <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> {{$new->name}}
                    </a>
                  </li>


                @endforeach
                @endif
                  
                 
                </ul>
              </li>
              @if(!empty($list))
              <li class="footer"><a href="{{ url('/school/new_school_list')}}">View all</a></li>
              @endif
            </ul>
          </li>
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" >
 <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image" style="height: 30px !important;width:30px!important;">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 30px !important;width:30px!important;">
          @endif
                @if($user_type=='4')
         <?php 

        

         $pblr_logo=\App\Publisher::where('id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 30px !important;width:30px!important;">
          @endif
             <!--  <img src="{{ asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"> -->
              <span class="hidden-xs"><?php  echo  $user_info=Auth::user()->name;      ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">


<?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>


          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image">
          @endif
              @if($user_type=='4')
         <?php $pblr_logo=\App\Publisher::where('id','=',$p_id)->value('pblr_logo');   ?>
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" >
          @endif



 <?php    $user_info_2=Auth::user()->account_type;   
 $created_at=Auth::user()->created_at;            ?>

           
                <p>
                  {{$user_info}} - @if($user_info_2=='2') Publisher @endif  @if($user_info_2=='1') Super Admin @endif
                  <small>{{ date('d-m-Y',strtotime($created_at))}}</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-primary btn-flat">Profile</a>
                </div>
                <div class="pull-right">

                  <a class="btn btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                 <!--  <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a> -->
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a class="btn btn-primary minicart-trigger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>
                                        
                                    </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
            
            
            
            <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <div class="user-panel">
        <div class="pull-left image">
          <?php   $user_type=Auth::user()->account_type; 
          $user_id=Auth::user()->id; 

      ?>
          @if($user_type=='1')
          <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image" style="height: 50px !important;width:auto!important;">
          @endif
          @if($user_type=='2')
 <?php $pblr_logo=\App\Publisher::where('user_id','=',$user_id)->value('pblr_logo');   ?>

         @if($pblr_logo!='')
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr_logo}}" class="img-circle" alt="User Image" style="height: 50px !important;width:auto !important;">
          @else
            <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image" style="height: 50 !important;width:auto !important;">

          @endif
          @endif
          @if($user_type=='4')

             <?php $pblr1_logo=\App\Publisher::where('id','=',$p_id)->value('pblr_logo');   ?>
           
           @if($pblr1_logo!='')
            <img src="{{ asset('images/publisher_logo/')}}/{{$pblr1_logo}}" class="img-circle" alt="User Image" style="height: 50 !important;width:auto !important;">
          @else
            <img src="{{ asset('images/techive.png')}}" class="img-circle" alt="User Image" style="height: 50 !important;width:auto !important;">

          @endif


          @endif

         
        </div>
        <div class="pull-left info">
          <p><?php  echo  $user_info=Auth::user()->name;      ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      
      <ul class="sidebar-menu" data-widget="tree">
       <!--  <li class="header">MAIN NAVIGATION</li> -->
       <li class="@if(request()->segment(1)=='home')active @endif">
          <a href="{{url('/home')}}">
            <i class="fa fa-user"></i> <span>Dashboard</span>
               </a>
        </li>
        
      <?php    $user_info=Auth::user()->account_type;           ?>

            @if($user_info=='1')

       



         <li class="@if(request()->segment(2)=='publisher')active @endif">
          <a href="{{url('/super_admin/publisher')}}">
            <i class="fa fa-user"></i> <span>Publication</span>
               </a>
        </li>
         @endif

         <?php    $user_info=Auth::user()->account_type;           ?>

            @if($user_info=='2')
            
        <li class="@if(request()->segment(2)=='profile') active @endif">
          <a href="{{ url('/publisher/profile')}}">
            <i class="fa fa-user"></i> <span>My Profile</span>
               </a>
        </li>
      
        @endif
         @if($user_info=='4')
          <li class="@if(request()->segment(2)=='school_profile') active @endif">
          <a href="{{ url('/schools/profile')}}">
            <i class="fa fa-user"></i> <span>My Profile</span>
               </a>
        </li>


         @endif

          @if($user_info!='4')
        <li class="@if(request()->segment(1)=='school') active @endif">
          <a href="{{url('/school')}}">

            <i class="fa fa-graduation-cap"></i> <span>School</span>
               </a>
        </li>
         @endif


        @if($user_info=='4')
            <li class="@if(request()->segment(1)=='my_books') active @endif">
          <a href="{{url('/my_books')}}">

            <i class="fa fa-graduation-cap"></i> <span>Books</span>
               </a>
        </li>

            <li class="@if(request()->segment(1)=='issue_ebooks') active @endif">
          <a href="{{url('/issue_ebooks')}}">

            <i class="fa fa-graduation-cap"></i> <span>Issue E-Books</span>
               </a>
        </li>

        @endif
 
          
        @if($user_info=='1' || $user_info=='2' )
         
        <li class="treeview @if(request()->segment(1)=='series' || request()->segment(1)=='accesscode' || request()->segment(1)=='class_master' || request()->segment(1)=='subject_master' || request()->segment(1)=='subject_master')active @endif">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Configration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <li><a href="{{ url('/series')}}"><i class="fa fa-circle-o"></i>Add Series</a></li>
            <li><a href="{{ url('/accesscode')}}"><i class="fa fa-circle-o"></i> Add E-Book</a></li>
            @if($user_info=='1')

            <li><a href="{{url('/class_master')}}"><i class="fa fa-circle-o"></i>Add Class</a></li>
            <li><a href="{{url('/subject_master')}}"><i class="fa fa-circle-o"></i>Add Subject</a></li>
            @endif
                   
        
          </ul>
        </li>
      @endif
     
        @if($user_info=='1' || $user_info=='2')
        <li class="treeview @if(request()->segment(1)=='ebook_licence')active @endif">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>E-Book Library</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

     
          <li><a href="{{ url('/ebook_licence')}}"><i class="fa fa-circle-o"></i>Ebook Licence</a></li>
            
        
            
          </ul>
        </li>
         @endif
          @if($user_type=='1')
          <li><a href="{{url('/reset_password')}}"><i class="fa fa-users"></i> <span>Change Password</span></a></li>
          @endif
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

    @yield('content')



    <!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
  $(function () {
  $('.popover-test').popover({
    container: 'body'
  })
})
</script>
<script>
  $(function () {
    $('#example1').DataTable({
      'responsive': true
    });
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive': true
    })
  })
</script>
<script>
  $(function () {
    $('.example').DataTable({
      'responsive': true
    });
   
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    });
</script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2_new').select2({
    placeholder: "Select Licence Type"
     });

    });

</script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
  //var sel=[];
$('.select2_new2').select2({
         placeholder: "Select School",
         
 });
 
 });

$(document).ready(function(){

$('.sumbit_form2').click(function(){
 var maximum = $('#no_of_available_licence').val();
 var number_of_licence=$('#no_of_licence').val();
 var mindata=$('.licence_from').val();
 var maxdata=$('.licence_to').val();
 var licence_type =$(".select2_new").val();
 var selected_school=$('.selected_school').val();
 var access_code_id=$('.access_code_id').val();
 var datepicker_from=$('.datepicker_from').val();
 var datepicker_to=$('.datepicker_to').val();
var _token = $('input[name="_token"]').val();
var formData = $('.licence_add_frm').serialize();
//alert(formData);
   $.ajax({
    url:"{{ url('/school/e_book_licence_verification') }}",
    method:"POST",
    data:{access_code_id:access_code_id,datepicker_from:datepicker_from,datepicker_to:datepicker_to,maximum:maximum,number_of_licence:number_of_licence, _token:_token},
    success:function(result)
    {
      if(result=='1'){
       $("#licence_add_frm").submit();


      }else{
  swal({
  type: "error",
  title: "Something Went Wrong!",
  text: result,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  confirmButtonColor: "#ff0055",
  cancelButtonColor: "#999999",
  
}).then(function() {
    window.location = "/ebook_licence";
});

      }
      
     
    }

   });

});

});



</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("select.select2_new2").change(function(){
        var selectedCountry = $(this).children("option:selected").val();
        $('.selected_school').val(selectedCountry);



        //alert("You have selected the country - " + selectedCountry);
    });
});
</script>
</script>
<script type="text/javascript">
  var dateToday = new Date();
 $(function () {
    $(".datepicker_from").datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    minDate: dateToday
    });

       
$(".datepicker_to").datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    minDate: dateToday
    });
   });


</script>

<script type="text/javascript">
   
$(function () {
   var dateToday = new Date();
  $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      minDate: dateToday,
    });
 
});
</script>
<script type="text/javascript">
  
    $(function () {
     
      $('.datepicker_old')..datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      minDate: dateToday
    });


    }); 
     

 
</script>

<script>
  $(document).ready(function(){
      $('#publisher_id').change(function(){
         var pub_id=$(this).val();

        if(pub_id != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('accesscode/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('#access_code').html(result);
    }

   });


     $.ajax({
    url:"{{ url('school/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('#school_id').html(result);
    }

   });
  }

      });

  });
 
</script>
<script>
  $(document).ready(function(){
      $('.publisher_id2').change(function(){
         var pub_id=$(this).val();
       // alert(pub_id);
        if(pub_id != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('accesscode/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('.access_code2').html(result);
    }

   });

     $.ajax({
    url:"{{ url('school/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('.school_id').html(result);
    }

   });



  }

      });

  });
 
</script>
<script>
  $(document).ready(function(){
      $('.publisher_id_new').change(function(){
         var pub_id=$(this).val();
       // alert(pub_id);
        if(pub_id != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('accesscode/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('.access_code_id').html(result);
    }

   });
  }

      });

  });
 
</script>
<script>
  $(document).ready(function(){
      $('.p_id').change(function(){
         var pub_id=$(this).val();
       // alert(pub_id);
        if(pub_id != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('teacher/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('.teacher_id').html(result);
    }

   });

   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('accesscode/fetch') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('.access_code').html(result);
    }

   });
  }

      });

  });
 
</script>

<script>
  $(document).ready(function(){
     $('.subject').change(function(){
      var user_type=$('#user_type').val();
         //var p_id=$('#p_id').val();

         if(user_type=='2'){
           var pid=$('#publisher_id').val();
         }else if(user_type=='1'){
         var pid=$('.new_pid').val();

         }
        // alert(pid);

         var sub_id=$(this).val();
        if(pid != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/series/fetch') }}",
    method:"POST",
    data:{p_id:pid,sub_id:sub_id, _token:_token},
    success:function(result)
    {
     $('.series').html(result);
    }

   });
  }
       
    });


  });

  </script>
  <script>
  $(document).ready(function(){
     $('#subject_id').change(function(){
         
          var user_type=$('#user_type').val();
         //var p_id=$('#p_id').val();

         if(user_type=='2'){
           var pid=$('#publisher_id').val();
         }else{
         var pid=$('#p_id').val();

         }

         var sub_id=$(this).val();
        if(pid != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/series/fetch') }}",
    method:"POST",
    data:{p_id:pid,sub_id:sub_id, _token:_token},
    success:function(result)
    {
     $('#series').html(result);
    }

   });
  }
       





     });


  });

  </script>
  <script>
function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (25+o.scrollHeight)+"px";
}

  </script>
  <script type="text/javascript">

</script>
<script>
  $(document).ready(function(){
   $('#access_code_id').change(function(){
   var code=$('#access_code_id').val();
  var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/chapter/fetch') }}",
    method:"POST",
    data:{code:code,_token:_token},
    success:function(result)
    {
     $('#chapter_id').html(result);
    }

   });

    $.ajax({
    url:"{{ url('/class/fetch') }}",
    method:"POST",
    data:{code:code,_token:_token},
    success:function(result)
    {
     $('#class_id').val(result);
    }

   });
   });

  });



</script>
<script>
  $(document).ready(function(){
   $('#access_code').change(function(){
   var code=$('#access_code').val();
  var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/chapter/fetch') }}",
    method:"POST",
    data:{code:code,_token:_token},
    success:function(result)
    {
     $('#chapter_id').html(result);
    }

   });

    $.ajax({
    url:"{{ url('/class/fetch') }}",
    method:"POST",
    data:{code:code,_token:_token},
    success:function(result)
    {
     $('#class_id').val(result);
    }

   });
   });

  });



</script>
<script>
  $(document).ready(function(){
   $('#access_code_id_2').change(function(){
   var code=$('#access_code_id_2').val();
  var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/chapter/fetch') }}",
    method:"POST",
    data:{code:code,_token:_token},
    success:function(result)
    {
     $('#chapter_id_2').html(result);
    }

   });
   });

  });



</script>

 
<script>
  $(document).ready(function(){
   $('#access_code_id').change(function(){
   var code=$('#access_code_id').val();
  var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/chapter/fetch') }}",
    method:"POST",
    data:{code:code,_token:_token},
    success:function(result)
    {
     $('#chapter_id').html(result);
    }

   });
   });

  });



</script>



<script type="text/javascript">
  $(document).ready(function() {
    $('#example_new').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value="">Select Any</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} )
</script>
<script>
      function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

    function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
          
        reader.onload = function (e) {
           // alert(e);
            $('.blah2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$(".logo").change(function(){
    readURL(this);
});
$('.banner').change(function(){
    
     readURL2(this);
    
});
  </script>
 
<script type="text/javascript">

</script>
<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('/questions/add_chapter'); ?>";
      var i=1;  


      $('#add_chapter').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td></td><td><input type="text" name="chapter_name[]" class="form-control name_list" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name2').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name2')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>
<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('/questions/add_chapter'); ?>";
      var i=1;  


      $('#edit_chapter').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="ch_no[]" placeholder="Chapter No" class="form-control ch_no" value="'+i+'" readonly="" /></td><td><input type="text" name="chapter_name[]" class="form-control name_list" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name2').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name2')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>
<script type="text/javascript">
  
  function function_add_more(){

 
  }
</script>
<script type="text/javascript">
$(document).ready(function(){
   var postURL = "<?php echo url('/chapter/edit'); ?>";
    $('.submit_chapter').click(function(){
         var chapters=$('.chapter_form').serialize();
         var _token = $('input[name="_token"]').val();
             $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('.chapter_form').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                       alert('ok');
                    }
                }  
           });


    });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $('#delete_bulk').click(function(){
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
     $("#bulk_delete_form").submit();

    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

  });
  });
</script>
  
  
  <style>
    .swal-button--confirm {
      background-color: #DD6B55;

    }
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
       $('.member_type').change(function(){
          var my_books=$('#my_books').val();
          var type=$('.member_type').val();
          //alert(my_books);

    if(my_books!='0'){
  var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('/member/fetch') }}",
    method:"POST",
    data:{my_books:my_books,type:type,_token:_token},
    success:function(result)
    {
     $('.member').html(result);
    }

   });



          }
       });

    });


  </script>
    <script>
$(document).ready(function(){

 $('#add_book').on('submit', function(event){
  event.preventDefault();
  
  var book_title=$('.title').val();
  var book_id=$('.book_id').val();
  var subject_id=$('#subject_id').val();
  
  var class_id=$('.class_id').val();
  var book_img=$('#book_img').val();
  if(book_title==''){
   //$('.book_title').text('Required Field');  
    $(".title").css('border-color', 'red');  
  }
  if(book_id==''){
   //$('.book_id').text('Required Field');  
     $(".book_id").css('border-color', 'red');   
  }
  if(subject_id==''){
  // $('.subject_id').text('Required Field');  
   $("#subject_id").css('border-color', 'red');     
  }
  if(class_id==''){
   //$('.class_id').text('Required Field');  
    $(".class_id").css('border-color', 'red');        
  }
  if(book_img==''){
   //$('.book_img').text('Required Field');  
    $("#book_img").css('border-color', 'red');        
  }
  
  $('#wait').show();
  $('#success').hide();
  $.ajax({
   url:"{{url('/accesscode/add_book')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
   
    $('#wait').hide();
    
    if(data.status=='ok'){
        
    
    $('.message').css('display', 'block');
    $('.message').text(data.message);
    $('.message').addClass(data.class_name);
    
   
      
    location.reload(true);
    }else{
    
    $('.message').css('display', 'block');
    $('.message').text(data.message);
    $('.message').addClass(data.class_name);
    
   // $('#uploaded_image').html(data.uploaded_image);
       //alert(data.status); 
    }
     
    
   }
     
  });
 });

});
</script>
<script>
$(document).ready(function(){

 $('#add_publisher_list').on('submit', function(event){
  event.preventDefault();
  
  
  $.ajax({
   url:"{{url('/publisher/add_publisher')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
     
    
    if(data.status=='ok'){
    $('#publisher_error').css('display', 'block');
    $('#publisher_error').html(data.message);
    $('#publisher_error').addClass(data.class_name);
         $("#publisher_error").fadeTo(2000, 500).slideUp(500, function(){
                         $("#publisher_error").slideUp(500);
                         
                          location.reload(true);
               });

     
    }else if(data.status='notok'){
    $('#publisher_error').css('display', 'block');
    $('#publisher_error').html(data.message);
    $('#publisher_error').addClass(data.class_name);
         $("#publisher_error").fadeTo(2000, 500).slideUp(500, function(){
                         $("#publisher_error").slideUp(500);
                         
                         // location.reload(true);
               });
       //alert(data.status); 
    }
     
   }
     
  });
 });

});
</script>

<script>
$(document).ready(function(){

 $('.edit_publisher').on('submit', function(event){
  event.preventDefault();
 $.ajax({
   url:"{{url('/publisher/edit_publisher')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
    
    
    if(data.status=='ok'){
         $('.publisher_error2').css('display', 'block');
    $('.publisher_error2').text(data.message);
    $('.publisher_error2').addClass(data.class_name);
  
 location.reload(true);
    }else if(data.status='notok'){
         $('.publisher_error2').css('display', 'block');
    $('.publisher_error2').text(data.message);
    $('.publisher_error2').addClass(data.class_name);
  
      
    }
      
   }
     
  });
 });

});
</script>
<script>
$(document).ready(function(){

 $('#add_school').on('submit', function(event){
  event.preventDefault();
  
  $.ajax({
   url:"{{url('/school/add_school')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
   
    $('#school_error').css('display', 'block');
    $('#school_error').html(data.message);
    $('#school_error').addClass(data.class_name);
  
    
    if(data.status=='ok'){
        
        location.reload(true);
    }else if(data.status='notok'){
        
       //alert(data.status); 
    }
     
    
   }
     
  });
 });

});
</script>
<script>
    function change_new_pass2(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("At least 6 characters are required");
         $('.new_pass_mis').removeClass("d-none").addClass("d-block");
         $('.new_pass_mis').text("At least 6 characters are required ");
         
         $('#new_pass').css("border", "1px solid red");
         $('#new_pass').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("At least one letter in lower case is required."); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("At least one letter in lower case is required.");
         $('#new_pass').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("At least one letter in upper case is required."); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
         $('.new_pass_mis').text("At least one letter in upper case is required.");
          $('#new_pass').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("At least one special character is required."); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("At least one special character is required.");
         $('#new_pass').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("At least one digit is required.");
        errors.push("At least one digit is required.");
         $('#new_pass').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.new_pass_mis').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        $('.new_pass_mis').removeClass("d-block").addClass("d-none");
        $('.new_pass_mis').hide();
        
        $('#new_pass').css('border','');
         return true;
    }
    }
</script> 
<script>
    function change_c_pass2(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("At least 6 characters are required");
         $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("At least 6 characters are required");
         
         $('#c_password').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("At least one letter in lower case is required."); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("At least one letter in lower case is required.");
         $('#c_password').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("At least one letter in upper case is required."); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("At least one letter in upper case is required.");
          $('#c_password').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("At least one special character is required."); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("At least one special character is required.");
         $('#c_password').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("At least one digit is required.");
        errors.push("At least one digit is required.");
         $('#c_password').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.c_pass_mis').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        
       var new_pass= $('#c_password').val();
       var c_pass= $('#new_pass').val();
       if(new_pass!=c_pass){
          $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("Confirm Password not Match with New Password");  
           
       }else{
            $('.c_pass_mis').removeClass("d-block").addClass("d-none");
        $('.c_pass_mis').hide();
        
        $('#c_password').css('border','');
         return true;
           
       }
       
    }
    }
</script> 
  
  <script>
    function change_new_pass(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("At least 6 characters are required");
         $('.new_pass_mis').removeClass("d-none").addClass("d-block");
         $('.new_pass_mis').text("(At least 6 characters are required)");
         
         $('#new_pass').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("(At least one letter in lower case is required.)"); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("(At least one letter in lower case is required.)");
         $('#new_pass').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("(At least one letter in upper case is required.)"); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
         $('.new_pass_mis').text("(At least one letter in upper case is required.)");
          $('#new_pass').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("(At least one special character is required.)"); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("(At least one special character is required.)");
         $('#new_pass').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("(At least one digit is required.)");
        errors.push("(At least one digit is required.)");
         $('#new_pass').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.new_pass_mis').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        $('.new_pass_mis').removeClass("d-block").addClass("d-none");
        $('.new_pass_mis').hide();
        
        $('#new_pass').css('border','');
         return true;
    }
    }
</script> 
<script>
    function change_c_pass(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("At least 6 characters are required");
         $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("(At least 6 characters are required)");
         $('#c_password').val('');
         $('#c_password').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("(At least one letter in lower case is required.)"); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("(At least one letter in lower case is required.)");
        $('#c_password').val('');
         $('#c_password').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("(At least one letter in upper case is required.)"); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("(At least one letter in upper case is required.)");
         $('#c_password').val('');
          $('#c_password').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("(At least one special character is required.)"); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("(At least one special character is required.)");
        $('#c_password').val('');
         $('#c_password').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("(At least one digit is required.)");
        errors.push("(At least one digit is required.)");
        $('#c_password').val('');
         $('#c_password').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.c_pass_mis').removeClass("d-none").addClass("d-block");
       $('#c_password').val('');
             return false;
    }else{
        
       var new_pass= $('#c_password').val();
       var c_pass= $('#new_pass').val();
       if(new_pass!=c_pass){
          $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("(Confirm Password not Match with New Password)");  
         $('#c_password').val('');
           
       }else{
            $('.c_pass_mis').removeClass("d-block").addClass("d-none");
        $('.c_pass_mis').hide();
        
        $('#c_password').css('border','');
         return true;
           
       }
       
    }
    }
</script> 

  <script src="http://malsup.github.com/jquery.form.js"></script>
   
  
  <style>
    .swal-button--confirm {
      background-color: #DD6B55;

    }
  </style>
  <script type="text/javascript">
  function checkmobile(sel)
{
     // alert(data);
    var phone_number = sel.value;  
     //alert(phone_number);
      if(phone_number.length!=10){

     $('.message').text('(Mobile no. should be of 10 digits only)');
     $('.message').removeClass("d-none").addClass("d-block");
     $('.message').show();

      $('.mobile').val('');
      $('.mobile').css("border", "1px solid red");
        
    }else{
      $('.message').removeClass("d-block").addClass("d-none");
      $('.message').hide();
      //$('#phone_no').val('');
      $('.mobile').css('border','');

    }}
</script>
<script> 
$(document).ready(function(){
    $('.email').change(function(){
        
      var email=  $('.email').val();
      var _token = $('input[name="_token"]').val();
  
 if (validateEmail(email)) {
    $.ajax({
    url:"{{ url('/test/email') }}",
    method:"POST",
    data:{email:email,_token:_token},
    success:function(result)
    {
     
     if(result==1){
         $('.email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(This email id is already taken)");
         $('.email').val(''); 
     }else{
         $('.email_mis').removeClass("d-block").addClass("d-none");
          $('.email').css("border", ""); 
          $('.email_mis').text("");
     }
    
    }

   });
 
 
 
 
  } else {
   
      $('.email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(Invalid Email)");
         $('.email').val(''); 
   
   
  }
      
        
    });
    
});

</script>
<script>
    function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
</script>
<script>
    $(document).ready(function(){
       $(".sc_ph_no").change(function() {
           
    var phone_no = $(this).val();
   

     var goodColor = "#0C6";
    var badColor = "#FF9B37";

    if(phone_no.length!=10){
   // alert('no good');
     $('.message').text('Mobile no. should be of 10 digits only');
     $('.message').show();
      $('.sc_ph_no').val('');
      $('.sc_ph_no').css("border", "1px solid red");
        
    }else{
       // alert('good');
      $('.message').hide();
      //$('#phone_no').val('');
      $('.sc_ph_no').css('border','');

    }
});
        
    });
</script>
<script> 
$(document).ready(function(){
    $('.email').change(function(){
        
      var email=  $('.email').val();
      var _token = $('input[name="_token"]').val();
  
 if (validateEmail(email)) {
    $.ajax({
    url:"{{ url('/test/email') }}",
    method:"POST",
    data:{email:email,_token:_token},
    success:function(result)
    {
     
     if(result==1){
         $('.email').css("border", "1px solid red"); 
         $('.email_mis').text("(This email id is already taken)");
         $('.email_mis').show();
         $('.email').val(''); 
     }else{
         $('.email_mis').hide();
          $('.email').css("border", ""); 
          $('.email_mis').text("");
     }
    
    }

   });
 
 
 
 
  } else {
   
      $('.email').css("border", "1px solid red"); 
         $('.email_mis').show();
         $('.email_mis').text("(Invalid Email)");
         $('.email').val(''); 
   
   
  }
      
        
    });
    
});

</script>
<script>
    function password_validate(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("At least 6 characters are required");
         $('.password_mis').show();
         $('.password_mis').text("At least 6 characters are required ");
         
         $('.password').css("border", "1px solid red");
         $('.password').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("At least one letter in lower case is required."); 
        $('.password_mis').show();
        $('.password_mis').text("At least one letter in lower case is required.");
         $('.password').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("At least one letter in upper case is required."); 
         $('.password_mis').show();
         $('.password_mis').text("At least one letter in upper case is required.");
          $('.password').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("At least one special character is required."); 
         $('.password_mis').show();
        $('.password_mis').text("At least one special character is required.");
         $('.password').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
       $('.password_mis').show();
        $('.password_mis').text("At least one digit is required.");
        errors.push("At least one digit is required.");
         $('.password').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.password_mis').show();
             return false;
    }else{
       // $('.password_mis').removeClass("d-block").addClass("d-none");
        $('.password_mis').hide();
        
        $('.password').css('border','');
         return true;
    }
    }
</script> 
<script>
    $(document).ready(function(){
       $(".phone_no").change(function() {
    var phone_no = $(".phone_no").val();

   var goodColor = "#0C6";
    var badColor = "#FF9B37";

    if(phone_no.length!=10){

     $('.message').text('Mobile no. should be of 10 digits only');
     $('.message').show();
      $('.phone_no').val('');
      $('.phone_no').css("border", "1px solid red");
        
    }else{
      $('.message').hide();
      //$('.phone_no').val('');
      $('.phone_no').css('border','');

    }
});
        
    });
</script>
<script>
    function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
</script>
<script>
    $(document).ready(function(){
       $(".phone_edit").change(function() {
    var phone_no = $(this).val();
     
   var goodColor = "#0C6";
    var badColor = "#FF9B37";

    if(phone_no.length!=10){

     $('.message_edit').text('Mobile no. should be of 10 digits only');
     $('.message_edit').show();
      $('.phone_edit').val('');
      $('.phone_edit').css("border", "1px solid red");
        
    }else{
      $('.message_edit').hide();
      //$('.phone_no').val('');
      $('.phone_edit').css('border','');

    }
});
        
    });
</script>
<script>
  $(document).ready(function(){
      $('#reset_password_publisher').on('submit', function(event){
        event.preventDefault();
   
  var _token = $('input[name="_token"]').val();
    $.ajax({
   url:"{{url('/publisher/change_password')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
      
    if(data.status=='ok'){
       // alert('ok');
    $('#reset_pass_error').addClass(data.class_name);
    $('#reset_pass_error').text(data.message);

     $("#reset_pass_error").fadeTo(2000, 500).slideUp(500, function(){
                         $("#reset_pass_error").slideUp(500);
                         
                        // location.reload();
                        });
   // $('#profile_error').addClass(data.class_name);
    }if(data.status=='notok'){

      //alert('not ok');
    $('#reset_pass_error').removeClass("alert-success");   
    $('#reset_pass_error').addClass(data.class_name);
    $('#reset_pass_error').text(data.message);
    $("#reset_pass_error").fadeTo(2000, 500).slideUp(500, function(){
                         $("#reset_pass_error").slideUp(500);
                         
                        // location.reload();
                        });
    }
    
   }
     
  }); 
    
    
      });   
  }) ;
    
</script>
 <script type="text/javascript">
        $(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
});
    </script>

<script type="text/javascript">
$(document).ready(function () {
        $("#from").datepicker({

           startDate:new Date(),
           format:'dd/mm/yyyy',
            onClose: function () {
                $("#to").datepicker(
                    "change", {
                    minDate: new Date($('#from').val())
                });
               $("#from").datepicker({dateFormat: "dd/mm/yy"});
            }
        });

  
    });
</script>
<script>

  $(document).ready(function(){
    $('#to').click(function(){
 
var from_date=$('#from').val();

//alert(from_date);

        $("#to").datepicker({

           startDate:new Date(),
           format:'dd/mm/yyyy',
            onClose: function () {
                $("#from").datepicker(
                    "change", {
                    minDate: new Date($('#to').val())
                });
               $("#to").datepicker({dateFormat: "dd/mm/yy"});
            }
        });

    });

  });
  </script>

<?php  if(Request::segment(1)=='home'){ ?>
 {!! Charts::scripts() !!}
        {!! $chart1->script() !!}
         {!! $chart2->script() !!}
          {!! $chart3->script() !!}
           {!! $chart4->script() !!}
<?php } ?>

</body>
</html>



