<!DOCTYPE html>
<!-- saved from url=(0048)https://colorlib.com/etc/lf/Login_v10/index.html -->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Study Buddy</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css')}}">

  <link rel="stylesheet" href="{{ asset('css/welcome.css')}}">

<!--===============================================================================================-->
</head>
<body cz-shortcut-listen="true">

<section class="login_page">
	<img class="img_style" src="{{ asset('images/home_backgound.jpg')}}"/>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 text-right">

				  <img src="{{ asset('images/logo-1c.png')}}" class="logo-for-logim2" style="width: 75px;
    height: auto;
    display: flex;
    margin-left: auto;
    margin-top: 10px;">

				<!-- <img class="logo-for-logim" src="https://www.qureto.com/image/LOGO.png"/> -->
			</div>

			<div class="col-sm-2 mobilie">			
			</div>
			<div class="col-sm-3 tab_login py-3 ml-5">
				<div class="w-100 top_nav_bar">
					<ul class="d-inline-block menu_tab p-0">


						<li class="d-inline-block text-white mr-2">About</li>

						<li class="d-inline-block text-white mr-2">Login</li>

						<li class="d-inline-block text-white mr-2">Register</li>

						<!--li class="d-inline-block ml-auto"></li-->
					</ul>
					<ul class="d-inline-block ml-auto float-right p-0">
						<li>




							<img width="40" class="" src="{{ asset('images/logo-1c.png')}}"/></li>
					</ul>
				</div>

@if(\Session::has('success'))
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <strong>Congrats!</strong>
             <?php
        $msg=\Session::get('success');

       echo $msg[0];
             ?>

             
        </div>
    @endif
    @if(\Session::has('failure'))
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">×</a>
            <strong>Opps!</strong>
      
      <?php  $msg=\Session::get('failure');

        echo $msg[0];

 ?>
            
        </div>
    @endif
    
     @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif 

             <!-- about us -->
             	<div class="about_contain d-none">
             		<p align="justify" class="about-p-text wow animated zoomIn fadeInLeft"><strong class="about_p_strong">BRAINMATE</strong> is the latest development in the long standing history of PRAGATI PRAKASHAN. It has been established as an independent unit to mainly cater to children school books segment. It was established in September 09' and has already started bearing fruits. With an experience of over 50 years in publishing, an established network, this new venture aims to soon become an applauded entity in Pragati's stable.</p>



                  <p align="justify" class="about-p-text wow animated zoomIn fadeInLeft">The management of <strong class="about_p_strong">Brain Mate</strong> comprises of a fine blend of experience and passion. It is being managed by <strong class="about_p_strong">Mr. Mudit Mittal</strong> a well qualified and passionate youngster. It was his strong will power, entrepreneurial zeal and passion which led him into this business. Besides this IT and Editorial deptt. lies in the safe and learned hands of <strong class="about_p_strong

                     ">Miss. Neha Agarwal</strong>. Neha enjoys a</p>

             		<a class="fixt_bot" href="#">info@qureto.com</a>
             	</div>
             	<!-- about us end-->
             	<!-- login section -->
             	<div class="login_contain form col-sm-12 mt-5 d-block">
             		
 <form action="{{ url('login') }}" method="post">

       @csrf

             		<ul class="p-0">
             			<li class="w-100 mb-2">

  <input class="w-100 p-2" type="email" placeholder="Email" name="email" required="" autocomplete="off"></li>
            <li class="w-100">
  <input class="w-100 p-2" type="password" placeholder="Password" name="password" required="" autocomplete="off"></li>
           


  <li class="d-inline-block mt-2"> @if (Route::has('password.request'))
                                    <a class="btn btn-link forgot_pass" href="{{ route('password.request') }}" style="color:#D3D3D3;" target="_blank">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

</li>
             			<li class="d-inline-block mt-2 ml-auto float-right padd">

     <div class="btn">
     <input type="submit" class="btn btn-success" value="Login">
            </div></li>
             	


             		</ul>
             	</form>
             	</div>
             	<!-- login section end-->
             	<!-- join section -->
             	<div class="join_contain form col-sm-12 mt-5 d-none join_form">


       <form method="post" action="{{ url('/school/join_schools')}}">
            @csrf
             		 <ul class="p-0">
   	<li class="w-100 mb-2">

<!-- 
   <input class="w-100 p-2" type="text" placeholder="Company Name" name="">
 -->
  <label style="width:100%;">Publisher <font style="color:red;">*</font></label>
                <select class="form-control select2" name="p_id" style="width:100%;" id="publisher_id" required>
                  <option value=""> Select Publication</option>
       <?php   $list= \App\Publisher::where('status','=',1)->get();  
              
                       ?>
                   @if(!empty($list))
                   @foreach($list as $list2)

                  <option value="{{$list2->id}}">{{$list2->pblctn_name}}</option>
                   @endforeach
                   @endif
                  

                </select>


    </li>
             			<li class="w-100 mb-2">

 <label for="email">Select Book:<font style="color:red;">*</font></label>
   
 <select class="form-control select2" name="access_code" id="access_code" style="width: 100%;">
    <option value="">Select Book</option>
                </select>

</li>
<li class="w-100 mb-2">

 <label for="email">Email address:<font style="color:red;">*</font></label>
    <input type="email" class="form-control" name="email" id="email" required="" autocomplete="off" >

    <span class="email_mis d-none" style="color:red;display:none;"></span>
  
  </li>
             			
  <li class="w-100 mb-2">

  <label for="pwd">Password:<font style="color:red;">*</font></label>
    <input type="text" class="form-control" name="password" id="password" autocomplete="off" onchange="enterpassword(this)" required>
   <span class="mis_pass d-none" style="color:red"></span>

</li> 

 <li class="w-100 mb-2">
    <label for="pwd">School:<font style="color:red;">*</font></label>
    <input type="text" class="form-control" name="school" id="school" autocomplete="off" required>
  </li>

  <li class="w-100 mb-2">
    <label for="pwd">Address:<font style="color:red;">*</font></label>
   <textarea class="form-control" name="school_address" id="school_address" autocomplete="off" required></textarea>
   
  </li>
  <li class="w-100 mb-2">
    <label for="pwd">Phone No:<font style="color:red;">*</font></label>
    <input type="text" class="form-control" name="sc_ph_no" id="sc_ph_no" autocomplete="off" required>
  </li>
  <li class="w-100 mb-2">
    <label for="pwd">University/Board:<font style="color:red;">*</font></label>
    <input type="text" class="form-control" name="board_university" id="board_university" autocomplete="off" required>
  </li>
  <li class="w-100 mb-2">

  <label for="email">Concern Person<font style="color:red;">*</font></label>
    <input type="text" class="form-control" name="concern_person" id="concern_person" autocomplete="off" required>

</li>
	<li class="d-inline-block mt-2"><a class="text-white" href="#">Forgot Password?</a></li>
             			
      <li class="d-inline-block ml-auto float-right padd">
      	<div class="btn">
      		<input type="submit" class="btn-btn-success" name="submit" value="submit">

      </div></li>
             		</ul> 
             	</form>
             	</div>
          	
			</div>
			
		</div>
	</div>
</section>
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/welcome.js')}}"></script>

</body></html>