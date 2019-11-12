
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Book Readers
        <small>All Readers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Book</a></li>
        <li class="active">Readers</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
         
            <div class="box-header">
             <!--  <h3 class="box-title">Publishers</h3> -->

              </div>
                

            <!-- /.box-header -->
            <div class="box-body">

            <?php
               // echo count($readers_list);
            ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>School</th>
                  <th>Reader</th>
                  <th>Email</th>
                  <th>Visit Count</th>
                  <th>Average(in min)</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                	<?php  $i=1;  

                    
                    ?>
                	@if(!empty($readers_list))
                	
                	 @foreach($readers_list as $new)
                	
                  <?php

                 $no_of_hit= \App\BookReader::where('reader_email',$new->reader_email)->count();

                
                $visits= \App\BookReader::where('reader_email',$new->reader_email)->where('status','=','1')->get();

                  $total_min=0;
                foreach($visits as $list){
                 $ts1 = strtotime($list->login_at);
                 $ts2 = strtotime($list->logout_at);     
                 $min_diff = $ts2 - $ts1;                            
                 $time = ($min_diff/60);
                 $total_min=$total_min+$time ;
                }

                


                  ?>

                              <tr>
                	<td>{{$i++}}</td>
                  <td>
      <?php
            $school_info=  \App\School::where('user_id',$new->user_id)->first();

      ?>


                    {{$school_info->name}}</td>
                  <td>{{$new->reader_name}}</td>
                  <td>{{$new->reader_email}}</td>
                  <td>{{$no_of_hit}}</td>
                  <td>{{round($total_min/$no_of_hit)}}</td>
                 
                  <td>@if($new->status=='0') Active @else In-active @endif</td>
                 
                </tr>

          
                @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                  <th>SN</th>
                  <th>School</th>
                  <th>Reader</th>
                  <th>Email</th>
                  <th>Visit Count</th>
                  <th>Average(in min)</th>
                  <th>Status</th>
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