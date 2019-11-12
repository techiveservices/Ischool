
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
           <!--    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button> -->
               </div>

            </div>
             <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="width:60%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Accesscode</h4>
              </div>
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

              @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

       @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

         
               <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Book</th>
                  <th>School</th>
                  <th>Licence Type</th>
                  <th>NoOfLicence</th>
                  <th>Valid From</th>
                  <th>Valid Till</th>
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
                  
                  <td>
                <?php  

                 $ebook_info_id=\App\EbookLicence::where('id','=',$new->ebook_id)->value('access_code_id');
                $book_info=\App\Book::where('id','=',$ebook_info_id)->first();

                ?>
                    {{$book_info->access_code}}</td>
                    <td>

             <?php   $school_info= \App\School::where('id','=',$new->school_id)->first();                        ?>

                      {{$school_info->name}}</td>
                   <td>{{$new->licence_type}}</td>
                  <td>{{$new->no_of_licence}}</td>
                  
                  <td>{{ date('d-m-Y',strtotime($new->valid_from))}}</td>
                   <td>{{date('d-m-Y',strtotime($new->valid_till))}}</td>
                 
                  <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td>
    
             <button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

       <!--     <a href="{{url('/ebook_licence/delete/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" >
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a>

             <a href="{{url('/ebook_licence/assign/'.$new->id)}}">
                 <button type="button" class="tooltip btn btn-primary"><i class="fa fa-plus"></i><span class="tooltiptext">Allot Licence to School</span></button>
             </a> -->
  
                          </td>
                </tr>


        <div class="modal fade" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog">
            <div class="modal-content">
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
                  <th>S.No</th>
                  <th>Book</th>
                  <th>School</th>
                  <th>Licence Type</th>
                  <th>Valid From</th>
                  <th>Valid Till</th>
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