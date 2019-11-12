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


<script type="text/javascript">
  $(document).ready(function(){
    $('.menu_tab li:first-child').click(function(){
      // $('.home_contain').removeClass('d-none');
      $('.about_contain').removeClass('d-none');
      $('.login_contain').addClass('d-none');
      $('.join_contain').addClass('d-none');
    })
    $('.menu_tab li:nth-child(2)').click(function(){
      // $('.home_contain').addClass('d-none');
      $('.about_contain').addClass('d-none');
      $('.login_contain').removeClass('d-none');
      $('.join_contain').addClass('d-none');
    })
    $('.menu_tab li:nth-child(3)').click(function(){
      // $('.home_contain').addClass('d-none');
      $('.about_contain').removeClass('d-block').addClass('d-none');
      $('.login_contain').removeClass('d-block').addClass('d-none');
      $('.join_contain').removeClass('d-none');
    })
    // $('.menu_tab li:nth-child(4)').click(function(){
    //  // $('.home_contain').addClass('d-none');
    //  $('.about_contain').addClass('d-none');
    //  $('.login_contain').addClass('d-none');
    //  $('.join_contain').removeClass('d-none');
    // })
  })
</script>
  
<style type="text/css">
  .input100, .login100-form-btn{padding: 10px ; height: auto; font-size: 14px;}
  .container-login100-form-btn{ margin-top: 5px; }
  .validate-input{ margin-bottom: 5px; }
  .flex-sb-m{ padding-bottom: 0 !important; }
  .container-login100-form-btn.m-t-17 {
    width: 50%;
    float: right;
}
.flex-sb-m.w-full.p-t-3.p-b-24 {
    width: 50%;
    float: left;
}
form.login100-form.validate-form.flex-sb.flex-w {
    background-color: #fff;
    padding: 20px;
}
/*body{
    background-image: url('image/login_bg_img.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
}*/
.login100-form-title{ padding-bottom: 20px; }
.wrap-login100{ background-color: transparent; }
.input100{ background-color: #fff; }
.login100-form-title, .txt1{ color: #367fa9; }
.login100-form-title{ font-size: 24px; }
.login100-form-btn{ background-color: #367fa9 }
.img_style{ max-width: 100%; width: 100vw; height: 100vh; position: fixed; z-index: -1;}
.logo-for-logim{ width: 200px; height: auto; display: flex; margin-left: auto; margin-top: 10px;}
.tab_login{          background-color: rgba(0, 41, 109, 0.6); height: 85vh; }
.join_contain{overflow-y: auto; height: 60vh;}
.join_contain ul li label{ color: #fff; font-weight: bold; }
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
.menu_tab li{ cursor: pointer; font-weight: bold; }
li{ list-style: none; }
a{ text-decoration: none; }
.about_contain { height: 75vh; overflow-y: auto; color: #fff; }
.login_contain input{ background-color: #ffffff6b; border-radius:  5px; border: 0;color: #fff;}
.padd div{ padding:0px 30px;  }
::placeholder { color: #fff; }
/*.fixt_bot{ position: fixed; bottom: 10px; }*/
.about_contain p, .about_contain a{ font-weight: 500; line-height: 18px; font-size: 14px; margin-bottom: 5px;}


@media only screen and (min-width: 768px) and (max-width: 1168px) { 
 
}
@media only screen and (min-width: 768px) and (max-width: 999px) {
 
}

@media only screen and (min-width: 480px) and (max-width: 767px) {  

.tab_login {     max-width: 40%;
    flex: 40%;
        background-color: rgba(22, 56, 113, 0.8);
    height: auto;
    margin: 10px 0 0 0 !important;
}
iframe{ width: 250px; margin-top: 20px; }


.menu_tab li {
    cursor: pointer;
    margin-right: 5px !important;
    font-size: 14px;
}
}
@media only screen and (max-width: 479px) {
.mobilie{ display: none; }
.tab_login {    
        background-color: rgba(22, 56, 113, 0.8);
        height: 100%;
    margin: 10px 0 0 0 !important;
}
iframe{ width: 100%; margin-top: 20px; }
.img_style{ display: none;}
.mio, .mio img { display: block !important; height: auto; width: 100%; }
.about_contain{ height: auto; }
}
.join_form input{ background-color: #ffffff6b; border-radius:  5px; border: 0;color: #fff; }
</style>
    <!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    });
</script>
<script>
  $(document).ready(function(){
      $('#publisher_id').change(function(){
         var pub_id=$(this).val();

        if(pub_id != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ url('accesscode/fetch2') }}",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('#access_code').html(result);
    }

   });
  }

      });

  });
 
</script>
<script> 
$(document).ready(function(){
    $('#email').change(function(){
        
      var email=  $('#email').val();
      var _token = $('input[name="_token"]').val();
  
 if (validateEmail(email)) {
    $.ajax({
    url:"{{ url('/test/email') }}",
    method:"POST",
    data:{email:email,_token:_token},
    success:function(result)
    {
     
     if(result==1){
         $('#email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(email id already taken)");
         $('#email').val(''); 
     }else{
         $('.email_mis').removeClass("d-block").addClass("d-none");
          $('#email').css("border", ""); 
          $('.email_mis').text("");
     }
    
    }

   });
 
 
 
 
  } else {
   
      $('#email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(In valid Email)");
         $('#email').val(''); 
   
   
   
   
    // $result.text(email + " is not valid :(");
    // $result.css("color", "red");
  }
      
        
    });
    
});

</script>
<script>
    function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
</script>
<script>
    function enterpassword(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("Your password must be at least 6 characters");
         $('.mis_pass').removeClass("d-none").addClass("d-block");
         $('.mis_pass').text("Your password must be at least 6 characters");
         
         $('#password').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("Your password must contain at least one letter in lower case."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one letter in lower case.");
         $('#password').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("Your password must contain at least one letter in upper case."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
         $('.mis_pass').text("Your password must contain at least one letter in upper case.");
          $('#password').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("Your password must contain at least one special character."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one special character.");
         $('#password').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one digit.");
        errors.push("Your password must contain at least one digit.");
         $('#password').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.mis_pass').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        $('.mis_pass').removeClass("d-block").addClass("d-none");
        $('.mis_pass').hide();
        
        $('#password').css('border','');
         return true;
    }
    }
</script>
</body></html>