<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav style="background-color:#2ca466;"  class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a  style="color:#ffffff;" class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                         
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                      <!-- <li><a href="{{url('reg/')}}" class=" nav-item">My register</a></li> -->
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           <!--  @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
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
         $('#email').css("border", ""); 
         $('.email_mis').removeClass("d-block").addClass("d-none");
         //$('.email_mis').text("(email id already taken)");
         
         
     }else{
         $('.email_mis').removeClass("d-none").addClass("d-block");
          $('#email').css("border", "1px solid red"); 
          $('.email_mis').text("Email not registered. Try with another email.");
          $('#email').val(''); 
     }
    
    }

   });
 
 
 
 
  } else {
   
      $('#email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(In valid Email. Try with another email)");
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

         $('#password').val('');
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("Your password must contain at least one letter in lower case."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one letter in lower case.");
         $('#password').css("border", "1px solid red");
         $('#password').val('');
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("Your password must contain at least one letter in upper case."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
         $('.mis_pass').text("Your password must contain at least one letter in upper case.");
          $('#password').css("border", "1px solid red");
          $('#password').val('');
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("Your password must contain at least one special character."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one special character.");
         $('#password').css("border", "1px solid red");
         $('#password').val('');
    }
    if (p.search(/[0-9]/) < 0) {
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one digit.");
        errors.push("Your password must contain at least one digit.");
         $('#password').css("border", "1px solid red");
         $('#password').val('');
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.mis_pass').removeClass("d-none").addClass("d-block");
       $('#password').val('');
             return false;
    }else{
        $('.mis_pass').removeClass("d-block").addClass("d-none");
        $('.mis_pass').hide();
        
        $('#password').css('border','');
         return true;
    }
    }
</script>
<script>
    function enter_c_password(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("Your password must be at least 6 characters");
         $('.mis_cpass').removeClass("d-none").addClass("d-block");
         $('.mis_cpass').text("Your password must be at least 6 characters");
         
         $('#password-confirm').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("Your password must contain at least one letter in lower case."); 
        $('.mis_cpass').removeClass("d-none").addClass("d-block");
        $('.mis_cpass').text("Your password must contain at least one letter in lower case.");
         $('#password-confirm').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("Your password must contain at least one letter in upper case."); 
        $('.mis_cpass').removeClass("d-none").addClass("d-block");
         $('.mis_cpass').text("Your password must contain at least one letter in upper case.");
          $('#password-confirm').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("Your password must contain at least one special character."); 
        $('.mis_cpass').removeClass("d-none").addClass("d-block");
        $('.mis_cpass').text("Your password must contain at least one special character.");
         $('#password-confirm').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.mis_cpass').removeClass("d-none").addClass("d-block");
        $('.mis_cpass').text("Your password must contain at least one digit.");
        errors.push("Your password must contain at least one digit.");
         $('#password-confirm').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.mis_cpass').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        
          
       var new_pass= $('#c_password').val();
       var c_pass= $('#new_pass').val();
       if(new_pass!=c_pass){
          $('.mis_cpass').removeClass("d-none").addClass("d-block");
         $('.mis_cpass').text("Confirm Password not Match with New Password");  
           
       }else{


        $('.mis_cpass').removeClass("d-block").addClass("d-none");
        $('.mis_cpass').hide();


           // $('.c_pass_mis').removeClass("d-block").addClass("d-none");
       // $('.c_pass_mis').hide();
        
        $('#password-confirm').css('border','');
         return true;
           
       }
       
        






        $('#password-confirm').css('border','');
         return true;
    }
    }
</script>
    
    
</body>
</html>
