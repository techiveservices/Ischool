
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    
    <?php
      $user_type=   Auth::user()->account_type;
      $user_id= Auth::user()->id;
    
    ?>
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
  <?php  if($user_type=='1'){ ?>
              <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
    <?php $pub_cnt=\App\Publisher::all()->count(); 
          $active_pub_cnt=\App\Publisher::where('status','=','1')->count(); 
          $in_active_pub_cnt=\App\Publisher::where('status','=','0')->count(); 
         
    ?>            
                
                
              <h3>{{ $pub_cnt }}</h3>
                 <p><span style="float:left;"> Active:-{{$active_pub_cnt}}   </span> <span style="float:right;">In-Active:-{{$in_active_pub_cnt}}  </span></p><br><br>
                 <p>Total No of Publisher</p> 
              
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
           
            <a href="{{url('super_admin/publisher')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
     <?php  }  ?>   
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
<?php     
if($user_type=='2'){
      $p_id=\App\Publisher::where('user_id',$user_id)->value('id');
    $bookscnt= \App\Book::where('p_id','=',$p_id)->count(); 
    
    $active_book_cnt=\App\Book::where('p_id','=',$p_id)->where('status','=','1')->count(); 
          $in_active_book_cnt=\App\Book::where('p_id','=',$p_id)->where('status','=','0')->count(); 
    
    
    
    ?>
     <h3>{{$bookscnt}}</h3>
         <p><span style="float:left;"> Active:-{{$active_book_cnt}}   </span> <span style="float:right;">In-Active:-{{$in_active_book_cnt}}  </span></p><br><br>
              <p>Total No of Books</p>
<?php }

if($user_type=='1'){
     
    $bookscnt= \App\Book::all()->count(); 
    
      $active_book_cnt=\App\Book::where('status','=','1')->count(); 
          $in_active_book_cnt=\App\Book::where('status','=','0')->count(); 
    
    
    
    ?>
     <h3>{{$bookscnt}}</h3>
              <p><span style="float:left;"> Active:-{{$active_book_cnt}}   </span> <span style="float:right;">In-Active:-{{$in_active_book_cnt}}  </span></p><br><br>
              <p>Total No of Books</p>
<?php }
       ?>


             
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('/accesscode')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
          
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                 @if($user_type=='1')
     <?php    $school_cnt=  \App\School::all()->count();  
     
        $active_school_cnt=\App\School::where('status','=','0')->count(); 
          $in_active_school_cnt=\App\School::where('status','=','1')->count(); 
    
     
     
     ?>
                 
              <h3>{{$school_cnt}}</h3>
                @elseif($user_type=='2')
                
        <?php    
          $p_id=\App\Publisher::where('user_id',$user_id)->value('id');
        $school_cnt=  \App\School::where('p_id',$p_id)->count(); 
        
         $active_school_cnt=\App\School::where('p_id',$p_id)->where('status','=','0')->count(); 
          $in_active_school_cnt=\App\School::where('p_id',$p_id)->where('status','=','1')->count(); 
        
        ?>         
                 <h3>{{$school_cnt}}</h3>
                
                @endif
                <p><span style="float:left;"> Active:-{{$active_school_cnt}}   </span> <span style="float:right;">In-Active:-{{$in_active_school_cnt}}  </span></p><br><br>
              <p>No of Schools</p>
              
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/school')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
           @if($user_type=='1')
     <?php    $ebook_licence=  \DB::table('ebook_licence_info')->sum('no_licence');

            $ebook_licence_active=  \DB::table('ebook_assigned_licence')->sum('no_of_licence');

           $inactive_licence=$ebook_licence-$ebook_licence_active;


          ?>
                 
              <h3>{{$ebook_licence}}</h3>

                 <p><span style="float:left;"> Active:-{{$ebook_licence_active}}   </span> <span style="float:right;">In-Active:-{{$inactive_licence}}  </span></p><br><br>

                 @elseif($user_type=='2')   
               
                 <?php   
          $user_id=Auth::user()->id;
         $p_id=  \App\Publisher::where('user_id',$user_id)->value('id');
       $ebook_licence=  \DB::table('ebook_licence_info')->where('p_id',$p_id)->sum('no_licence');


       
       $p_school_list=\App\School::where('p_id',$p_id)->get();
       $ar=array();
       foreach($p_school_list as $list){
        array_push($ar, $list->id);

       }
          $ebook_licence_active = DB::table('ebook_assigned_licence')->whereIn('school_id', $ar)->sum('no_of_licence');


       // $ebook_licence_active=  \DB::table('ebook_assigned_licence')->sum('no_of_licence');

           $inactive_licence=$ebook_licence-$ebook_licence_active;


          ?>
                 
              <h3>{{$ebook_licence}}</h3>

                 <p><span style="float:left;"> Active:-{{$ebook_licence_active}}   </span> <span style="float:right;">In-Active:-{{$inactive_licence}}  </span></p><br><br>
              

              @endif 






              <p>No of Licence</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('/ebook_licence')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
          @if($user_type=='1' || $user_type=='2')
     <?php    $ebook_reader=  \DB::table('e_book_reader')->whereRaw('year(`login_at`) = ?', array(date('Y')))->count();
            $ebook_reader_active=  \DB::table('e_book_reader')->whereRaw('year(`login_at`) = ?', array(date('Y')))->where('status','=','0')->count();

            $ebook_reader_inactive=  \DB::table('e_book_reader')->whereRaw('year(`login_at`) = ?', array(date('Y')))->where('status','=','1')->count();


          ?>
                 
              <h3>{{ $ebook_reader}}</h3>
              <p><span style="float:left;"> Active:-{{$ebook_reader_active}}   </span> <span style="float:right;">In-Active:-{{$ebook_reader_inactive}}  </span></p><br><br>
               
                
      @endif
            
              <p>Total Book Reader</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('/book_readers')}}" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

<!-- Modal -->
<div class="modal fade" id="publications_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Publications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
<!-- -----------------------User Created----------------------------------->

        @if($user_type=='1')
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart1" data-toggle="tab">Pie</a></li>
              <li><a href="#sales-chart1" data-toggle="tab">Area</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="tab-pane active" id="revenue-chart1" style="position: relative; height: 300px;">
                  
                  <div class="app">
            <center>
                {!! $chart1->html() !!}
            </center>
        </div>
                
              </div>
              <div class="tab-pane" id="sales-chart1" style="position: relative; height: 300px;">
                  
                   <div class="app">
            <center>
                {!! $chart2->html() !!}
            </center>
        </div>
                  
                  
              </div>
            </div>
          </div>
      @endif

<!---------------------End User Created---------------------------->

   
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
            
            </div>
            <div class="box-body">
              <!-- chat item -->
              <div class="item">
       
        <div class="app">
            <center>
                {!! $chart4->html() !!}
            </center>
        </div>
     
              </div>
           
            </div>
            <!-- /.chat -->
            <div class="box-footer">
             
            </div>
          </div>
          
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
                        
            </div>
            <div class="box-body">
           
               <!-- Main Application (Can be VueJS or other JS framework) -->
        <div class="app">

            <center>
                {!! $chart3->html() !!}
            </center>
        </div>
        <!-- End Of Main Application -->
                     
            </div>
           
          </div>
          <!-- /.box -->

<!-- -----------------------------solid sales graph ---------------->
   <!-- <div class="box box-solid bg-teal-gradient">
        <div class="box-footer no-border">
                    
            </div>
           
     </div> -->
<!------------------ /.box ------------------------->

          <!-- Calendar -->
        
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019-2020<a href="http://techive.in" target="_blank"> Techive</a>.</strong> All rights
    reserved.
  </footer>

 
 <!--  <div class="control-sidebar-bg"></div> -->
</div>
<!-- ./wrapper -->

@endsection


