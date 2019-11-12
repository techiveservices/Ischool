
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')
<style>
.chapter_list_on_hover{text-align:center; padding: 18px !important;}
.chapter_list_on_hover:hover{ border-bottom: 1px solid #333; background-color: #000; color: #fff;  }
</style>
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
       Issue E-Book
        <small>Issue to Member</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">E-Book</a></li>
        <li class="active">Issue to Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <div class="col-md-1" style="float: right;">
          
               </div>

            </div>
        
        

            <!-- /.box-header -->
            <div class="box-body">

              @if(session('success'))
    <div class="alert alert-success">
        <?php
          $msg= session('success');
          echo $msg[0];
        ?>
       
    </div>
@endif

             @if(session('failure'))
    <div class="alert alert-danger">
        <?php
          $msg= session('failure');
          echo $msg[0];
        ?>
       
    </div>
@endif

    


<form action="{{url('/ebook/issue_to_member')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="email">Books</label>
    <?php
      $user_id=Auth::user()->id;
   $school_id= \App\School::where('user_id',$user_id)->value('id');
 $list= \App\EbookAssigned::where('school_id','=',$school_id)->get();


    ?>
  <select class="form-control select2" name="books" id="my_books">
    <option value="0">Select Book</option>
      @if(!empty($list))
        @foreach($list as $new)
      <?php
        $access_code_id=  \App\EbookLicence::where('id',$new->ebook_id)->value('access_code_id');

        $e_book_id=  \App\EbookLicence::where('id',$new->ebook_id)->value('id');



        $book_info=\App\Book::where('id',$access_code_id)->first();
      ?>


          <option value="{{$e_book_id}}">{{$book_info->access_code}}({{$book_info->title }})</option>
        

        @endforeach
      @endif
  </select>

  
  </div>
  <div class="form-group">
    <label for="pwd">Member Type</label>
    <select name="member_type" class="form-control member_type" >
      <option value="0">Select Member Type</option>
      <option value="1">Teacher</option>
      <option value="2">Student</option>
     
    </select>
  </div>
  <div class="wt-100">
    <label for="email">Member</label>
     <select name="member" class="form-control member select2" >
    <option value="0">Select Member</option>


     </select>


  </div>
  <div class="form-group">
    <label for="pwd">Issue from</label>
    <input type="text" class="form-control datepicker_from" id="issue_from" name="issue_from">
  </div>
  <div class="form-group">
    <label for="email">Issue To</label>
    <input type="text" class="form-control datepicker_to" id="issue_till" name="issue_to">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
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