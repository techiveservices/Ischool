
@extends('super_admin.include.super_admin_dashboard_head')

@section('content')
<style>

#dynamic_field td:nth-child(2) {
    width: 200px;
}
#dynamic_field td:nth-child(1) {
    width: 50px;
    text-align: center;
    /* padding: 8px 5px; */
}
.chapter_list_on_hover{text-align:center; padding: 18px !important;}
.chapter_list_on_hover:hover{ border-bottom: 1px solid #333; background-color: #000; color: #fff;  }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Books
        <small>All Books</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Books</a></li>
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
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">+ Add</button>
               </div>

            </div>
          
     <div class="modal fade modal-default" id="modal-default">
          <div class="modal-dialog" style="width:80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Book</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
           
            <!-- /.box-header -->
            <!-- form start -->
        <form method="POST" enctype="multipart/form-data" action="{{ url('/accesscode/add_book')}}">
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

                  <option value="{{$list2->id}}" @if($pub_id!='0') selected="" disabled="true" @endif>{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>


              <!--   <input type="text" name="p_id" class="form-control" placeholder="Publisher Id" required=""> -->
              </div>
            
             @endif
           <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Title" autocomplete="off" >
              </div>
              
           <div class="form-group">
                <label>Book Id:</label>
                <input type="text" name="accesscode" class="form-control" placeholder="Book" required="" autocomplete="off" >
              </div>
             
           <div class="form-group">

             <?php    //print_r($subject);    ?>
                <label style="width:100%;">Select Subject:</label>
               <select name="subject" class="form-control select2" id="subject_id" required="" style="width:100%;">
                 <option value="">---Select---</option>
               @if(!empty($subject))
                  @foreach($subject as $sub)
                   <option value="{{$sub->id}}">{{$sub->name}}</option>

                  @endforeach
               @endif

               </select>
              </div>
             
           <div class="form-group">
                <label style="width:100%;">Select Series:</label>
               <select name="series" class="form-control select2" id="series" style="width:100%;">
                 <option value="">---Select---</option>
                  @if(!empty($series))
                     @foreach($series as $list)
                       <option value="{{$list->id}}">{{$list->series}}</option>

                     @endforeach
                   @endif
               </select>
              </div>
             
           <div class="form-group">
               <label style="width:100%;">Select Class:</label>
                <select name="class" id="" class="form-control select2" required="" style="width:100%;">
                   <option value="">---Select---</option>
                   @if(!empty($classes))
                     @foreach($classes as $list)
                       <option value="{{$list->id}}">{{$list->name}}</option>

                     @endforeach
                   @endif
                </select>
              </div>
            
               <!-- <div class="form-group" style="display:none">
                <label>No Of Chapter:</label>
                <input type="text" name="no_chapter" class="form-control" placeholder="No Of Chapter" autocomplete="off" >
              </div> -->
             
                <div class="form-group">
                 <label>Book pdf (only in pdf):</label>
                <input type="file" name="book_pdf" class="form-control" accept="application/pdf">
              </div>
             
           <div class="form-group">
                <label>Title Image (only in jpeg/png/jpg/gif/svg width 300 and height 100 allowed):</label>
                <input type="file" name="book_img" class="form-control" accept="image/*">
              </div>
            
         <!--   <div class="form-group">
                <label>Teacher Manual(only in pdf):</label>
                <input type="file" name="manual" class="form-control" accept="application/pdf">
              </div> -->
            
           <div class="form-group">
                <label>eBook link(url):</label>
                <input type="text" name="ebook" class="form-control" autocomplete="off" @if( $user_type=='2') readonly=""  @endif >
              </div>
             
      <!--      <div class="form-group">
                <label>Animation:</label>
                <input type="text" name="animation" class="form-control" autocomplete="off" >
              </div> -->
            
         <!--   <div class="form-group">
               <label>Select Start Year:</label>
                <select name="start_yr" id="" class="form-control">
                   <option value="">---Select---</option>
                   <option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option>                </select>
           </div>
             
           <div class="form-group">
               <label>Select End Year:</label>
                <select name="end_yr" id="" class="form-control">
                   <option value="">---Select---</option>
                   <option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option>                </select>
              </div>
             
           <div class="form-group">
               <label>Select Start Month:</label>
                <select name="start_month" id="" class="form-control">
                   <option value="">---Select---</option>
                   <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>                </select>
              </div>
             
           <div class="form-group">
               <label>Select End Month:</label>
                <select name="end_month" id="" class="form-control">
                   <option value="">---Select---</option>
                   <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>                </select>
              </div> -->
            <div class="form-group">
               <label>Licence from:</label>
              <input type="text" name="licence_from" value="" class="form-control datepicker_from" placeholder="Licence from" autocomplete="off" >
            </div>

            <div class="form-group">
               <label>Licence to:</label>
              <input type="text" name="licence_to" value="" class="form-control datepicker_to" placeholder="Licence To" autocomplete="off" >
            </div>

          
           
           <div class="form-group">
               <label>E-Book Price:</label>
              <input type="text" name="price" value="" class="form-control" placeholder="Price" autocomplete="off" >
              </div>
            
           <div class="form-group">
               <label>Book ISBN no.:</label>
              <input type="text" name="isbn" value="" class="form-control" placeholder="ISBN" autocomplete="off" >
              </div>
            
           <div class="form-group">
               <label>Book Author:</label>
              <input type="text" name="author" value="" class="form-control" placeholder="Author" autocomplete="off" >
              </div>
              


             <div class="form-group warning-100" style=" width: 100% !important;">
               <label>Book Description:</label>
               <textarea name="book_desc" id="" cols="30" rows="3" class="form-control" placeholder="ENTER" ></textarea>
              </div>
            
              
                  <h3>Add Chapter</h3>

                <div class="table-responsive css-serial-counter">  
                <table class="table table-bordered" id="dynamic_field">  
                   <tr><th>Chapter No</th><th>Chapter Name</th><th><button type="button" name="add_chapter" id="add_chapter" class="btn btn-success">Add More</button></th></tr>
                     
                </table>  
                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />   -->
            </div>













               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
 @if($errors->any())
     <div class="alert alert-warning" role="alert" style="max-width: 40%;">
  
<h4 class="">{{$errors->first()}}</h4>
</div>
@endif




          <?php  
          
            
            if($user_type=='1'){
              $list= \App\Book::all();
            }elseif($user_type=='2'){
       $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id');
              $list= \App\Book::where('p_id','=',$pub_id)->get();

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
                  <th>Book</th>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Series</th>
                  <th>NoOfCh</th>
                  <th>Class</th>
                  <th>Author</th>
                  <th>Price</th>
                  <th>Book Image</th>
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
                    @if($user_type!='2')
                  <td>

                   <?php  $pub_name= \App\Publisher::where('id','=',$new->p_id)->value('pblctn_name');                     ?>


                    {{$pub_name}}</td>
                    @endif
                  <td>{{$new->access_code}}</td>
                   <td>{{$new->title}}</td>
                  <td>
    <?php  $subject_name= \App\Subject::where('id','=',$new->subject)->value('name');                     ?>



                    {{$subject_name}}</td>
                  <td>

 <?php  $series_name= \App\Series::where('id','=',$new->Series)->value('series');                     ?>

                    {{$series_name}}</td>
                  <td onclick="window.open('{{url('/chapter_list/')}}/{{$new->id}}')" class="chapter_list_on_hover">
<?php
  $chapter_count = \App\Chapter::where('p_id','=',$new->p_id)->where('access_code','=',$new->id)->count();

  ?>

                  {{$chapter_count}}</td>
                  <td>

<?php  $class_name= \App\Classes::where('id','=',$new->class)->value('name');                     ?>

                    {{$class_name}}</td>
                  <td>{{$new->author}}</td>
                  <td>{{$new->price}}</td>

                 
                  <td>book image</td>
                  <td>@if($new->status=='0') In-active @else Active @endif</td>
                   <td>
    <div class="row">
          <div class="col-md-6">
             <button type="button" class="tooltip btn btn-primary" data-toggle="modal" data-target="#modal-default_edit_<?php  echo $new->id;     ?>"><i class="fa fa-edit"></i><span class="tooltiptext">Edit</span></button>

         <!--   <a href="{{url('/accesscode/delete_book/'.$new->id)}}">
                  <button type="button" class="tooltip btn btn-danger" style="margin-top:10px;">
                 <i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></button></a> -->

          </div>
          <div class="col-md-6 mt-2">
            @if($user_type=='1')


                 @if($new->status=='0')
                 <a href="{{url('/accesscode/activate_book/'.$new->id.'/1')}}">
                  @else

                 <a href="{{url('/accesscode/activate_book/'.$new->id.'/0')}}">

                  @endif



                  
        <button type="button" class="tooltip btn <?php if($new->status=='0'){?> btn-success <?php }else{ ?> btn-warning <?php } ?>" >
                 <i class="fa fa-check-square"></i><span class="tooltiptext"><?php if($new->status=='0'){ ?> Activate   <?php }else{ ?> Deactivate <?php } ?></span></button></a>

            @endif
       
          <!--   <button   type="button" class="tooltip btn btn-primary mt-2" data-toggle="modal" data-target="#modal-default_cart_<?php  echo $new->id;     ?>" style="margin-top:10px;"><i class="fa fa-shopping-cart"></i><span class="tooltiptext">Add to Cart</span></button> -->



          </div>
    </div>



                  </td>
                </tr>

                <!-- Modal -->
<div class="modal fade" id="exampleModal_{{$new->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content modal-content2">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Chapter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form method="post" action="{{ url('/chapter/edit')}}" class="chapter_form">
    @csrf
    <?php

   $book_info=\App\Book::where('id',$new->id)->first();
   

   if(!empty($book_info)){
     $chapters= \App\Chapter::where('p_id','=',$book_info->p_id)->where('access_code','=',$new->id)->get(); ?>


    <?php if(!empty($chapters)){
     foreach($chapters as $list){?>
      <div class="col-md-3">
      <div class="form-group">
        <input type="text" name="ids[]" value="<?php echo $list->id; ?>" class="form-control" style="display: none;">
       <input type="text" name="ch_no[]" value="<?php echo $list->ch_no; ?>" class="form-control">
     </div>
   </div>
   <div class="col-md-9">
     <div class="form-group">
       <input type="text" name="ch_name[]" value="<?php echo $list->ch_name; ?>" class="form-control">
      </div>
    </div>


      <?php }

   } ?>  

 <button type="button" class="btn btn-primary submit_chapter">Save changes</button>

 <?php }
        ?>


  
     </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


        <div class="modal fade margin-top" id="modal-default_edit_<?php  echo $new->id;     ?>">
          <div class="modal-dialog" style="width:80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Book Information</h4>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form method="POST" enctype="multipart/form-data" action="{{ url('/accesscode/edit_book')}}">
          @csrf
      <?php    $user_id=Auth::user()->id;
      $user_type=Auth::user()->account_type;
      



     $pub_id= \App\Publisher::where('user_id','=',$user_id)->value('id'); 
     $book_info= \App\Book::where('id','=',$new->id)->first(); 
    // print_r($book_info);



       ?>
       <input type="hidden" name="pid" class="new_pid" value="{{$book_info->p_id}}">
       <input type="hidden" name="sno" value="<?php  echo $new->id;     ?>">
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_type" value="{{$user_type}}" id="user_type">

        <input type="hidden" name="publisher_id" value="@if($user_type!='1'){{$pub_id}} @else {{0}} @endif" id="publisher_id">

          <div class="row">
      
            <div style="display:none;">
          
              <div class="form-group">
                <label style="width:100%;">Publication:</label>
                <select class="form-control p_id select2" name="p_id" style="width:100%;">
                  

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
              </div>


              
           <div class="form-group">
                <label>Title:</label>
          <input type="text" name="title" class="form-control" value="{{$book_info->title}}" placeholder="Title" autocomplete="off" >
              </div>
              
               
           <div class="form-group">
                <label>Book Id:</label>
                <input type="text" name="accesscode" class="form-control" placeholder="Book Id" required="" autocomplete="off" value="{{$book_info->access_code}}">
              </div>
              
               
           <div class="form-group">

             <?php    //print_r($subject);    ?>
                <label style="width:100%;">Select Subject:</label>
               <select name="subject" class="form-control subject select2" required="" style="width:100%;" >
                 <option value="">---Select---</option>
               @if(!empty($subject))
                  @foreach($subject as $sub)
                   <option value="{{$sub->id}}" @if($book_info->subject==$sub->id) selected @endif>{{$sub->name}}</option>

                  @endforeach
               @endif

               </select>
              </div>
              
               
           <div class="form-group">
                <label style="width:100%;">Select Series:</label>
               <select name="series" class="form-control series select2" style="width:100%;">
                 <option value="">---Select---</option>
                  @if(!empty($series))
                     @foreach($series as $list)
                       <option value="{{$list->id}}"  @if($book_info->Series==$list->id) selected @endif>{{$list->series}}</option>

                     @endforeach
                   @endif
               </select>
              </div>
              
               
           <div class="form-group">
               <label style="width:100%;">Select Class:</label>
                <select name="class" id="" class="form-control select2" required="" style="width:100%;">
                   <option value="">---Select---</option>
                   @if(!empty($classes))
                     @foreach($classes as $list)
                       <option value="{{$list->id}}" @if($book_info->class==$list->id) selected @endif>{{$list->name}}</option>

                     @endforeach
                   @endif
                </select>
              </div>
             
              
               <div class="form-group">
                <label>No Of Chapter:</label>
                <input type="text" name="no_chapter" class="form-control" placeholder="No Of Chapter" autocomplete="off"  value="{{$book_info->no_of_chapters}}">
              </div>
              
              
                <div class="form-group">
                 <label>Book pdf:</label>
                <input type="file" name="book_pdf" class="form-control" accept="application/pdf">
               <a href="{{ asset('images/book_pdf/')}}/{{$book_info->book_pdf}}" download>
                    download
               </a>



              </div>
               
               
          <!--  <div class="form-group">
                <label>Book image:</label>
                <input type="file" name="book_img" class="form-control" accept="image/*">
              <img src="{{ asset('images/book_img/')}}/{{$book_info->book_img}}" width="80px" height="80px">


              </div> -->
             
              
           <div class="form-group">
                <label>Teacher Manual:</label>
                <input type="file" name="manual" class="form-control" accept="application/pdf">
              
                  <a href="{{ asset('images/manual/')}}/{{$book_info->manual}}" download>
                    download
               </a>


              </div>
              
              
              
           <div class="form-group">
                <label>eBook(ebook url):</label>
                <input type="text" name="ebook" class="form-control" autocomplete="off" value="{{$book_info->ebook}}"  @if($user_type=='2') readonly=""  @endif>
              
              </div>
             
           <!--     <div class="col-md-4">
           <div class="form-group">
                <label>Animation:</label>
                <input type="text" name="animation" class="form-control" autocomplete="off" value="{{$book_info->animation}}" >
              </div>
              </div> -->
            
              <!-- <div class="col-md-4">
           <div class="form-group">
               <label>Select Start Year:</label>
                <select name="start_yr" id="" class="form-control">
                   <option value="">---Select---</option>
                   <option value="2018" @if($book_info->strt_yr=='2018') selected @endif>2018</option><option value="2019" @if($book_info->strt_yr=='2019') selected @endif>2019</option><option value="2020" @if($book_info->strt_yr=='2020') selected @endif>2020</option><option value="2021" @if($book_info->strt_yr=='2021') selected @endif>2021</option><option value="2022" @if($book_info->strt_yr=='2022') selected @endif>2022</option><option value="2023" @if($book_info->strt_yr=='2023') selected @endif>2023</option><option value="2024" @if($book_info->strt_yr=='2024') selected @endif>2024</option><option value="2025" @if($book_info->strt_yr=='2025') selected @endif>2025</option><option value="2026" @if($book_info->strt_yr=='2026') selected @endif>2026</option><option value="2027" @if($book_info->strt_yr=='2027') selected @endif>2027</option><option value="2028" @if($book_info->strt_yr=='2028') selected @endif>2028</option><option value="2029" @if($book_info->strt_yr=='2029') selected @endif>2029</option><option value="2030" @if($book_info->strt_yr=='2030') selected @endif>2030</option>                </select>
              </div>
              </div>
                <div class="col-md-4">
           <div class="form-group">
               <label>Select End Year:</label>
                <select name="end_yr" id="" class="form-control">
                   <option value="">---Select---</option>
                   <option value="2018" @if($book_info->end_yr =='2018') selected @endif>2018</option><option value="2019" @if($book_info->end_yr =='2019') selected @endif>2019</option><option value="2020" @if($book_info->end_yr  =='2020') selected @endif>2020</option><option value="2021" @if($book_info->end_yr  =='2021') selected @endif>2021</option><option value="2022" @if($book_info->end_yr =='2022') selected @endif>2022</option><option value="2023" @if($book_info->end_yr =='2023') selected @endif>2023</option><option value="2024" @if($book_info->end_yr  =='2024') selected @endif>2024</option><option value="2025" @if($book_info->end_yr  =='2025') selected @endif>2025</option><option value="2026" @if($book_info->end_yr  =='2026') selected @endif>2026</option><option value="2027" @if($book_info->end_yr  =='2027') selected @endif>2027</option><option value="2028" @if($book_info->end_yr  =='2028') selected @endif>2028</option><option value="2029" @if($book_info->end_yr  =='2029') selected @endif>2029</option><option value="2030" @if($book_info->end_yr  =='2030') selected @endif>2030</option>             </select>
              </div>
              </div>
                <div class="col-md-4">
           <div class="form-group">
               <label>Select Start Month:</label>
                <select name="start_month" id="" class="form-control">
                   <option value="">---Select---</option>
                <option value="1" @if($book_info->strt_mnth =='1') selected @endif>1</option>
                <option value="2" @if($book_info->strt_mnth =='2') selected @endif>2</option>
                <option value="3" @if($book_info->strt_mnth =='3') selected @endif>3</option>
                <option value="4" @if($book_info->strt_mnth =='4') selected @endif>4</option>
                <option value="5" @if($book_info->strt_mnth =='5') selected @endif>5</option>
                <option value="6" @if($book_info->strt_mnth =='6') selected @endif>6</option>
                <option value="7" @if($book_info->strt_mnth =='7') selected @endif>7</option>
                <option value="8" @if($book_info->strt_mnth =='8') selected @endif>8</option>
                <option value="9" @if($book_info->strt_mnth =='9') selected @endif>9</option>
                <option value="10" @if($book_info->strt_mnth =='10') selected @endif>10</option>
                <option value="11" @if($book_info->strt_mnth =='11') selected @endif>11</option>
                <option value="12" @if($book_info->strt_mnth =='12') selected @endif>12</option>
                    </select>
              </div>
              </div>
              <div class="col-md-4">
           <div class="form-group">
               <label>Select End Month:</label>
          <select name="end_month" id="" class="form-control">
                   <option value="">---Select---</option>
            <option value="1" @if($book_info->end_mnth =='1') selected @endif>1</option>
            <option value="2" @if($book_info->end_mnth =='2') selected @endif>2</option>
            <option value="3" @if($book_info->end_mnth =='3') selected @endif>3</option>
            <option value="4" @if($book_info->end_mnth =='4') selected @endif>4</option>
            <option value="5" @if($book_info->end_mnth =='5') selected @endif>5</option>
            <option value="6" @if($book_info->end_mnth =='6') selected @endif>6</option>
            <option value="7" @if($book_info->end_mnth =='7') selected @endif>7</option>
            <option value="8" @if($book_info->end_mnth =='8') selected @endif>8</option>
            <option value="9" @if($book_info->end_mnth =='9') selected @endif>9</option>
            <option value="10" @if($book_info->end_mnth =='10') selected @endif>10</option>
            <option value="11" @if($book_info->end_mnth =='11') selected @endif>11</option>
            <option value="12" @if($book_info->end_mnth =='12') selected @endif>12</option>

          </select>
              </div>
              </div> -->

               
           <div class="form-group">
               <label>Licence From:</label>
              <input type="text" name="start_licence"  class="form-control datepicker_from" placeholder="Licence Start" autocomplete="off" value="" >
              </div>
              
               
           <div class="form-group">
               <label>Licence Till:</label>
              <input type="text" name="end_licence"  class="form-control datepicker_to" placeholder="Licence End" autocomplete="off" value="" >
              </div>
              
           <!-- <div class="form-group">
               <label>Book Description:</label>
               <textarea name="book_desc" id="" cols="30" rows="3" class="form-control" placeholder="ENTER" >{{$book_info->book_desc}}</textarea>
              </div>
              <div class="form-group">
                <label>Book image:</label>
                <input type="file" name="book_img" class="form-control" accept="image/*">
              <img src="{{ asset('images/book_img/')}}/{{$book_info->book_img}}" width="80px" height="80px">


              </div> -->
             
           <div class="form-group">
               <label>Book Price:</label>
              <input type="text" name="price"  class="form-control" placeholder="Price" autocomplete="off" value="{{$book_info->price}}" >
              </div>
            
             
           <div class="form-group">
               <label>Book ISBN no.:</label>
              <input type="text" name="isbn"  class="form-control" placeholder="ISBN" autocomplete="off" value="{{$book_info->isbn}}">
              </div>
              
                
           <div class="form-group">
               <label>Book Author:</label>
              <input type="text" name="author"  class="form-control" placeholder="Author" autocomplete="off" value="{{$book_info->author}}" >
              </div>
              <div class="form-group">
                <label>Book image:(only in jpeg/png/jpg/gif/svg width 300 and height 100 allowed)</label>
                <input type="file" name="book_img" class="form-control" accept="image/*">
              <img src="{{ asset('images/book_img/')}}/{{$book_info->book_img}}" width="80px" height="80px">


              </div>
              <div class="form-group">
               <label>Book Description:</label>
               <textarea name="book_desc" id="" cols="30" rows="3" class="form-control" placeholder="ENTER" >{{$book_info->book_desc}}</textarea>
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

        <form action="{{ url('ebook_licence/save')}}" method="post">
          @csrf
          <input type="hidden" name="access_code_id" value="<?php  echo $new->id;     ?>">
          <input type="hidden" name="p_id" value="<?php  echo $new->p_id;     ?>">
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
                  <th>Book</th>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Series</th>
                  <th>NoOfCh</th>
                  <th>Class</th>
                  <th>Author</th>
                  <th>Price</th>
                  <th>Book Image</th>
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