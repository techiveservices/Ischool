
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


#example1 td:nth-child(1) {
    width: 20px;
}
#example1 td:nth-child(4) {
    width: 20px;
}
#example1 td:nth-child(7) {
    width: 20px;
}
    </style>
    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
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
         
         <span id="success" style="display:none;"><div class="alert alert-success">Book Addedd Successfully</div></span>
             
        <?php

      if (Session::get('success_add')) { ?>
    <div class="alert alert-success">       {{ Session::get('success_add')}}</div>



    <?php     Session::forget('success_add');     }

        ?>
         
         


             
                   @if(Session::has('success'))
          <div class="alert alert-success">
            <?php     $msg= Session::get('success');   

                 echo $msg[0];

                 ?>
              
          </div>
         @endif
      


             
             
             
             
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
           
           
           @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif    
            <div class="alert alert-danger">  {{ Session::get('not_add')}}</div>
         
           
           <div class="alert2 message" id="message" style="display:none;"></div>
            <!-- /.box-header -->
            <!-- form start -->
        <form method="POST" enctype="multipart/form-data"   id="add_book">
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
                <label style="width:100%;"><font style="color:red;">*</font>Publication:</label>
               
                <select class="form-control select2" name="p_id" id="p_id" style="width:100%;">
                  <option>Select Publisher</option>

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
              
             @endif
           <div class="form-group">
                <label><font style="color:red;">*</font>Title:</label>
                <input type="text" name="title" class="form-control title" placeholder="Title"  autocomplete="off" required >
                <br/>
  
              </div>
              
           <div class="form-group">
                <label><font style="color:red;">*</font>Book Id:</label>
                <input type="text" name="accesscode" class="form-control book_id" placeholder="Book" required=""  autocomplete="off" >
              </div>
             
           <div class="form-group">

             <?php    //print_r($subject);    ?>
                <label style="width:100%;"><font style="color:red;">*</font>Select Subject:</label>
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
               <?php
                 $series2='';
                if($user_type=='2'){
                    
                    $pub_id=\App\Publisher::where('user_id',$user_id)->value('id');
                   $series2=\DB::table('tbl_series_info')->where('p_id',$pub_id)->get();
                }
               
               
               
               ?>
               
                <label style="width:100%;">Select Series:</label>
               <select name="series" class="form-control select2" id="series" style="width:100%;">
                 <option value="">---Select---</option>
                  @if(!empty($series2))
                     @foreach($series2 as $list)
                       <option value="{{$list->id}}">{{$list->series}}</option>

                     @endforeach
                   @endif
               </select>
              </div>
             
           <div class="form-group">
               <label style="width:100%;"><font style="color:red;">*</font>Select Class:</label>
                <select name="class" id="" class="form-control class_id select2" required="" style="width:100%;">
                   <option value="">---Select---</option>
                   @if(!empty($classes))
                     @foreach($classes as $list)
                       <option value="{{$list->id}}">{{$list->name}}</option>

                     @endforeach
                   @endif
                </select>
              </div>
            
           
             
                <div class="form-group">
                 <label>Book pdf (only in pdf maxsize 200MB):</label>
                <input style="height:auto;" type="file" name="book_pdf" class="form-control h-auto" id="book_pdf" accept="application/pdf">
              </div>
             
           <div class="form-group">
                <label><font style="color:red;">*</font>Title Image (only in jpeg/png/jpg/gif/svg width 100px to 300px and height 100 allowed):</label>
                <input style="height:auto;" type="file" name="book_img" class="form-control h-auto" id="book_img" accept="image/*">
              </div>
            
           <div class="form-group">
                <label>Teacher Manual(only in pdf maxsize 50MB):</label>
                <input style="height:auto;" type="file" name="manual" class="form-control h-auto" id="manual" accept="application/pdf">
              </div>
            
           <div class="form-group">
                <label>eBook link(url):</label>
                <input type="text" name="ebook" class="form-control" autocomplete="off" @if( $user_type=='2') readonly=""    @endif >
              </div>
          
           <div class="form-group">
               <label>Book Price:</label>
              <input type="text" name="price" value="" class="form-control" placeholder="Price"   autocomplete="off" >
              </div>
            
           <div class="form-group">
               <label>Book ISBN no.:</label>
              <input type="text" name="isbn" value="" class="form-control" placeholder="ISBN"  autocomplete="off" >
              </div>
            
           <div class="form-group">
               <label>Book Author:</label>
              <input type="text" name="author" value="" class="form-control" placeholder="Author"  autocomplete="off" >
              </div>
          
             <div class="form-group warning-100" style=" width: 100% !important;">
               <label>Book Description:</label>
               
               <textarea name="book_desc" class="form-control textArea" onclick="textAreaAdjust(this)" style="overflow:hidden"></textarea>
               
            
              </div>
            
              
                  <h3>Add Chapter</h3>

                <div class="table-responsive css-serial-counter">  
                <table class="table table-bordered" id="dynamic_field">  
                   <tr><th>Ch. No</th><th>Chapter Name</th><th><button type="button" name="add_chapter" id="add_chapter" class="btn btn-success">Add</button></th></tr>
                     
                </table>  
                
               </div>
            </div>


               <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="submit_book">Submit</button>
              </div>
             </div>
            <!-- /.col -->
          
          </form>
          
          
           <br />
           <span id="uploaded_image"></span>
   
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
                  <th>Sr.</th>
                   @if($user_type!='2')
                  <th>Publication</th>
                   @endif
                  <th>Book</th>
                  <th>Lic.</th>
                  <th>Title</th>
                  <th>Subject</th>
                
                  <th>Ch.No</th>
                  <th>Class</th>
                 
                  <th>Image</th>
                  
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
                  <td>
          <?php  $no_of_licence=\DB::table('ebook_licence_info')->where('access_code_id',$new->id)->orderby('id','DESC')->first();          
                      
                    if(!empty($no_of_licence)) {
                        
                     echo   $no_of_licence->no_licence;
                    } 
                      
          ?>            
                  </td>
                 
                   <td>{{$new->title}}</td>
                  <td>
    <?php  $subject_name= \App\Subject::where('id','=',$new->subject)->value('name');                     ?>



                    {{$subject_name}}</td>
                  
                  <td onclick="window.open('{{url('/chapter_list/')}}/{{$new->id}}')" class="chapter_list_on_hover">
<?php
  $chapter_count = \App\Chapter::where('p_id','=',$new->p_id)->where('access_code','=',$new->id)->count();

  ?>

                  {{$chapter_count}}</td>
                  <td>

<?php  $class_name= \App\Classes::where('id','=',$new->class)->value('name');                     ?>

                    {{$class_name}}</td>
                 
                
                  <td><img src="{{ asset('images/book_img/')}}/{{$new->book_img}}" height="40px"></td>
                
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

<?php

       $subject_id= $book_info->subject;
       $p_id= $book_info->p_id;
       $all_series= \App\Series::where('p_id',$p_id)->get();
      
?>



                <label style="width:100%;">Select Series:</label>
               <select name="series" class="form-control series select2" style="width:100%;">
                 <option value="">---Select---</option>



                  @if(!empty($all_series))
                     @foreach($all_series as $list)
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
                 <label>Book pdf:</label>
                <input style="height:auto;" type="file" name="book_pdf" class="form-control" accept="application/pdf">
               <!--<a href="{{ asset('images/book_pdf/')}}/{{$book_info->book_pdf}}" download>-->
               <!--     download-->
               <!--</a>-->



              </div>
               
      
             
              
           <div class="form-group">
                <label>Teacher Manual:</label>
                <input style="height:auto;" type="file" name="manual" class="form-control" accept="application/pdf">
              
               <!--   <a href="{{ asset('images/manual/')}}/{{$book_info->manual}}" download>-->
               <!--     download-->
               <!--</a>-->


              </div>
              
              
              
           <div class="form-group">
                <label>eBook(ebook url):</label>
                <input type="text" name="ebook" class="form-control" autocomplete="off" value="{{$book_info->ebook}}"  @if($user_type=='2') readonly=""  @endif>
              
              </div>
             

           
              
   
           <div class="form-group">
               <label>Book Price:</label>
              <input type="text" name="price"  class="form-control" placeholder="Price" autocomplete="off" value="{{$book_info->price}}" >
              </div>
            
             
           <div class="form-group">
               <label>Book ISBN no.:</label>
              <input type="text" name="isbn"  class="form-control" placeholder="ISBN" autocomplete="off" value="{{$book_info->isbn}}">
              </div>
              
                
           <div style="vertical-align: top;" class="form-group">
               <label>Book Author:</label>
              <input type="text" name="author"  class="form-control" placeholder="Author" autocomplete="off" value="{{$book_info->author}}" >
              </div>
              <div class="form-group">
                <label style="width:100%;">Title image:</label>
                <div  style="display:inline-flex; flex-wrap:wrap; width:80%; vertical-align: top;">
                    <font style="size:6px; width:100%; flex:100%;"><small>(jpeg/png/jpg/gif/svg)(Max. Width 1000 | Max. Height 1000)</small></small></font>
                    <input style="height:auto; width:100%; flex:100%;" type="file" name="book_img" class="form-control logo" accept="image/*">
                    </div>
                <img style="display:inline-felx; margin-left:15px;" class="blah" src="{{ asset('images/book_img/')}}/{{$book_info->book_img}}" width="60px" height="60px">
              


              </div>
              <div class="w-100">
               <label>Book Description:</label>
                 <textarea name="book_desc" class="form-control textArea" onclick="textAreaAdjust(this)" style="overflow:hidden">{{$book_info->book_desc}}</textarea>
               <!--<textarea name="book_desc" id="" cols="30" rows="3" class="form-control" placeholder="ENTER" >{{$book_info->book_desc}}</textarea>-->
              </div>
  
  
          <div class="row">
              <div class="col-lg-12">
               <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
              </div>
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
          <input type="hidden" name="access_code_id" value="<?php  echo $new->id;  ?>">
          <input type="hidden" name="p_id" value="<?php  echo $new->p_id;  ?>">
           <div class="col-md-12">
  <div class="form-group">
    <label for="exampleInputEmail1">Select License Type <i class="fa fa-external-link popover-test" aria-hidden="true" title="Licence Type" data-content="Popover body content is set in this attribute."></i></label>
    <select class="form-control select2_new" name="licence_type[]" placeholder="Select Licence Type"  style="width:100%;" multiple="multiple">
      <option value="Software">Software</option>
      <option value="Hardware">Hardware</option>
    </select>
  
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
                 <th>Sr.</th>
                   @if($user_type!='2')
                  <th>Publication</th>
                   @endif
                  <th>Book</th>
                  <th>Lic</th>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Ch.No</th>
                  <th>Class</th>
                  <th>Image</th>
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