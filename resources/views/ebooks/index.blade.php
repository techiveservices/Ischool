
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')
<style>
.chapter_list_on_hover{text-align:center; padding: 18px !important;}
.chapter_list_on_hover:hover{ border-bottom: 1px solid #333; background-color: #000; color: #fff;  }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        E-Book Licence
        <small>All E-book Licence </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">E-Book</a></li>
        <li class="active">Licence Information</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <div class="col-md-1" style="float: right;">
<?php
            $user_type=\Auth::user()->account_type;
           
?>
              @if($user_type=='1')
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
              @endif

               </div>

            </div>
             <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="width:60%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add E-book Licence</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
          
            <!-- /.box-header -->
                 <form method="POST" enctype="multipart/form-data" action="{{ url('/ebook_licence/save')}}">
      

              @csrf

           

    <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;

     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
       ?>

 <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif">




       <?php if($user_type=='1'){

        $access_code=\App\Book::where('status','=','1')->get();

        }elseif($user_type=='2'){
      
      $user_id=Auth::user()->id;
      $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');

       $access_code=\App\Book::where('p_id','=',$pub_id)->where('status','=','1')->get();
       } 
      
      //echo count($access_code);
      ?>
          
         
   @if($user_type!='2')
             <div class="form-group" style="">
                <label style="width:100%;">Publication</label>
                <select class="form-control publisher_id_new select2" name="p_id" style="width:100%;" id="publisher_id_new" >
                   <option value="">Select Publisher</option>
                   <?php   $list3= \App\Publisher::all();  
                          $user_type=Auth::user()->account_type;
                          if($user_type=='2'){
                          $user_id=Auth::user()->id;
                          $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
                          }elseif($user_type=='1'){
                         $user_id=0;
                          $pub_id=0;

                          }

                       ?>
                        @if(!empty($list3))
                   @foreach($list3 as $list2)

                  <option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @endif>{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif

               </select>
            </div>
            @endif


             <div class="form-group">
              <label>Book Id</label>
               <select  name="access_code_id" class="form-control access_code_id select2" id="access_code_id" style="width:100% !important;" required>
               <option value="">Select Book</option>

            <?php
            if($user_type=='2'){

          foreach($access_code as $new){                  ?>
             <option value="{{$new->id}}">{{$new->access_code}}({{$new->title}})</option>
          <?php }}  ?>
           </select>
          


             </div>
  




  <div class="form-group">
    <label for="exampleInputEmail1">Select License Type <i class="fa fa-external-link popover-test" aria-hidden="true" title="Licence Type" data-content="Popover body content is set in this attribute."></i></label>
    <select class="form-control select2_new" name="licence_type[]" placeholder="Select Licence Type"  style="width:100%;" multiple="multiple" required>
      <option value="Software">Software</option>
      <option value="Hardware">Hardware</option>
    </select>
 
  </div>
   
  <div class="form-group">
    <label for="exampleInputPassword1">Number of Licence <i class="fa fa-external-link popover-test" aria-hidden="true" title="Number Of Licence" data-content="this licence is only valid for number of alloted user"></i></label>
    
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Number Of Licence" name="no_of_licence" value="" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" required>

  </div>

 <div class="form-group" style="width:30%;">
                <label>Date from:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
        <input type="text" class="form-control pull-right datepicker_ds" id="from" name="date_from" value="" required>
                </div>
                <!-- /.input group -->
              </div>

 <div class="form-group" style="width:30%;">
                <label>Date To:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>

         <input type="text" class="form-control pull-right datepicker_ds" id="to" name="date_to" value="" required>
                </div>
                <!-- /.input group -->
  </div>
  <div class="form-group" style="width:33.9%;margin-right: 0;">
                <label>Number of Pages:</label>
    <input type="text" class="form-control pull-right" id="no_of_page" name="no_of_page" value="" required="">
               
  </div>
 
  

  <button type="submit" class="btn btn-primary">Submit</button> 
          



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
     <?php     if (Session::get('success_add')){ ?>
    <div class="alert alert-success"> {{ Session::get('success_add')}}</div>



    <?php     Session::forget('success_add');     }

        ?>

      <?php   if (Session::get('failure_add')) { ?>
    <div class="alert alert-danger">   {{ Session::get('failure_add')}}</div>



    <?php     Session::forget('failure_add');     }

        ?>






              @if (session('success'))
    <div class="alert alert-success">
        <?php

         $msg=session('success');
         echo $msg[0];
        ?>


        {{ session('success') }}
    </div>
@endif
 @if (session('failure'))
    <div class="alert alert-danger">
        <?php

         $msg=session('failure');
         echo $msg[0];
        ?>


        {{ session('failure') }}
    </div>
@endif



          <?php  
           $user_type=Auth::user()->account_type;
            
            if($user_type=='1'){
              $list= \App\EbookLicence::all();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\EbookLicence::where('p_id','=',$pub_id)->get();

            }
           
                   // print_r($list);

             ?>
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                    @if($user_type!='2')
                  <th>Publication</th>
                    @endif
                  <th>Book</th>
                  <th>NoOfLicence</th>
                 <!--  <th>NoOfLicence</th> -->
                  <th>Licence Alloted</th>
                  <th>Valid From</th>
                  <th>Valid Till</th>
                 
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
                <?php  $book_info=\App\Book::where('id','=',$new->access_code_id)->first();

                ?>
                    {{$book_info->access_code}}</td>
                   <td>{{$new->no_licence}}</td>
                <!--   <td>{{$new->no_licence}}</td> -->
                  <td onclick="window.open('{{url('/provided_licence_list/')}}/{{$new->id}}')" class="chapter_list_on_hover">
               <?php
        $cnt= \App\EbookAssigned::where('ebook_id','=',$new->id)->sum('no_of_licence');
               echo $cnt;
               ?>     
     


                  </td>
                  <td>{{ date('d-m-Y',strtotime($new->licence_from))}}</td>
                   <td>{{date('d-m-Y',strtotime($new->licence_to))}}</td>
                 
                
                   <td>

           @if($user_type=='1')
             <button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>
         
          <a href="{{url('/ebook_licence/delete/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" >
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a>


           @endif
 
             <a href="{{url('/ebook_licence/assign/'.$new->id)}}">
                 <button type="button" class="tooltip btn btn-primary"><i class="fa fa-plus"></i><span class="tooltiptext">Allot Licence to School</span></button>
             </a>
  
                          </td>
                </tr>


        <div class="modal fade" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog">
            <div class="modal-content modal-content2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Accesscode Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form method="POST" enctype="multipart/form-data" action="{{ url('/ebook_licence/update')}}">
      

              @csrf

               <?php
             $ebooks=\App\EbookLicence::where('id','=',$new->id)->first();
              $licence_list= explode(',',$ebooks->licence_type);
          // print_r($licence_list);
         // if(in_array("Software", $licence_list)){ echo 'selected'; }            


      ?>
          
         
          
             <input type="hidden" name="id" value="<?php  echo $new->id;     ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Select License Type <i class="fa fa-external-link popover-test" aria-hidden="true" title="Licence Type" data-content="Popover body content is set in this attribute."></i></label>
    <select class="form-control select2_new" name="licence_type[]" placeholder="Select Licence Type"  style="width:100%;" multiple="multiple">
      <option value="Software" <?php if(in_array("Software", $licence_list)){ echo 'selected'; }             ?>>Software</option>
      <option value="Hardware" <?php if(in_array("Hardware", $licence_list)){ echo 'selected'; }             ?>>Hardware</option>
    </select>
    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
   
  <div class="form-group">
    <label for="exampleInputPassword1">Number of Licence <i class="fa fa-external-link popover-test" aria-hidden="true" title="Number Of Licence" data-content="this licence is only valid for number of alloted user"></i></label>
    
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Number Of Licence" name="no_of_licence" value="{{$ebooks->no_licence}}">

  </div>

 <div class="form-group">
                <label>Date from:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="datepicker1" name="date_from" value="{{date('d-m-Y',strtotime($ebooks->licence_from))}}">
                </div>
                <!-- /.input group -->
              </div>

 

 <div class="form-group">
                <label>Date To:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>

                  <input type="text" class="form-control pull-right datepicker" id="datepicker2" name="date_to" value="{{date('d-m-Y',strtotime($ebooks->licence_to))}}">
                </div>
                <!-- /.input group -->
              </div>
 
  

  <button type="submit" class="btn btn-primary">Submit</button> 
          



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



      <div class="modal fade" id="modal_allot_Licence_<?php  echo $new->id;     ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Allot Ebook Licence to School</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form method="POST" class="licence_add_frm" id="licence_add_frm" enctype="multipart/form-data" action="{{ url('/school/ebook_licence')}}">
      

              @csrf


 <?php
             $ebooks=\App\EbookLicence::where('id','=',$new->id)->first();
              $licence_list= explode(',',$ebooks->licence_type);
          // print_r($licence_list);
         // if(in_array("Software", $licence_list)){ echo 'selected'; }            
                

      ?>
              <input type="hidden" class="form-control pull-right licence_from" id="licence_from" name="licence_date_from" value="{{date('d-m-Y',strtotime($ebooks->licence_from))}}">

                  <input type="hidden" class="form-control pull-right licence_to" id="licence_to" name="licence_date_to" value="{{date('d-m-Y',strtotime($ebooks->licence_to))}}">


                   <input type="hidden" class="form-control pull-right selected_school" id="selected_school" name="selected_school" value="">
              
 
 <div class="col-md-12">
  <input type="text" name="id" class="access_code_id" value="<?php  echo $ebooks->id;     ?>">

 <div class="form-group">
    <label for="exampleInputEmail1">School</label>
    <select class="form-control select2_new2" name="school"  style="width:100%;">
      <option value="">Select School</option>
      option
<?php
      $schools= \App\School::all();

?>
   @if(!empty($schools))
      @foreach($schools as $list)
      <option value="{{$list->id}}">{{$list->name}}</option>

      @endforeach
   @endif
     
    </select>
    
  </div>
   </div> 
         
 <div class="col-md-12">
 <div class="form-group">
    <label for="exampleInputEmail1">Select License Type <i class="fa fa-external-link popover-test" aria-hidden="true" title="Licence Type" data-content="Popover body content is set in this attribute."></i></label>
    <select class="form-control select2_new" name="licence_type[]" placeholder="Select Licence Type"  style="width:100%;" multiple="multiple">

   @if(!empty($licence_list))
      @foreach($licence_list as $key=>$value)
      <option value="{{$value}}">{{$value}}</option>

      @endforeach
   @endif
     
    </select>
    
  </div>
   </div>
   <div class="col-md-12" >
  <div class="form-group">
    <label for="exampleInputPassword1">Number of Licence </label>
    
    <input type="hidden" class="form-control no_of_licence" id="no_of_licence" placeholder="Number Of Licence" name="no_of_licence" value="{{$ebooks->no_licence}}">

  </div>
</div>

  <div class="col-md-6">
 <div class="form-group">
                <label>Date from:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker_from" id="datepicker1" name="date_from" value="{{date('d-m-Y',strtotime($ebooks->licence_from))}}">
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

                  <input type="text" class="form-control pull-right datepicker_to" id="datepicker2" name="date_to" value="{{date('d-m-Y',strtotime($ebooks->licence_to))}}">
                </div>
                <!-- /.input group -->
              </div>
  </div>
  

  <button type="button" class="btn btn-primary sumbit_form">Submit</button> 
          



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
                  <th>Sr.No</th>
                    @if($user_type!='2')
                  <th>Publication</th>
                    @endif
                  <th>Book</th>
                  <th>NoOfLicence</th>
                 <!--  <th>NoOfLicence</th> -->
                  <th>Licence Alloted</th>
                  <th>Valid From</th>
                  <th>Valid Till</th>
                  
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