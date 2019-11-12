<!DOCTYPE html>
<html lang="en">
<head>
  <title>Study Buddy</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('test_gen/css/style-accordian.css')}}">
  <link rel="stylesheet" href="{{ asset('test_gen/css/style.css')}}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style type="text/css" media="screen">
   .tab_wrapper small{ text-transform: capitalize; } 
   .tab_wrapper > ul li { background-color: #eee;
        padding: 8px 10px;
    width: 13.92%;
}
button.btn.btn-info.apply, button.btn.btn-light.reset {
    line-height: 1;
}
.tab_wrapper > ul li.active{ background-color: #fff;}
.col.float-right.input-group.input-group-sm.col-sm-4{  max-width: 100% !important; width: auto !important;}

input.form-control.marks_each {
    width: 50px !important;
}
#wait{display:none; position: fixed; background-color: rgb(0,0,0,1); z-index: 9999999999; width: 100%; height: 100vh; max-width: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; /*line-height: 100vh;*/ padding-top: 23%; color: #fff; }
  </style>

<style>


</style>
</head>
<body> 

<div id="wait"><img src="{{ asset('teacher_dashboard/images/loader.gif') }}" width="64" height="64" /><br>Loading..</div>

  <!-- <div id='loader' style='display: none;'>
  <img src="" width='32px' height='32px'>
</div> -->
<!-- Top Section -->
<?php
 $user_id=Auth::user()->id;

        $p_id=  \App\School::where('user_id',$user_id)->value('p_id');

            $pub_info=\App\Publisher::where('id','=',$p_id)->first();
           
?>
<div class="btn btn-dark btn-test" id="genrate_pdf">Generate Test</div>  
  <section class="top-head">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="row m-0">
            <div class="w-auto">

 @if($pub_info->pblr_logo!='')
 <img class="logo-top" src="{{asset('images/publisher_logo/')}}/{{$pub_info->pblr_logo }}" height="50px" >
 @else
<img class="logo-top" src="{{ asset('images/logo-1c.png')}}" height="50px" >
 @endif




           <!--  <img class="logo-top" src="{{ asset('test_gen/images/logo.png')}}"/> -->
          </div>
          <div class="w-auto mx-auto">
            <h1 class="style-ht">{{$pub_info->pblctn_name}}</h1>

          </div>
          <div style="width: 50px;" class="">
            <a href="{{ url('/home')}}"> <i style="font-size:22px;  cursor: pointer;" class="fa fa-home" aria-hidden="true"></i></a>
          </div>
          </div>
        </div>
        <div class="col-sm-12 p-0">
          <div class="py-3 text-white text_caption">
            <!-- <h5 class="text_caption">Total No. Ques: 0</h5> -->
            <div class="top-fixed1">
              <img src="{{ asset('test_gen/images/1.png')}}"  class="top-fixed" />
              <h5 class="mb-0 text_caption1">Total No. Ques: <span id="all_ques_count">0</span></h5>
            </div>    
            <div class="top-fixed1">
              <img src="{{ asset('test_gen/images/1.png')}}"  class="top-fixed" />
              <h5 class="mb-0 text_caption1">Total Marks: <span id="all_ques_mark">0</span></h5>
            </div>    
          </div>
        </div>


        <div class="nav-bar-top bg-primary-color py-2 col-sm-12" id="nav-bar-top ">
         


          <div class="Title  text-center text-white">
            <!-- <h3>Type the paper Title Here....</h3> -->
            <input type="title" class="form-control my-2 w-50 mx-auto" id="title" placeholder="Type the paper Title Here..:" name="title">
          </div>

         

          
          <?php
               $book_info= \App\Book::where('id','=',$accesscode_id)->first();
               $subject_info=\App\Subject::where('id','=',$book_info->subject)->first();
               $class_info=\App\Classes::where('id','=',$book_info->class)->first();
               
          ?>
        
              <form class="form-inline p-0 col-sm-12" id="inner-form" action="">
              @csrf



            <input type="subject:" class="form-control mr-2 my-2" id="subject" placeholder="Subject" name="subject" value="{{$subject_info->name}}" readonly="">

            <input type="class" class="form-control mr-2 my-2" id="class_name" placeholder="Class:" name="class" value="{{$class_info->name}}" readonly="">
            <input type="M.M." class="form-control mr-2 my-2" id="mm" placeholder="M.M.:" name="mm" value="">
            <input type="text" id="date" placeholder="Date:" name="date" class="form-control mr-2 my-2 datepicker" data-date-format="dd/mm/yyyy" value="">
            <input type="duration" class="form-control my-2" id="duration" placeholder="duration:" name="duration" value="">
          </form>         
        </div>
        <input type="hidden" name=selected_chapter" id="selected_chapter" value="">
        <div class="col-sm-3 p-0 top-al">
          <div class="color py-3 text-white">
            <!-- Material unchecked -->
            <div class="w-100 text-left text-white d-block pt-3 px-3">
              <h4 class="m-0">Select Chapters</h4>
            </div>


            <?php

           $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
            $i=0;
            ?>
            @if(!empty($chapter_list))
              @foreach($chapter_list as $list)
            <div class="form-check text-left">
              @if($i!=0)
       <input type="checkbox" class="form-check-input my_chapter" id="materialUnchecked{{$i}}" value="{{$list->id}}" name="chapter">
        <label class="form-check-label my_label" for="materialUnchecked{{$i}}">
              @else
      <input type="checkbox" class="form-check-input my_chapter" id="materialUnchecked" value="{{$list->id}}" name="chapter">
      <label class="form-check-label" for="materialUnchecked">

              @endif

                
               {{$list->ch_name}}</label>
            </div>
            <?php
                $i=$i+1;
            ?>
            @endforeach
            @endif
      
            <div class="but-group text-right pr-3 mt-3">
              
              <button type="button" class="btn btn-info apply">Apply</button>
              <!-- <div class="btn btn-info apply" >
                Apply
              </div> -->
                <button type="button" class="btn btn-light reset">Reset</button>
             <!--  <div class="btn btn-light">
                Reset
              </div> -->
            </div>  
          </div>
        </div>
        <div class="tab_wrapper first_tab col-sm-9 mt-0 text-center">
                <ul class="tab_list row">
                    <li class="active">
                      <h6 class="mb-1">Long</h6>
                      <p class="mb-0"><small>No. Ques:<span id="long_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="long_total">0</span></small></p>
                    </li>
                    <li>
                      <h6 class="mb-1">Short</h6>
                      <p class="mb-0"><small>No. Ques:<span id="short_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="short_total">0</span></small></p>
                    </li>
                    <li>
                      <h6 class="mb-1">MCQ</h6>
                      <p class="mb-0"><small>No. Ques:<span id="mcq_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="mcq_total">0</span></small></p>
                    </li>
                    <li>
                      <h6 class="mb-1">True/False</h6>
                      <p class="mb-0"><small>No. Ques:<span id="tf_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="tf_total">0</span></small></p>
                    </li>
                    <li>
                      <h6 class="mb-1">Fill Ups</h6>
                      <p class="mb-0"><small>No. Ques:<span id="fill_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="fill_total">0</span></small></p>
                    </li>
                    <li class="mr-0">
                      <h6 class="mb-1">Match Col.</h6>
                      <p class="mb-0"><small>No. Ques:<span id="match_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="match_total">0</span></small></p>
                    </li>
                     <li class="mr-0">
                      <h6 class="mb-1">One Word</h6>
                      <p class="mb-0"><small>No. Ques:<span id="one_word_count">0</span></small></p>
                      <p class="mb-0"><small>Marks:<span id="one_word_total">0</span></small></p>
                    </li>


                </ul>
                <div class="content_wrapper">
                    <div class="tab_content active text-left row">
                       <!---------------Long Question Start     --------------->
                        
                        <!-- <div class="col-sm-9 d-inline-block">
                          <input type="text" name="long_title" id="long_title" class="heading_title" value="LONG ANSWER QUESTIONS" style="width:58%;">
                           
                         <span class="do_any_title ml-2 border-left">Do Any:<input type="checkbox" class="form-check-input" name="do_any_cnf" id="do_any_cnf" value=""> <input type="text" name="do_any" id="long_do_any" value="" style="width:12%;" ></span>
                        </div> -->
                        <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="long_title" id="long_title" class="heading_title px-2" value="LONG ANSWER QUESTIONS" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>
                              <input type="text" name="do_any" id="long_do_any" value="" style="width:50px;" />
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                        </div>
                        

                        <input type="hidden" name="selected_long_ques" id="selected_long_ques" value="" >
                       

                       
                        <div class="col float-right input-group input-group-sm col-sm-4 mt-2">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each long_marks long_ques_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >

                              </div>                      
                              <!-- acording -->
                              <div class="w-100">
           <?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>
               @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)
                 <div class="chapter_list_{{$list2->id}}" style="display:none;">
                     <button class="accordion">{{$list2->ch_name}}</button>
                <div class="panel">

                  <?php
                      

                      $long_record= \App\LongQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                 
                

                  ?>
                  @if(!empty($long_record))
                    @foreach($long_record as $ques_list)

                     <div class="form-check text-left py-3 my-0">
                 
              <input type="checkbox" class="form-check-input long_ques_list" id="materialUnchecked{{$ques_list->id}}_{{$ques_list->access_code_id}}" name="long_ques_list" value="{{$ques_list->id}}">
                    <label class="form-check-label" for="materialUnchecked{{$ques_list->id}}_{{$ques_list->access_code_id}}">{{$ques_list->ques}}</label>
                </div>
                 

                  @endforeach
                  @endif
                   
                </div>
              </div>
                 @endforeach
               @endif
       



              <!--   <button class="accordion">Use of Computer</button>
                <div class="panel">
                  <div class="form-check text-left py-3 my-0">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked8">
                    <label class="form-check-label" for="materialUnchecked8">Use of Computer</label>
                </div>
                </div> -->

                
                              </div>
                  <!-----------------------------Long Question End     --------------->
                    </div>

           
                    <div class="tab_content text-left row">
                       <!------------------Short Question Start     --------------->
                       <!--  <div class="col d-inline-block w-auto float-left" style="width:100%">
                          <input type="text" name="short_title" id="short_title" class="heading_title" value="SHORT ANSWER QUESTIONS" style="width:50%;">
                           
                         <span class="do_any_title">Do Any:<input type="text" name="do_any_short" id="short_do_any" value="" style="width:12%;"></span>

                        </div> -->

                    <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="short_title" id="short_title" class="heading_title px-2" value="SHORT ANSWER QUESTIONS" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>
                              <input type="text" name="do_any_short" id="short_do_any" value="" style="width:50px;">
                              <!-- <input type="text" name="do_any_short" id="do_any_short" value="" style="width:50px;" /> -->
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                    </div>


                       <!--  <h3 class="col d-inline-block w-auto float-left">SHORT ANSWER QUESTIONS</h3> -->



            <input type="hidden" name="selected_short_ques" id="selected_short_ques" value="">
                        <div class="col float-right input-group input-group-sm col-sm-4 mt-2">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each short_marks short_ques_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >

                              </div>
                              <!-- acording -->
                              <div class="w-100">
                 <?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>

             @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)
  <div class="chapter_list_{{$list2->id}}" style="display:none;">
                     <button class="accordion">{{$list2->ch_name}}</button>
                <div class="panel">
   <?php
                      

                      $short_record= \App\ShortQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                 
                

                  ?>
                  @if(!empty($short_record))
                    @foreach($short_record as $ques_list)



                  <div class="form-check text-left py-3 my-0">

                    <input type="checkbox" class="form-check-input short_ques_list" id="materialUnchecked9{{$ques_list->id}}_{{$ques_list->access_code_id}}" name="short_ques_list" value="{{$ques_list->id}}">
                    <label class="form-check-label" for="materialUnchecked9{{$ques_list->id}}_{{$ques_list->access_code_id}}">{{$ques_list->ques}}</label>
                </div>



                  @endforeach
                @endif

                </div>

</div>
                @endforeach
                @endif
            

                
                              </div>

                              <!------------------Short Question End     --------------->
                    </div>

                    <div class="tab_content text-left row">

                      <!------------------MCQ Question Start     --------------->
                      <!--   <h3 class="col d-inline-block w-auto float-left">MULTIPLE CHOICE QUESTION ANSWERS</h3> -->
                     <!--   <div class="col d-inline-block w-auto float-left" style="width:100%">
                          <input type="text" name="mcq_title" id="mcq_title" class="heading_title" value="MULTIPLE CHOICE QUESTION ANSWERS" style="width:50%;">
                           
                         <span class="do_any_title">Do Any:<input type="text" name="do_any_mcq" id="mcq_do_any" value="" style="width:12%;"></span>

                        </div> -->

                        <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="mcq_title" id="mcq_title" class="heading_title px-2" value="MULTIPLE CHOICE QUESTION ANSWERS" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>

                              <input type="text" name="do_any_mcq" id="mcq_do_any" value="" style="width:50px;">
                             <!--  <input type="text" name="do_any_short" id="short_do_any" value="" style="width:50px;"> -->
                              <!-- <input type="text" name="do_any_short" id="do_any_short" value="" style="width:50px;" /> -->
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                    </div>




                        <input type="hidden" name="selected_mcq_ques" id="selected_mcq_ques" value="">
                        <div class="col float-right input-group input-group-sm col-sm-4 mt-2">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each mcq_marks mcq_ques_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >

                              </div>
                              <!-- acording -->
                              <div class="w-100">
               <?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>
               @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)
         <div class="chapter_list_{{$list2->id}}" style="display:none;">

               <button class="accordion">{{$list2->ch_name}}</button>



                <div class="panel">
                   <?php
                      

                      $mcq_record= \App\McqQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                 
                

                  ?>
                  @if(!empty($mcq_record))
                    @foreach($mcq_record as $ques_list)



    <div class="form-check text-left py-3 my-0">
                    <input type="checkbox" class="form-check-input mcq_ques_list" id="materialUnchecked11{{$ques_list->id}}_{{$ques_list->access_code_id}}" name="mcq_ques_list" value="{{$ques_list->id}}">
                    <label class="form-check-label" for="materialUnchecked11{{$ques_list->id}}_{{$ques_list->access_code_id}}">{{$ques_list->ques}}</label>
           </div>
              
                    <div class="custom-control d-inline-block custom-radio">
                    
            <input type="radio" class="custom-control-input" id="customRadio_mcq_{{$ques_list->id}}" name="customRadio_mcq_{{$ques_list->id}}" value="{{$ques_list->a}}" @if($ques_list->ans=='option_a') checked  @endif disabled>
                    <label class="custom-control-label" for="customRadio_mcq_{{$ques_list->id}}">
                      @if($ques_list->a_img!='')
                     <img src="{{ asset('images/option_a_img/')}}/{{$ques_list->a_img}}" height="40px" width="60px">
                      
                      @else

                       {{$ques_list->a}}

                      @endif
                    </label>
                    </div> 
                    <div class="custom-control d-inline-block custom-radio">
                    <input type="radio" class="custom-control-input" id="customRadio1_{{$ques_list->id}}" name="example1_{{$ques_list->id}}"  value="{{$ques_list->b}}" @if($ques_list->ans=='option_b') checked  @endif disabled>
                    <label class="custom-control-label" for="customRadio1_{{$ques_list->id}}" >   @if($ques_list->b_img!='')
                     <img src="{{ asset('images/option_b_img/')}}/{{$ques_list->b_img}}" height="40px" width="60px">
                      
                      @else

                       {{$ques_list->b}}

                      @endif</label>
                    </div> 
                     <div class="custom-control d-inline-block custom-radio">
                    <input type="radio" class="custom-control-input" id="customRadio2_{{$ques_list->id}}" name="example1_{{$ques_list->id}}"  value="{{$ques_list->c}}" @if($ques_list->ans=='option_c') checked  @endif disabled>
                    <label class="custom-control-label" for="customRadio2_{{$ques_list->id}}" >   @if($ques_list->c_img!='')
                     <img src="{{ asset('images/option_c_img/')}}/{{$ques_list->c_img}}" height="40px" width="60px">
                      
                      @else

                       {{$ques_list->c}}

                      @endif</label>
                    </div> 
                     <div class="custom-control d-inline-block custom-radio">
                    <input type="radio" class="custom-control-input" id="customRadio3_{{$ques_list->id}}" name="example1_{{$ques_list->id}}"  value="{{$ques_list->d}}" @if($ques_list->ans=='option_d') checked  @endif disabled>
                    <label class="custom-control-label" for="customRadio3_{{$ques_list->id}}" >   @if($ques_list->d_img!='')
                     <img src="{{ asset('images/option_d_img/')}}/{{$ques_list->d_img}}" height="40px" width="60px">
                      
                      @else

                       {{$ques_list->d}}

                      @endif</label>
                    </div> 

                @endforeach
                @endif
                </div>

                 </div>
        @endforeach
        @endif
             

                              <!------------------MCQ Question End     --------------->
                            </div>
                    </div>

                    <div class="tab_content text-left row">

                       <!------------------T/F Question Start  --------------->
                      <!--   <h3 class="col d-inline-block w-auto float-left">TRUE/FALSE QUESTION ANSWERS</h3> -->

                          <!-- <div class="col d-inline-block w-auto float-left" style="width:100%">
                          <input type="text" name="tf_title" id="tf_title" class="heading_title" value="TRUE/FALSE QUESTION ANSWERS" style="width:50%;">
                           
                         <span class="do_any_title">Do Any:<input type="text" name="do_any_tf" id="tf_do_any" value="" style="width:12%;"></span>

                        </div> -->

                            <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="tf_title" id="tf_title" class="heading_title px-2" value="TRUE/FALSE QUESTION ANSWERS" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>

                             <!--  <input type="text" name="do_any_mcq" id="mcq_do_any" value="" style="width:50px;"> -->
                            <input type="text" name="do_any_tf" id="tf_do_any" value="" style="width:50px;">
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                    </div>

                        <input type="hidden" name="selected_tf_ques" id="selected_tf_ques" value="">
                        <div class="col float-right input-group input-group-sm col-sm-4 mt-2">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each tf_marks tf_ques_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >

                              </div>
                              <!-- acording -->
                              <div class="w-100">
  <?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>
               @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)
         <div class="chapter_list_{{$list2->id}}" style="display:none;">

         
               <button class="accordion">{{$list2->ch_name}}</button>

            

            <div class="panel">
   <?php
                      

                      $mcq_record= \App\TfQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                 
                

                  ?>
                  @if(!empty($mcq_record))
                    @foreach($mcq_record as $ques_list)

                  <div class="form-check text-left py-3 my-0">
                  

                    <input type="checkbox" class="form-check-input" id="materialUnchecked13{{$ques_list->id}}_{{$ques_list->access_code_id}}" name="tf_ques_list" value="{{$ques_list->id}}">
                    <label class="form-check-label" for="materialUnchecked13{{$ques_list->id}}_{{$ques_list->access_code_id}}">{{$ques_list->ques}}</label>
                    <br>
                    <div class="custom-control d-inline-block custom-radio w-50">
                    
            <input type="radio" class="custom-control-input" id="customRadio_{{$ques_list->id}}" name="example1_{{$ques_list->id}}" value="1" @if($ques_list->ans=='1') checked  @endif disabled>
                    <label class="custom-control-label" for="customRadio_{{$ques_list->id}}">True</label>
                    </div> 
                    <div class="custom-control d-inline-block custom-radio">
                    <input type="radio" class="custom-control-input" id="customRadio1_{{$ques_list->id}}" name="example1_{{$ques_list->id}}"  value="0" @if($ques_list->ans=='0') checked  @endif disabled>
                    <label class="custom-control-label" for="customRadio1_{{$ques_list->id}}" >Falsh</label>
                    </div>   
                     
                </div>
               


  @endforeach
        @endif




                </div>

              

                       </div>

        @endforeach
        @endif
                              </div>

                                <!------------------T/F Question End  --------------->
                    </div>
                    <div class="tab_content text-left row">
                       <!------------------Fill in blank Question Start  --------------->
                      <!--   <h3 class="col d-inline-block w-auto float-left">FILL IN THE BLANKS QUESTIONS ANSWERS</h3> -->
                 <!--       <div class="col d-inline-block w-auto float-left" style="width:100%">
                          <input type="text" name="fill_title" id="fill_title" class="heading_title" value="FILL IN THE BLANKS QUESTIONS ANSWERS" style="width:50%;">
                           
                         <span class="do_any_title">Do Any:<input type="text" name="do_any_fill" id="fill_do_any" value="" style="width:12%;"></span>

                        </div> -->
                    <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="fill_title" id="fill_title" class="heading_title px-2" value="FILL IN THE BLANKS QUESTIONS ANSWERS" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>

                             <!--  <input type="text" name="do_any_mcq" id="mcq_do_any" value="" style="width:50px;"> -->
                            <input type="text" name="do_any_fill" id="fill_do_any" value="" style="width:50px;">
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                    </div>


                        <input type="hidden" name="selected_fill_ques" id="selected_fill_ques" value="">
                        <div class="col float-right input-group input-group-sm col-sm-4 mt-2">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each fill_blanks_marks fill_ques_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >

                              </div>
              <div class="col-sm-12 float-left px-0 pb-3">
             <div class="form-check text-left">
                    <input type="checkbox" class="form-check-input key_required" id="materialUnchecked017" value="1">
                    <label class="form-check-label text-info" for="materialUnchecked017">Key Required</label>
                </div>
               </div>
                              <!-- acording -->
           <div class="w-100">
<?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>
               @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)
         <div class="chapter_list_{{$list2->id}}" style="display:none;">

         
               <button class="accordion">{{$list2->ch_name}}</button>
                <div class="panel">
       <?php
                      

                      $mcq_record= \App\fillQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                 
                

                  ?>
                  @if(!empty($mcq_record))
                    @foreach($mcq_record as $ques_list)

                 


                  <div class="form-check text-left pt-3 my-0 px-0">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked21{{$ques_list->id}}_{{$ques_list->access_code_id}}" name="fill_ques_list" value="{{$ques_list->id}}">
                    <label class="form-check-label" for="materialUnchecked21{{$ques_list->id}}_{{$ques_list->access_code_id}}">{{ $ques_list->ques }}</label>
                </div>
                <p class="text-muted">Ans:{{ $ques_list->ans }}</p>


                @endforeach
                @endif
                </div>
              

                
                             
</div>
                @endforeach
                @endif

                              </div>

                   <!------------------Fill in blank Question End  --------------->
                    </div>

                    <div class="tab_content text-left row">
                       <!------------------Match Col Question Start  --------------->
                       <!--  <h3 class="col d-inline-block w-auto float-left">MATCH MAKING QUESTIONS</h3> -->
                    <!--     <div class="col d-inline-block w-auto float-left" style="width:100%">
                          <input type="text" name="match_title" id="match_title" class="heading_title" value="MATCH MAKING QUESTIONS" style="width:50%;">
                           
                         <span class="do_any_title">Do Any:<input type="text" name="do_any_match" id="match_do_any" value="" style="width:12%;"></span>

                        </div> -->
                             <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="match_title" id="match_title" class="heading_title px-2" value="MATCH MAKING QUESTIONS" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>

                             <!--  <input type="text" name="do_any_mcq" id="mcq_do_any" value="" style="width:50px;"> -->
                            <input type="text" name="do_any_match" id="match_do_any" value="" style="width:50px;">
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                    </div>
                         <input type="hidden" name="selected_match_ques" id="selected_match_ques" value="">
                        <div class="col float-right input-group input-group-sm col-sm-4">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each  match_marks match_ques_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >

                              </div>
                              <div class="w-100">
<?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>
               @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)


         <div class="chapter_list_{{$list2->id}}" style="display:none;">

         
               <button class="accordion">{{$list2->ch_name}}</button>



                <div class="panel row m-0 mt-2">
             <?php
                      

                      $match_record= \App\MatchQuestion::distinct()->select('ques_no','chapter_id')->where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                      

                  ?>
                   
                 
                  @if(!empty($match_record))
                  <div class="col-sm-1"><strong>Q.No.</strong></div>
                  <div class="col-sm-2"><strong>SUB-A.</strong></div>
                  <div class="col-sm-3"><strong>Col-A</strong></div>
                  <div class="col-sm-2"><strong>SUB-B</strong></div>
                  <div class="col-sm-3"><strong>Col-B</strong></div>
                  <div class="col-sm-1"><strong>Ans</strong></div>
                  @foreach($match_record as $record)
                 <div class="row w-100 mb-2 border-bottom border-dark pb-2">
                  <div class="col-sm-1 m-auto">
                    <div class="form-check text-left py-3 my-0 pl-0">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked015_{{$record->ques_no}}" name="match_ques_list" value="{{ $record->chapter_id}}_{{$record->ques_no}}">
                    <label class="form-check-label" for="materialUnchecked015_{{$record->ques_no}}" >{{$record->ques_no}}</label>
                </div>
                  </div>
<?php
          
      $match_record_info= \App\MatchQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->where('ques_no',$record->ques_no)->get();
?>  
                     <div class="col-sm-2 m-auto">
                     <ul class="p-0 m-0 style-num-rom">
                      <?php
                         $i=1;
                      ?>
                      @if(!empty($match_record_info))
              @foreach($match_record_info as $list)

                      <li>{{$i}}</li>
                   <?php
                      $i=$i+1;
                   ?>
                @endforeach
                @endif
                    </ul>
                  </div>


                  <div class="col-sm-3 m-auto">
                    <ul class="p-0 m-0 style-num">
<?php
          
      $match_record_info= \App\MatchQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->where('ques_no',$record->ques_no)->get();
?>    
              @if(!empty($match_record_info))
              @foreach($match_record_info as $list)

                      <li>
                      @if($list->col_a_img!='')

                      <img src="{{ asset('images/match_column/')}}/{{$list->col_a_img}}" height="40px" width="60px"">
                      @else
                       {{$list->col_a}}
                      @endif


                        </li>

                @endforeach
                @endif
                    </ul>
                  </div>
                  
                  <div class="col-sm-2 m-auto">
                     <ul class="p-0 m-0 style-num-rom">
                      @if(!empty($match_record_info))
              @foreach($match_record_info as $list)

                      <li>{{$list->sub_b}}</li>

                @endforeach
                @endif
                    </ul>
                  </div>
                 


                  <div class="col-sm-3 m-auto">
                    <ul class="p-0 m-0 style-num-rom">
                      @if(!empty($match_record_info))
              @foreach($match_record_info as $list)

                      <li>
                       @if($list->col_b_img!='')

                      <img src="{{ asset('images/match_column/')}}/{{$list->col_b_img}}" height="40px" width="60px"">
                      @else
                       {{$list->col_b}}
                      @endif




                        </li>

                @endforeach
                @endif
                    </ul>
                  </div>
                  <div class="col-sm-1 m-auto">
                    <ul class="p-0 m-0">
                           @if(!empty($match_record_info))
              @foreach($match_record_info as $list)

                      <li>{{$list->ans}}</li>

                @endforeach
                @endif
                    </ul>
                  </div>
              </div>
               
             @endforeach
                @endif


                              </div>


</div>

               @endforeach
                @endif


                    </div>
              <!--       <div class="w-100">
                                <button class="accordion">Computer - A Machine Use of Computer Parts of computer</button>
                <div class="panel m-0 mt-2">
                  <div class="row">
                <div class="col-sm-1"><strong>S.No.</strong></div>
              <div class="col-sm-5"><strong>Col-1</strong></div>
              <div class="col-sm-5"><strong>Col-1</strong></div>
              <div class="col-sm-1"><strong>Ans</strong></div>
                  </div>
                  <div class="row border-bottom py-2 border-dark">
                    <div class="col-sm-1 m-auto">
                    <div class="form-check text-left py-3 my-0 pl-0">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked016">
                    <label class="form-check-label" for="materialUnchecked016">1</label>
                </div>
                  </div>
                  <div class="col-sm-5 m-auto">
                    <ul class="p-0 m-0 style-num">
                      <li>Mouse</li>
                      <li>Keyboard</li>
                      <li>Speakers</li>
                      <li>Printer</li>
                      <li>Monitor</li>
                    </ul>
                  </div>
                  <div class="col-sm-5 m-auto">
                    <ul class="p-0 m-0 style-num-rom">
                      <li>Prints information on paper</li>
                      <li>Display device</li>
                      <li>Prints information on paper</li>
                      <li>Pointing device</li>
                      <li>Writing and typing device Mouth of a computer</li>
                    </ul>
                  </div>
                  <div class="col-sm-1 m-auto">
                    <ul class="p-0 m-0">
                      <li>a</li>
                      <li>b</li>
                      <li>c</li>
                      <li>d</li>
                      <li>e</li>
                    </ul>
                  </div>
                  </div>
                  <div class="row border-bottom py-2 border-dark">
                    <div class="col-sm-1 m-auto">
                    <div class="form-check text-left py-3 my-0 pl-0">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked017">
                    <label class="form-check-label" for="materialUnchecked017">2</label>
                </div>
                  </div>
                  <div class="col-sm-5 m-auto">
                    <ul class="p-0 m-0 style-num">
                      <li>Mouse</li>
                      <li>Keyboard</li>
                      <li>Speakers</li>
                      <li>Printer</li>
                      <li>Monitor</li>
                    </ul>
                  </div>
                  <div class="col-sm-5 m-auto">
                    <ul class="p-0 m-0 style-num-rom">
                      <li>Prints information on paper</li>
                      <li>Display device</li>
                      <li>Prints information on paper</li>
                      <li>Pointing device</li>
                      <li>Writing and typing device Mouth of a computer</li>
                    </ul>
                  </div>
                  <div class="col-sm-1 m-auto">
                    <ul class="p-0 m-0">
                      <li>a</li>
                      <li>b</li>
                      <li>c</li>
                      <li>d</li>
                      <li>e</li>
                    </ul>
                  </div>
                  </div>
                              </div>

                    </div> -->

                    <!------------------Match Col Question End  --------------->
                </div>

   <div class="tab_content text-left row">
                       <!------------------One Word Question Start  --------------->
                       <!--  <h3 class="col d-inline-block w-auto float-left">One Word Question</h3> -->
                     <!--       <div class="col d-inline-block w-auto float-left" style="width:100%">
                          <input type="text" name="ow_title" id="ow_title" class="heading_title" value="One Word Answer Questions" style="width:50%;">
                           
                         <span class="do_any_title">Do Any:<input type="text" name="do_any_ow" id="ow_do_any" value="" style="width:12%;"></span>

                        </div> -->
                  <div class="col-sm-9 d-inline-block">
                          <div class="row m-0">
                            <input type="text" name="ow_title" id="ow_title" class="heading_title px-2" value="One Word Answer Questions" style="width:58%;">
                            <div class="px-2 ml-2 border-left border-dark">
                              <label>
                                Do Any:
                              </label>

                             <!--  <input type="text" name="do_any_mcq" id="mcq_do_any" value="" style="width:50px;"> -->
                            <input type="text" name="do_any_ow" id="ow_do_any" value="" style="width:50px;">
                              <i style="font-size:22px; cursor: pointer;" class="fa fa-check text-success mx-2"></i>
                             <i style="font-size:22px;  cursor: pointer;" class="fa fa-refresh" aria-hidden="true"></i> 
                            </div>
                          </div>
                    </div>

                         <input type="hidden" name="selected_ow_ques" id="selected_ow_ques" value="">
                        <div class="col float-right input-group input-group-sm col-sm-4 mt-2">

                                <div class="input-group-prepend">

                                  <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">Each Question</span>

                                </div>

                                <input width="70" type="text" class="form-control marks_each one_word_marks one_word_marks" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                              </div>
                             

         <div class="w-100">
 <?php
          $chapter_list= \App\Chapter::where('access_code','=',$accesscode_id)->get();
           ?>

             @if(!empty($chapter_list))
                 @foreach($chapter_list as $list2)
  <div class="chapter_list_{{$list2->id}}" style="display:none;">
                     <button class="accordion">{{$list2->ch_name}}</button>

                <div class="panel row m-0 mt-2">
                       <?php
                      

                      $mcq_record= \App\OnewordQuestion::where('access_code_id',$accesscode_id)->where('chapter_id',$list2->id)->get();
                                        
                 
                

                  ?>
                  @if(!empty($mcq_record))
                    @foreach($mcq_record as $ques_list)

                 


                  <div class="form-check text-left pt-3 my-0 px-0 w-100">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked021{{$ques_list->id}}_{{$ques_list->access_code_id}}" name="one_word_ques_list" value="{{$ques_list->id}}">
                    <label class="form-check-label" for="materialUnchecked021{{$ques_list->id}}_{{$ques_list->access_code_id}}">{{ $ques_list->ques }}</label>
                </div>
                <p class="text-muted">Ans:{{ $ques_list->ans }}</p>


                @endforeach
                @endif
               
             
             
                 </div>
                            </div>

                            @endforeach
                            @endif
                    </div>
             

                    <!------------------Match Col Question End  --------------->
                </div>

            </div>  
      </div>
    </div>
  </section>
<!-- Top Section -->

<!-- js -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
  $(function(){
   $('.datepicker').datepicker({
      format: 'mm-dd-yyyy',
      autoclose: true,
    });
});
</script>
<script type="text/javascript">


window.onscroll = function() {myFunction()};


var navbar = document.getElementById("nav-bar-top");


var sticky = navbar.offsetTop;

function myFunction() {

  if (window.pageYOffset >= 60) {

    navbar.classList.add("sticky");

  } else {

    navbar.classList.remove("sticky");

  }

}   

</script>
<script src="{{ asset('test_gen/js/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(".first_tab").champ();

</script>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
  <script type="text/javascript">
     $(document).ready(function(){
     
     $('.w-100').hide();
   $('.apply').click(function(){
         var chapters = [];
            $.each($("input[name='chapter']:checked"), function(){            
                chapters.push($(this).val());
            });
           // alert("My favourite sports are: " + chapters.join(", "));
            $('#selected_chapter').val(chapters);
            $('.w-100').show();
      
            $.each(chapters, function(index, value){
           //console.log(index + ' ' + value);

           $('.chapter_list_'+ value).show();

           $(".apply").prop("disabled", true);
            $(".my_chapter").attr("disabled", true);
});

      });

     });
     
      


    </script>
    <script type="text/javascript">
      $(document).ready(function(){
      $('.reset').click(function(){
           

          location.reload(true);
            
      });

      });



    </script>
    <script type="text/javascript">
      $(document).ready(function(){

     $("#title").focus();
      });
     
         $('#mm').prop('readonly', true);
         $('#date').prop('readonly', true);
         $('#duration').prop('readonly', true);


     $('#title').keyup(function(){
      var title=$("#title").val();
      if(title==''){
         $('#mm').prop('readonly', true);
         $('#date').prop('readonly', true);
         $('#duration').prop('readonly', true);

     }else{
       $('#mm').prop('readonly', false);
         $('#date').prop('readonly', false);
         $('#duration').prop('readonly', false);


     }



     });
     

    </script>
    <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=long_ques_list]').click(function(){
          
         var long_mark = $('.long_ques_marks').val();
         var long_do_any=$('#long_do_any').val();
        // alert(long_do_any);
       
        var long_ques = [];
            $.each($("input[name='long_ques_list']:checked"), function(){            
                long_ques.push($(this).val());
            });
          
            $('#selected_long_ques').val(long_ques);

            if($(this).prop("checked") == true){
                 if(long_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }


               
      
               
            }
            else if($(this).prop("checked") == false){
                
                 numberOfCheckboxesSelected--;
            }
            
            if(long_do_any!=''){

             if(long_do_any>=numberOfCheckboxesSelected){
                var total_long_mark =long_mark*numberOfCheckboxesSelected;

            $('#long_count').text(numberOfCheckboxesSelected);
            $('#long_total').text(total_long_mark);
               
              }else{

               $('#long_count').text(numberOfCheckboxesSelected);
           // $('#long_total').text(total_long_mark);
                
              }

            }else{

            var total_long_mark =long_mark*numberOfCheckboxesSelected;

            $('#long_count').text(numberOfCheckboxesSelected);
            $('#long_total').text(total_long_mark);

            }

         
            
             

         var all_ques_mark=$('#all_ques_mark').text();


          
             countSubTotal();
     
           //  alert(numberOfCheckboxesSelected);
        });

       });



    </script>

    <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=short_ques_list]').click(function(){
        
         var short_mark = $('.short_ques_marks').val();
         var short_do_any=$('#short_do_any').val();

          var short_ques = [];
            $.each($("input[name='short_ques_list']:checked"), function(){            
                short_ques.push($(this).val());
            });
          
            $('#selected_short_ques').val(short_ques);



        if($(this).prop("checked") == true){
                if(short_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }

              // numberOfCheckboxesSelected++;
               
            }
            else if($(this).prop("checked") == false){
                 numberOfCheckboxesSelected--;
            }

           if(short_do_any!=''){

          if(short_do_any>=numberOfCheckboxesSelected){
                var total_short_mark =short_mark*numberOfCheckboxesSelected;

            $('#short_count').text(numberOfCheckboxesSelected);
            $('#short_total').text(total_short_mark);
               
              }else{

               $('#short_count').text(numberOfCheckboxesSelected);
           // $('#long_total').text(total_long_mark);
                
              }


           }else{
             var total_short_mark =short_mark*numberOfCheckboxesSelected;
           
            $('#short_count').text(numberOfCheckboxesSelected);
            $('#short_total').text(total_short_mark);
           
          }
           countSubTotal();
          
        });

       });
    </script>
      <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=mcq_ques_list]').click(function(){
           var mcq_do_any=$('#mcq_do_any').val();
         var mcq_ques = [];
            $.each($("input[name='mcq_ques_list']:checked"), function(){            
                mcq_ques.push($(this).val());
            });
          
            $('#selected_mcq_ques').val(mcq_ques);       


         var mcq_mark = $('.mcq_ques_marks').val();
         //alert(mcq_mark);
        if($(this).prop("checked") == true){

                 if(mcq_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }






               // numberOfCheckboxesSelected++;
               
            }
            else if($(this).prop("checked") == false){
                 numberOfCheckboxesSelected--;
            }

               if(mcq_do_any!=''){

             if(mcq_do_any>=numberOfCheckboxesSelected){
                var total_mcq_mark =mcq_mark*numberOfCheckboxesSelected;

            $('#mcq_count').text(numberOfCheckboxesSelected);
            $('#mcq_total').text(total_mcq_mark);
               
              }else{

               $('#mcq_count').text(numberOfCheckboxesSelected);
           // $('#mcq_total').text(total_mcq_mark);
                
              }

            }else{

            var total_mcq_mark =mcq_mark*numberOfCheckboxesSelected;

            $('#mcq_count').text(numberOfCheckboxesSelected);
            $('#mcq_total').text(total_mcq_mark);

            } 




            //    var total_mcq_mark =mcq_mark*numberOfCheckboxesSelected;
           
            // $('#mcq_count').text(numberOfCheckboxesSelected);
            // $('#mcq_total').text(total_mcq_mark);
           countSubTotal();
        });

       });
    </script>
  <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=tf_ques_list]').click(function(){
        
         var tf_mark = $('.tf_ques_marks').val();
         var tf_do_any=$('#tf_do_any').val();
           var tf_ques = [];
            $.each($("input[name='tf_ques_list']:checked"), function(){            
                tf_ques.push($(this).val());
            });
          
            $('#selected_tf_ques').val(tf_ques);  
         //alert(mcq_mark);
        if($(this).prop("checked") == true){

                if(tf_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }



               // numberOfCheckboxesSelected++;
               
            }
            else if($(this).prop("checked") == false){
                 numberOfCheckboxesSelected--;
            }

              if(tf_do_any!=''){

             if(tf_do_any>=numberOfCheckboxesSelected){
                var total_tf_mark =tf_mark*numberOfCheckboxesSelected;

            $('#tf_count').text(numberOfCheckboxesSelected);
            $('#tf_total').text(total_tf_mark);
               
              }else{

               $('#tf_count').text(numberOfCheckboxesSelected);
           // $('#tf_total').text(total_tf_mark);
                
              }

            }else{

            var total_tf_mark =tf_mark*numberOfCheckboxesSelected;

            $('#tf_count').text(numberOfCheckboxesSelected);
            $('#tf_total').text(total_tf_mark);

            }





            //    var total_tf_mark =tf_mark*numberOfCheckboxesSelected;
           
            // $('#tf_count').text(numberOfCheckboxesSelected);
            // $('#tf_total').text(total_tf_mark);
           countSubTotal();
        });

       });
    </script>
  <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=fill_ques_list]').click(function(){
        
         var fill_mark = $('.fill_ques_marks').val();
         var fill_do_any=$('#fill_do_any').val();

          var fill_ques = [];
            $.each($("input[name='fill_ques_list']:checked"), function(){            
                fill_ques.push($(this).val());
            });
          
            $('#selected_fill_ques').val(fill_ques);

         //alert(mcq_mark);
        if($(this).prop("checked") == true){
               // numberOfCheckboxesSelected++;
                if(fill_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }
               
            }
            else if($(this).prop("checked") == false){
                 numberOfCheckboxesSelected--;
            }

            if(fill_do_any!=''){

             if(fill_do_any>=numberOfCheckboxesSelected){
                var total_fill_mark =fill_mark*numberOfCheckboxesSelected;

            $('#fill_count').text(numberOfCheckboxesSelected);
            $('#fill_total').text(total_fill_mark);
               
              }else{

               $('#fill_count').text(numberOfCheckboxesSelected);
           // $('#fill_total').text(total_fill_mark);
                
              }

            }else{

            var total_fill_mark =fill_mark*numberOfCheckboxesSelected;

            $('#fill_count').text(numberOfCheckboxesSelected);
            $('#fill_total').text(total_fill_mark);

            }


            //    var total_fill_mark =fill_mark*numberOfCheckboxesSelected;
           
            // $('#fill_count').text(numberOfCheckboxesSelected);
            // $('#fill_total').text(total_fill_mark);
           countSubTotal();
        });

       });
    </script>

    <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=match_ques_list]').click(function(){
        
         var match_mark = $('.match_ques_marks').val();

         var match_do_any=$('#match_do_any').val();

           var match_ques = [];
            $.each($("input[name='match_ques_list']:checked"), function(){            
                match_ques.push($(this).val());
            });
          
            $('#selected_match_ques').val(match_ques);


         //alert(mcq_mark);
        if($(this).prop("checked") == true){
            if(match_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }
               // numberOfCheckboxesSelected++;
               
            }
            else if($(this).prop("checked") == false){
                 numberOfCheckboxesSelected--;
            }

           if(match_do_any!=''){

             if(match_do_any>=numberOfCheckboxesSelected){
                var total_match_mark =match_mark*numberOfCheckboxesSelected;

            $('#match_count').text(numberOfCheckboxesSelected);
            $('#match_total').text(total_match_mark);
               
              }else{

               $('#match_count').text(numberOfCheckboxesSelected);
           // $('#match_total').text(total_match_mark);
                
              }

            }else{

            var total_match_mark =match_mark*numberOfCheckboxesSelected;

            $('#match_count').text(numberOfCheckboxesSelected);
            $('#match_total').text(total_match_mark);

            }

            //    var total_match_mark =match_mark*numberOfCheckboxesSelected;
           
            // $('#match_count').text(numberOfCheckboxesSelected);
            // $('#match_total').text(total_match_mark);
            countSubTotal();
        });

       });
    </script>


    <script type="text/javascript">
       $(document).ready(function(){
         var numberOfCheckboxesSelected=0;

        $('input[name=one_word_ques_list]').click(function(){
        
         var on_word_mark = $('.one_word_marks').val();
          var ow_do_any=$('#ow_do_any').val();


            var ow_ques = [];
            $.each($("input[name='one_word_ques_list']:checked"), function(){            
                ow_ques.push($(this).val());
            });
          
            $('#selected_ow_ques').val(ow_ques);


         //alert(mcq_mark);
        if($(this).prop("checked") == true){
            if(on_word_mark==''){
                  alert('Each Question Mark Blank');
                  $(this).prop("checked", false);
                 }else{

                  $(this).prop("checked", true);
                   numberOfCheckboxesSelected++;

                 }
                //numberOfCheckboxesSelected++;
               
            }
            else if($(this).prop("checked") == false){
                 numberOfCheckboxesSelected--;
            }

             if(ow_do_any!=''){

             if(ow_do_any>=numberOfCheckboxesSelected){
                var total_ow_mark =on_word_mark*numberOfCheckboxesSelected;

            $('#one_word_count').text(numberOfCheckboxesSelected);
            $('#one_word_total').text(total_ow_mark);
               
              }else{

               $('#one_word_count').text(numberOfCheckboxesSelected);
           // $('#one_word_total').text(total_match_mark);
                
              }

            }else{

            var total_ow_mark =on_word_mark*numberOfCheckboxesSelected;

            $('#one_word_count').text(numberOfCheckboxesSelected);
            $('#one_word_total').text(total_ow_mark);

            }


            //    var total_one_word_mark =on_word_mark*numberOfCheckboxesSelected;
           
            // $('#one_word_count').text(numberOfCheckboxesSelected);
            // $('#one_word_total').text(total_one_word_mark);
            countSubTotal();
        });

       });
    </script>
    <script type="text/javascript">
       function countSubTotal(){
        
         var long_ques_count = $('#long_count').text();
         var short_ques_count = $('#short_count').text();
         var mcq_ques_count = $('#mcq_count').text();
         var tf_ques_count = $('#tf_count').text();
         var fill_ques_count = $('#fill_count').text();
         var match_ques_count = $('#match_count').text();
         var one_word_count= $('#one_word_count').text();
       var sub_total_ques= parseInt(long_ques_count) + parseInt(short_ques_count) + parseInt(mcq_ques_count) + parseInt(tf_ques_count) + parseInt(fill_ques_count) + parseInt(match_ques_count) + parseInt(one_word_count);

         var long_mark_total = $('#long_total').text();
         var short_mark_total = $('#short_total').text();
         var mcq_mark_total = $('#mcq_total').text();
         var tf_mark_total = $('#tf_total').text();
         var fill_mark_total = $('#fill_total').text();
          var match_mark_total = $('#match_total').text();
          var one_word_total=$('#one_word_total').text();

         var sub_total_marks= Number(long_mark_total) + Number(short_mark_total) +  Number(mcq_mark_total) + Number(tf_mark_total) +  Number(fill_mark_total) + Number(match_mark_total) +  Number(one_word_total);

   // var sub_total_mark= parseInt(long_mark_total) + parseInt(short_mark_total + parseInt(mcq_mark_total) + parseInt(tf_mark_total) + parseInt(fill_mark_total) + parseInt(match_mark_total)) + parseInt(one_word_total);



     

            $('#all_ques_count').text(sub_total_ques);
            $('#all_ques_mark').text(sub_total_marks);


         


      }
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('#genrate_pdf').click(function(){
            //alert('ok');
            var title= $('#title').val();
            var subject = $('#subject').val();
            var classes= $('#class_name').val();
            var mm =$('#mm').val();
            var date =$('#date').val();
            var duration=$('#duration').val();
            
            var chapter= $('#selected_chapter').val();
          
           var long_marks=$('.long_ques_marks').val();
           var long_list= $("#selected_long_ques").val();

           var short_marks=$('.short_ques_marks').val();
           var short_list= $("#selected_short_ques").val();

           var mcq_marks=$('.mcq_ques_marks').val();
           var mcq_list= $("#selected_mcq_ques").val();

           var tf_marks=$('.tf_ques_marks').val();
           var tf_list= $("#selected_tf_ques").val();
 
           var fill_marks=$('.fill_ques_marks').val();
           var fill_list= $("#selected_fill_ques").val();

           var match_marks=$('.match_ques_marks').val();
           var match_list= $("#selected_match_ques").val();

           var ow_marks=$('.one_word_marks').val();
           var ow_list= $("#selected_ow_ques").val();
           
           var long_title=$('#long_title').val();
           var short_title=$('#short_title').val();
           var mcq_title=$('#mcq_title').val();
           var tf_title=$('#tf_title').val();
           var fill_title=$('#fill_title').val();
           var match_title=$('#match_title').val();
           var ow_title=$('#ow_title').val();
           var all_ques_count=$('#all_ques_count').text();
           var all_ques_mark=$('#all_ques_mark').text();
           
          
           var long_do_any=$('#long_do_any').val();
           var short_do_any=$('#short_do_any').val();
           var mcq_do_any=$('#mcq_do_any').val();
           var tf_do_any=$('#tf_do_any').val();
           var fill_do_any=$('#fill_do_any').val();
          
           var match_do_any=$('#match_do_any').val();
           var ow_do_any=$('#ow_do_any').val();

            if($('.key_required').prop("checked") == true){
                var key_required=1;
            }
            else if($('.key_required').prop("checked") == false){
                var key_required=0;
            }

           

           var long_count=$('#long_count').text();
           var long_total=$('#long_total').text();

           var short_count=$('#short_count').text();
           var short_total=$('#short_total').text();

           var mcq_count=$('#mcq_count').text();
           var mcq_total=$('#mcq_total').text();

           var tf_count=$('#tf_count').text();
           var tf_total=$('#tf_total').text();

           var fill_count=$('#fill_count').text();
           var fill_total=$('#fill_total').text();

           var match_count=$('#match_count').text();
           var match_total=$('#match_total').text();

           var ow_count=$('#one_word_count').text();
           var ow_total=$('#one_word_total').text();

          var _token = $('input[name="_token"]').val();
          
        var result=long_list.split(',');
        var long_lenght=result.length;


        var result2=short_list.split(',');
        var short_lenght=result2.length;

        var result3=mcq_list.split(',');
        var mcq_lenght=result3.length;

         var result4=tf_list.split(',');
        var tf_lenght=result3.length;

        var result5=fill_list.split(',');
        var fill_lenght=result5.length;

        var result6=match_list.split(',');
        var match_lenght=result6.length;

        var result7=ow_list.split(',');
        var ow_lenght=result7.length;

        if(long_lenght< long_do_any){
           $message= long_do_any + 'in Do Any but only' + long_lenght + ' Question Selected by You inside Long Type Question ';
          swal($message);
         // alert('Long Do any more than question selected');
        }else if(short_lenght< short_do_any){
          swal('Short Do any more than question selected');

        }else if(mcq_lenght< mcq_do_any){
          swal('MCQ Do any more than question selected');

        }else if(tf_lenght< tf_do_any){
          swal('True/False Do any more than question selected');

        }else if(fill_lenght< fill_do_any){
          swal('Fill Ups Do any more than question selected');

        }else if(match_lenght< match_do_any){
          swal('Match Column Do any more than question selected');

        }else if(ow_lenght< ow_do_any){
          swal('O-W Do any more than question selected');

        }else if(all_ques_mark!=mm){
   
          swal('Maximim Mark and Selected Question Mark both are not same');
       }else{


        
   $.ajax({
    url:"/teacher/genrate_pdf",
    method:"POST",
    data:{title:title,subject:subject,classes:classes,mm:mm,date:date,duration:duration,chapter:chapter,long_marks:long_marks,long_list:long_list,short_marks:short_marks,short_list:short_list,mcq_marks:mcq_marks,mcq_list:mcq_list,tf_marks:tf_marks,tf_list:tf_list,fill_marks:fill_marks,fill_list:fill_list,match_marks:match_marks,match_list:match_list,ow_marks:ow_marks,ow_list:ow_list,long_title:long_title,short_title:short_title,mcq_title:mcq_title,tf_title:tf_title,fill_title:fill_title,match_title:match_title,ow_title:ow_title,all_ques_count:all_ques_count,all_ques_mark:all_ques_mark,long_do_any:long_do_any,short_do_any:short_do_any,mcq_do_any:mcq_do_any,tf_do_any:tf_do_any,fill_do_any:fill_do_any,match_do_any:match_do_any,ow_do_any:ow_do_any,key_required:key_required,long_count:long_count,long_total:long_total,short_count:short_count,short_total:short_total,mcq_count:mcq_count,mcq_total:mcq_total,tf_count:tf_count,tf_total:tf_total,fill_count:fill_count,fill_total:fill_total,match_count:match_count,match_total:match_total,ow_count:ow_count,ow_total:ow_total,_token:_token},
    
beforeSend: function(){
    // Show image container
    $("#wait").css("display", "block");
   },
   success: function(response){
    

     swal('Test Paper Genrated Successfully Your will got an email with test paper attachment');
     location.reload(true);
   },
   complete:function(data){
    // Hide image container
    $("#wait").css("display", "none");
   }

    // success:function(result)
    // {
    //   swal('Test Paper Genrated Successfully Your will got an email with test paper attachment');
    //    // location.reload(true);
    // }

   });





        }



        


          });

      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
      
      $('#long_do_any').keyup(function(){
         var long_do=$('#long_do_any').val();
         var selected_long=$('#selected_long_ques').val();
        
        var result=selected_long.split(',');
        var long_lenght=result.length;
        var long_marks=$('.long_ques_marks').val();
        //alert(long_marks);
        if(long_do!=''){

             if(long_do<=long_lenght){
               if(long_do==0){
                alert('Zero is not a valid number for this section');
                 $('#long_do_any').val(long_lenght);


              }else{
                var new_total_mark=long_do*long_marks;
              }
             

             $('#long_total').text(new_total_mark);

             }else{
            // $('#long_do_any').val(long_lenght);

             }
             

             

        }else if(long_do=='0'){

        $('#long_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>
    <script type="text/javascript">
      $(document).ready(function(){
      $('.long_ques_marks').keyup(function(){
         var long_do=$('#long_do_any').val();
         var selected_long=$('#selected_long_ques').val();
        
        var result=selected_long.split(',');
        var long_lenght=result.length;
        var long_marks=$('.long_ques_marks').val();
      
       
              if(long_lenght>=long_do){
                if(long_do!=''){
                var new_mark=long_do*long_marks;
               $('#long_total').text(new_mark);

                }else{
               var new_mark=long_lenght*long_marks;
               $('#long_total').text(new_mark);


                }
               
               

              }else{
              
            var new_mark=long_lenght*long_marks;
            $('#long_total').text(new_mark);

              }

        countSubTotal();

      


      });

      });

    </script>
 <script type="text/javascript">
      $(document).ready(function(){
      
      $('#short_do_any').keyup(function(){
         var short_do=$('#short_do_any').val();
         var selected_short=$('#selected_short_ques').val();
        
        var result=selected_short.split(',');
        var short_lenght=result.length;
        var short_marks=$('.short_ques_marks').val();
        //alert(long_marks);
        if(short_do!=''){

             if(short_do<=short_lenght){
               if(short_do==0){
               alert('Zero is not a valid number for this section');
                 $('#short_do_any').val(short_lenght);
                 var new_val=short_lenght*short_marks;
                 $('#short_total').text(new_val);
              }else{
                var new_total_mark=short_do*short_marks;
              }
             

             $('#short_total').text(new_total_mark);

             }else{
            // $('#short_do_any').val(short_lenght);

             }
             

             

        }else if(short_do=='0'){

        $('#short_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>

      <script type="text/javascript">
      $(document).ready(function(){
      $('.short_ques_marks').keyup(function(){
         var short_do=$('#short_do_any').val();
         var selected_short=$('#selected_short_ques').val();
        
        var result=selected_short.split(',');
        var short_lenght=result.length;
        var short_marks=$('.short_ques_marks').val();
      
       
              if(short_lenght>=short_do){
                if(short_do!=''){
                var new_mark=short_do*short_marks;
               $('#short_total').text(new_mark);

                }else{
               var new_mark=short_lenght*short_marks;
               $('#short_total').text(new_mark);


                }
               
               

              }else{

                var new_mark=short_lenght*short_marks;
               $('#short_total').text(new_mark);

              }

        countSubTotal();

      


      });

      });

    </script>
    <script type="text/javascript">
      $(document).ready(function(){
      
      $('#mcq_do_any').keyup(function(){
         var mcq_do=$('#mcq_do_any').val();
         var selected_mcq=$('#selected_mcq_ques').val();
        
        var result=selected_mcq.split(',');
        var mcq_lenght=result.length;
        var mcq_marks=$('.mcq_ques_marks').val();
        //alert(long_marks);
        if(mcq_do!=''){

             if(mcq_do<=mcq_lenght){
               if(mcq_do==0){
               alert('Zero is not a valid number for this section');
                 var new_val=mcq_lenght*mcq_marks;
                 $('#mcq_total').text(new_val);
                 $('#mcq_do_any').val(mcq_lenght);

              }else{
                var new_total_mark=mcq_do*mcq_marks;
              }
             

             $('#mcq_total').text(new_total_mark);

             }else{
            // $('#mcq_do_any').val(mcq_lenght);

             }
             

             

        }else if(mcq_do=='0'){

        $('#mcq_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>

      <script type="text/javascript">
      $(document).ready(function(){
      $('.mcq_ques_marks').keyup(function(){
         var mcq_do=$('#mcq_do_any').val();
         var selected_mcq=$('#selected_mcq_ques').val();
        
        var result=selected_mcq.split(',');
        var mcq_lenght=result.length;
        var mcq_marks=$('.mcq_ques_marks').val();
      
       
              if(mcq_lenght>=mcq_do){
                if(mcq_do!=''){
                var new_mark=mcq_do*mcq_marks;
               $('#mcq_total').text(new_mark);

                }else{
               var new_mark=mcq_lenght*mcq_marks;
               $('#mcq_total').text(new_mark);


                }
               
               

              }else{
               var new_mark=mcq_lenght*mcq_marks;
               $('#mcq_total').text(new_mark);


                }

        countSubTotal();

      


      });

      });

    </script>
     <script type="text/javascript">
      $(document).ready(function(){
      
      $('#tf_do_any').keyup(function(){
         var tf_do=$('#tf_do_any').val();
         var selected_tf=$('#selected_tf_ques').val();
        
        var result=selected_tf.split(',');
        var tf_lenght=result.length;
        var tf_marks=$('.tf_ques_marks').val();
        //alert(long_marks);
        if(tf_do!=''){

             if(tf_do<=tf_lenght){
               if(tf_do==0){
               alert('Zero is not a valid number for this section');
                 $('#tf_do_any').val(tf_lenght);
                 var new_val=tf_lenght*tf_marks;
                 $('#tf_total').text(new_val);

              }else{
                var new_total_mark=tf_do*tf_marks;
              }
             

             $('#tf_total').text(new_total_mark);

             }else{
           //  $('#tf_do_any').val(tf_lenght);

             }
             

             

        }else if(tf_do=='0'){

        $('#tf_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>

      <script type="text/javascript">
      $(document).ready(function(){
      $('.tf_ques_marks').keyup(function(){
         var tf_do=$('#tf_do_any').val();
         var selected_tf=$('#selected_tf_ques').val();
        
        var result=selected_tf.split(',');
        var tf_lenght=result.length;
        var tf_marks=$('.tf_ques_marks').val();
      
       
              if(tf_lenght>=tf_do){
                if(tf_do!=''){
                var new_mark=tf_do*tf_marks;
               $('#tf_total').text(new_mark);

                }else{
               var new_mark=tf_lenght*tf_marks;
               $('#tf_total').text(new_mark);


                }
               
               

              }else{
               var new_mark=tf_lenght*tf_marks;
               $('#tf_total').text(new_mark);


                }

        countSubTotal();

      


      });

      });

    </script>
      <script type="text/javascript">
      $(document).ready(function(){
      
      $('#fill_do_any').keyup(function(){
         var fill_do=$('#fill_do_any').val();
         var selected_fill=$('#selected_fill_ques').val();
        
        var result=selected_fill.split(',');
        var fill_lenght=result.length;
        var fill_marks=$('.fill_ques_marks').val();
        //alert(long_marks);
        if(fill_do!=''){

             if(fill_do<=fill_lenght){
               if(fill_do==0){
               alert('Zero is not a valid number for this section');
                $('#fill_do_any').val(fill_lenght);
                 var new_val=fill_lenght*fill_marks;
                 $('#fill_total').text(new_val);

              }else{
                var new_total_mark=fill_do*fill_marks;
              }
             

             $('#fill_total').text(new_total_mark);

             }else{
            // $('#fill_do_any').val(fill_lenght);

             }
             

             

        }else if(fill_do=='0'){

        $('#fill_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>

      <script type="text/javascript">
      $(document).ready(function(){
      $('.fill_ques_marks').keyup(function(){
         var fill_do=$('#fill_do_any').val();
         var selected_fill=$('#selected_fill_ques').val();
        
        var result=selected_fill.split(',');
        var fill_lenght=result.length;
        var fill_marks=$('.fill_ques_marks').val();
      
       
              if(fill_lenght>=fill_do){
                if(fill_do!=''){
                var new_mark=fill_do*fill_marks;
               $('#fill_total').text(new_mark);

                }else{
               var new_mark=fill_lenght*fill_marks;
               $('#fill_total').text(new_mark);


                }
               
               

              }else{
               var new_mark=fill_lenght*fill_marks;
               $('#fill_total').text(new_mark);


                }

        countSubTotal();

      


      });

      });

    </script>
       
         <script type="text/javascript">
      $(document).ready(function(){
      
      $('#match_do_any').keyup(function(){
         var match_do=$('#match_do_any').val();
         var selected_match=$('#selected_match_ques').val();
        
        var result=selected_match.split(',');
        var match_lenght=result.length;
        var match_marks=$('.match_ques_marks').val();
        //alert(long_marks);
        if(match_do!=''){

             if(match_do<=match_lenght){
               if(match_do==0){
               alert('Zero is not a valid number for this section');
                $('#match_do_any').val(match_lenght);
                 var new_val=match_lenght*match_marks;
                 $('#match_total').text(new_val);

              }else{
                var new_total_mark=match_do*match_marks;
              }
             

             $('#match_total').text(new_total_mark);

             }else{
            // $('#match_do_any').val(match_lenght);

             }
             

             

        }else if(match_do=='0'){

        $('#match_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>

      <script type="text/javascript">
      $(document).ready(function(){
      $('.match_ques_marks').keyup(function(){
         var match_do=$('#match_do_any').val();
         var selected_match=$('#selected_match_ques').val();
        
        var result=selected_match.split(',');
        var match_lenght=result.length;
        var match_marks=$('.match_ques_marks').val();
      
       
              if(match_lenght>=match_do){
                if(match_do!=''){
                var new_mark=match_do*match_marks;
               $('#match_total').text(new_mark);

                }else{
               var new_mark=match_lenght*match_marks;
               $('#match_total').text(new_mark);


                }
               
               

              }else{
               var new_mark=match_lenght*match_marks;
               $('#match_total').text(new_mark);


                }

        countSubTotal();

      


      });

      });

    </script>
     <script type="text/javascript">
      $(document).ready(function(){
      
      $('#ow_do_any').keyup(function(){
         var ow_do=$('#ow_do_any').val();
         var selected_ow=$('#selected_ow_ques').val();
        
        var result=selected_ow.split(',');
        var ow_lenght=result.length;
        var ow_marks=$('.one_word_marks').val();
        //alert(long_marks);
        if(ow_do!=''){

             if(ow_do<=ow_lenght){
               if(ow_do==0){
               alert('Zero is not a valid number for this section');
                $('#ow_do_any').val(ow_lenght);
                 var new_val=ow_lenght*ow_marks;
                 $('#one_word_total').text(new_val);

              }else{
                var new_total_mark=ow_do*ow_marks;
              }
             

             $('#one_word_total').text(new_total_mark);

             }else{
           //  $('#ow_do_any').val(ow_lenght);

             }
             

             

        }else if(ow_do=='0'){

        $('#ow_do_any').val(1);

        }

     countSubTotal();


      });

      });


    </script>

      <script type="text/javascript">
      $(document).ready(function(){
      $('.one_word_marks').keyup(function(){
         var ow_do=$('#ow_do_any').val();
         var selected_ow=$('#selected_ow_ques').val();
        
        var result=selected_ow.split(',');
        var ow_lenght=result.length;
        var ow_marks=$('.one_word_marks').val();
      
       
              if(ow_lenght>=ow_do){
                if(ow_do!=''){
                var new_mark=ow_do*ow_marks;
               $('#one_word_total').text(new_mark);

                }else{
               var new_mark=ow_lenght*ow_marks;
               $('#one_word_total').text(new_mark);


                }
               
               

              }else{
               var new_mark=ow_lenght*ow_marks;
               $('#one_word_total').text(new_mark);


                }

        countSubTotal();

      


      });

      });

    </script>
       
       
       
<!-- js -->

</body>
</html>