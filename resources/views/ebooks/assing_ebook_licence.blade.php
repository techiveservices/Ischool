
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')
<style>
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top{
  z-index: 999999999 !important;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        E-Book Licence
        <small>List of E-book Licence Information</small>
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
           <!--    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button> -->
               </div>

            </div>
             <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width:60%;">
            <div class="modal-content">
              
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
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
             <form method="POST" class="licence_add_frm" id="licence_add_frm" enctype="multipart/form-data" action="{{ url('/school/ebook_licence')}}">
      

              @csrf


 <?php
             $ebooks=\App\EbookLicence::where('id','=',$id)->first();
              $licence_list= explode(',',$ebooks->licence_type);
          // print_r($licence_list);
         // if(in_array("Software", $licence_list)){ echo 'selected'; }            
                

      ?>
    <input type="hidden" class="form-control no_of_licence" id="no_of_available_licence" placeholder="Number Of Licence" name="no_of_available_licence" value="{{$ebooks->no_licence}}">

    <input type="hidden" class="form-control pull-right licence_from" id="licence_from" name="licence_date_from" value="{{date('d-m-Y',strtotime($ebooks->licence_from))}}">

    <input type="hidden" class="form-control pull-right licence_to" id="licence_to" name="licence_date_to" value="{{date('d-m-Y',strtotime($ebooks->licence_to))}}">


   <input type="hidden" class="form-control pull-right selected_school" id="selected_school" name="selected_school" value="">
              
 
 <div class="col-md-12">
  <input type="hidden" name="access_code_id" class="access_code_id" value="<?php  echo $ebooks->id;  ?>">

 <div class="form-group">
    <label for="exampleInputEmail1">School</label>
    <select class="form-control select2_new2" name="school"  style="width:100%;">
      <option value="">Select School</option>
      option
<?php
      $schools= \App\School::where('p_id',$ebooks->p_id)->get();

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
    <button type="submit" class="btn btn-primary sumbit_form">Submit</button>
</div> 
          



          </form>
             
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