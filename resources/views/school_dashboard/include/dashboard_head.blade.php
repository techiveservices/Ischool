<!DOCTYPE html>
<html lang="en">
<head>
  <title>Study Buddy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="{{ asset('teacher_dashboard/css/owl.carousel.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('teacher_dashboard/css/owl.theme.default.min.css')}}"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Courgette|Merienda:400,700|Pacifico" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('teacher_dashboard/css/style.css')}}"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <style type="text/css">
  	.btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle {
    
    background-color: #007bff !important;
   
}
.btn-secondary {
    
    background-color: #007bff !important;
    
}
.footer__contact__area.bg__cat--2{position: inherit;}
  </style>
  <style>
.Portfolio h3{ font-size: 24px; margin-bottom: 0 !important; }
.Portfolio .row{ padding: 15px 0; }
.desc { padding: 5px; text-align: center; font-size: 90%; background:black; color:hotpink }
.nav { padding:20px;  margin-top:-30px; }
.nav li a { margin:5px;

    padding: 15px 44px; 

    font-size:16px; 

    transition-duration: 0.4s;

}

.nav a:hover { 


    color: #fff

}




@keyframes winanim {

    0%{opacity:0;transform:scale3d(.3,.3,.3)}

    50%{opacity:1}

    

}

  [type="checkbox"]:not(:checked),

[type="checkbox"]:checked {

  position: absolute;

  left: -9999px;

}

[type="checkbox"]:not(:checked) + label,

[type="checkbox"]:checked + label {

  position: relative;

  padding-left: 1.95em;

  cursor: pointer;
  margin: 0;

}



/* checkbox aspect */

[type="checkbox"]:not(:checked) + label:before,

[type="checkbox"]:checked + label:before {

  content: '';

  position: absolute;

  left: 0; top: 0;

  width: 1.25em; height: 1.25em;

  border: 2px solid #ccc;

  background: #fff;

  border-radius: 4px;

  box-shadow: inset 0 1px 3px rgba(0,0,0,.1);

}

/* checked mark aspect */

[type="checkbox"]:not(:checked) + label:after,

[type="checkbox"]:checked + label:after {

  content: '\2713\0020';

  position: absolute;

  top: .15em; left: .22em;

  font-size: 1.3em;

  line-height: 0.8;

  color: #dc3545;

  transition: all .2s;

  font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;

}

/* checked mark aspect changes */

[type="checkbox"]:not(:checked) + label:after {

  opacity: 0;

  transform: scale(0);

}

[type="checkbox"]:checked + label:after {

  opacity: 1;

  transform: scale(1);

}

/* disabled checkbox */

[type="checkbox"]:disabled:not(:checked) + label:before,

[type="checkbox"]:disabled:checked + label:before {

  box-shadow: none;

  border-color: #bbb;

  background-color: #ddd;

}

[type="checkbox"]:disabled:checked + label:after {

  color: #999;

}

[type="checkbox"]:disabled + label {

  color: #aaa;

}

/* accessibility */

[type="checkbox"]:checked:focus + label:before,

[type="checkbox"]:not(:checked):focus + label:before {

  border: 2px dotted blue;

}



/* hover style just for information */

label:hover:before {

  border: 2px solid #4778d9!important;

}

.form-p>form>p{

    padding: 22px !important;

  border: 1px solid #f8b732;

  font-family: cursive;

}.form-p-que>form>p{

    padding: 22px !important;

  border: 1px solid #f8b732;

  font-family: cursive;

}

.form-p-que .accordion .form-show>form>p{

    padding: 22px !important;

  border: 1px solid #f8b732;

  font-family: cursive;

}

.form-p-que>form>ul>li{

    padding: 22px !important;

  border: 1px solid #f8b732;

  font-family: cursive;

}

.que-img>span>img{

  height: 100%;

  width: 100%;

  margin-top: -47px;

}

.que-img{

  width: 40px;

}

.scroll{

  overflow: scroll;

  height: 700px;

}

.form-p>p{

    padding: 6px !important;

  border: 1px solid #f8b732;

  font-family: cursive;

}


.collapsible {

    background-color: #777;

    color: white;

    cursor: pointer;

    padding: 10px;

    width: 100%;

    border: none;

    text-align: left;

    outline: none;

    font-size: 15px;

}

button.collapsible:after {

    content: '\002B';

    color: white;

    font-weight: bold;

    float: right;

    margin-left: 5px;

}

button.collapsible.active:after {

    content: "\2212";

}

.active, .collapsible:hover {

    /*background-color: #555;*/

}



.content {

    padding: 0 18px;

    display: none;

    overflow: hidden;

    /*background-color: #f1f1f1;*/

}

/*tabbing*/

.tab {

    overflow: hidden;

        padding: 0px 0px;

    /*border: 1px solid #ccc;

    background-color: #f1f1f1;*/

}
.hidebuttn{ display: none; }



/* Style the buttons inside the tab */

.tab button {

    background-color: inherit;

    float: left;

    border: none;

    outline: none;

    cursor: pointer;

    padding: 15px 0px;
    /*width: 158px;*/
     font-size: 13px;

    transition: 0.3s;


}
.tab button strong{ font-size: 18px;  display: block;  color: #19283d; }
#pills-tabContent {

    margin-top: 15px;

}



/* Change background color of buttons on hover */

.tab button:hover {

    background-color: #ddd;

}



/* Create an active/current tablink class */

.tab button.active {

    background-color: #ccc;

}


.e-zone ul li:last-child{ margin-left: 0; }
.list-group-flush .list-group-item{  background-color: transparent;   text-transform: uppercase; width: 24%;}
.list-group-flush .list-group-item:nth-child(odd){     /*background-color: #bbe5f8;*/
    margin-bottom: 10px;
   /* padding-left: 14px !important;*/ }
/* Style the tab content */

.tabcontent {

    display: none;

    padding: 6px 12px;

}

.tabcontent-css1{

    border: 1px solid #dc3545;

    border-top: none;

    border-radius: 23px;

}

.tabcontent-css2{

    border: 1px solid #ffc107;

    border-top: none;

    border-radius: 23px;

}

.tabcontent-css3{

    border: 1px solid #007bff;

    border-top: none;

    border-radius: 23px;

}

.tabcontent-css4{

    border: 1px solid #28a745;

    border-top: none;

    border-radius: 23px;

}

.tabcontent-css5{

    border: 1px solid #17a2b8;

    border-top: none;

    border-radius: 23px;

}

.tabcontent-css6{

    border: 1px solid #343a40;

    border-top: none;

    border-radius: 23px;

}

.bg-purple{

  background: #63028f;

}


.text_caption{ position: fixed; right: 15px;     bottom: 10%; /*padding: 15px;*/ z-index: 99999; font-size: 16px;  border-radius: 50%; vertical-align: middle; }
.top-fixed { -webkit-animation: rotate 3s linear 0s infinite  normal; animation: rotate 3s linear 0s infinite normal; width: 120px;}
.text_caption1{ color: #000; font-weight: bold; position: absolute; top: 50%; left: 50%;      transform: translate(-50%,-50%);
font-size: 15px; text-align: center;}
@-webkit-keyframes rotate {
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg); } }
@keyframes rotate {
  100% {
    transform: rotate(360deg); } }
    button.btn.btn-primary.float-right.testGenerate{bottom: 15px;}
</style>


</head>
<body>
	<?php
 $user_id=Auth::user()->id;

        $p_id=  \App\School::where('user_id',$user_id)->value('p_id');

            $pub_info=\App\Publisher::where('id','=',$p_id)->first();
           
?>
	<section class="top-bar py-2"> <!-- top-bar -->
		<div class="container">
			<div class="row m-0">
				<ul class="m-0 p-0 float-left w-75">
					<li class="d-inline-block"><i class="fas fa-envelope text-success"></i> <a href="mailto:"><small>{{$pub_info->pblr_email_id}}</small></a></li> /
					<li class="d-inline-block"><i class="fas fa-mobile-alt text-success"></i> <small>Contact Now :</small><a href="mailto:"><small>{{$pub_info->pblr_cntct_no}}</small></a>

              

          </li>	
				</ul>
				<ul class="m-0 p-0 float-right w-25 text-right">
                    @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						     {{ Auth::user()->name }}
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						  	   <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
						    <!-- <a class="dropdown-item" href="{{ route('logout') }}">Logout</a> -->
						  <!--   <a class="dropdown-item" href="#">Another action</a>
						    <a class="dropdown-item" href="#">Something else here</a> -->
						  </div>
						</div>
                            <!-- <li class="nav-item dropdown">
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
                            </li> -->
                        @endguest




					<!-- <li class="d-inline-block"><a href="#"><small>Login</small></a></li> 
					/
					
					<li class="d-inline-block"><a href="#"><small>Register</small></a></li>	 -->

				</ul>
			</div>
		</div>
	</section> <!-- top-bar -->

	<section id="nav-bar-top" class="nav-bar-top bg-primary-color">
		<div class="container">
			<div class="row m-0">
			<nav class="navbar navbar-expand-lg navbar-dark w-100 px-0">
			  <a class="navbar-brand" href="#">

  @if($pub_info->pblr_logo!='')
 <img src="{{asset('images/publisher_logo/')}}/{{$pub_info->pblr_logo }}" height="50px" width="50px">
 @else
<img src="{{ asset('images/logo-1c.png')}}" height="50px" width="50px">
 @endif


			</a>
			  <div class="shopbox d-none justify-content-end align-items-center mob-0">
					
        
             




          <a class="minicart-trigger" href="#">

       		<i class="fas fa-user-alt"></i>
					</a>
					<!-- <span>03</span> -->
				</div>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mx-auto">
			      
			      <li class="nav-item active">
			        <a class="nav-link"href="{{ url('/home')}}">Home <span class="sr-only">(current)</span></a>
			      </li>
			   		    
			      <li class="nav-item">
			        <a class="nav-link" href="{{ url('school/my_profile')}}" >
			          Profile
			        </a>
			      </li>
			    </ul>
          <span><i class="fa fa-refresh" aria-hidden="true"></i></span>
          
				<div class="shopbox d-flex justify-content-end align-items-center mob-1" style="color: #fff;
    font-weight: bold;">
					<?php
               $user= Auth::user()->name;
              ?>
             {{ $user }} 
        

          <a class="minicart-trigger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="margin-left: 10px;">
						<i class="fas fa-power-off" style="margin-top: 10;"></i>
					</a>
          

        
					<!-- <span >03</span> -->
				</div>			    
			  </div>
			</nav>					
			</div>		
		</div>
	</section>


	 @yield('content')


	 <footer class="footer-area footer--2" id="footer" 
   ">
<!-- .Start Footer Contact Area -->
			<div class="footer__contact__area bg__cat--2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="footer__contact__wrapper d-flex flex-wrap justify-content-between">
								<div class="single__footer__address">
									<div class="ft__contact__icon">
										<i class="fa fa-home"></i>
									</div>

									<div class="ft__contact__details">
										<p class="m-0">{{$pub_info->pblctn_name}}</p>
							<p class="m-0">{{$pub_info->pblctn_addrs}}</p>
									</div>
								</div>
								<div class="single__footer__address">
									<div class="ft__contact__icon">
										<i class="fa fa-phone"></i>
									</div>
									<div class="ft__contact__details">
										<p class="m-0"><a href="#">{{$pub_info->pblr_cntct_no}}</a></p>
										<!-- <p class="m-0"><a href="#">{{$pub_info->	pblr_cntct_no}}</a></p> -->
									</div>
								</div>
								<div class="single__footer__address">
									<div class="ft__contact__icon">
										<i class="fa fa-envelope"></i>
									</div>
									<div class="ft__contact__details">
				<p class="m-0"><a href="#">{{$pub_info->pblr_email_id}}</a></p>
				<p> <!-- <div id="show" align="center"></div> --></p>

                  	<!-- <p class="m-0"><a href="#">{{$pub_info->pblr_email_id}}</a></p> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- .End Footer Contact Area -->
			<div class="copyright  bg--theme">
				<div class="container">
					<div class="row align-items-center copyright__wrapper justify-content-center">
						<div class="col-lg-12 col-sm-12 col-md-12">
							<div class="coppy__right__inner text-center">
								<p class="m-0"><i class="fa fa-copyright"></i>All Right Reserved.<a href="#">Techive</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#view_test_paper_list').DataTable();
} );
  </script>

  <script>

         addEventListener("load", function () {

         	setTimeout(hideURLbar, 0);

         }, false);

         

         function hideURLbar() {

         	window.scrollTo(0, 1);

         }

      </script>	
 <script type='text/javascript'>
    // <![CDATA[
    var colour="#ff491b";
    var sparkles=100;
   
    var x=ox=400;
    var y=oy=300;
    var swide=800;
    var shigh=600;
    var sleft=sdown=0;
    var tiny=new Array();
    var star=new Array();
    var starv=new Array();
    var starx=new Array();
    var stary=new Array();
    var tinyx=new Array();
    var tinyy=new Array();
    var tinyv=new Array();
    window.onload=function() { if (document.getElementById) {
    var i, rats, rlef, rdow;
    for (var i=0; i<sparkles; i++) {
    var rats=createDiv(3, 3);
    rats.style.visibility="hidden";
    document.body.appendChild(tiny[i]=rats);
    starv[i]=0;
    tinyv[i]=0;
    var rats=createDiv(5, 5);
    rats.style.backgroundColor="transparent";
    rats.style.visibility="hidden";
    var rlef=createDiv(1, 5);
    var rdow=createDiv(5, 1);
    rats.appendChild(rlef);
    rats.appendChild(rdow);
    rlef.style.top="2px";
    rlef.style.left="0px";
    rdow.style.top="0px";
    rdow.style.left="2px";
    document.body.appendChild(star[i]=rats);
    }
    set_width();
    sparkle();
    }}
    function sparkle() {
    var c;
    if (x!=ox || y!=oy) {
    ox=x;
    oy=y;
    for (c=0; c<sparkles; c++) if (!starv[c]) {
    star[c].style.left=(starx[c]=x)+"px";
    star[c].style.top=(stary[c]=y)+"px";
    star[c].style.clip="rect(0px, 5px, 5px, 0px)";
    star[c].style.visibility="visible";
    starv[c]=50;
    break;
    }
    }
    for (c=0; c<sparkles; c++) {
    if (starv[c]) update_star(c);
    if (tinyv[c]) update_tiny(c);
    }
    setTimeout("sparkle()", 40);
    }
    function update_star(i) {
    if (--starv[i]==25) star[i].style.clip="rect(1px, 4px, 4px, 1px)";
    if (starv[i]) {
    stary[i]+=1+Math.random()*3;
    if (stary[i]<shigh+sdown) {
    star[i].style.top=stary[i]+"px";
    starx[i]+=(i%5-2)/5;
    star[i].style.left=starx[i]+"px";
    }
    else {
    star[i].style.visibility="hidden";
    starv[i]=0;
    return;
    }
    }
    else {
    tinyv[i]=50;
    tiny[i].style.top=(tinyy[i]=stary[i])+"px";
    tiny[i].style.left=(tinyx[i]=starx[i])+"px";
    tiny[i].style.width="2px";
    tiny[i].style.height="2px";
    star[i].style.visibility="hidden";
    tiny[i].style.visibility="visible"
    }
    }
    function update_tiny(i) {
    if (--tinyv[i]==25) {
    tiny[i].style.width="1px";
    tiny[i].style.height="1px";
    }
    if (tinyv[i]) {
    tinyy[i]+=1+Math.random()*3;
    if (tinyy[i]<shigh+sdown) {
    tiny[i].style.top=tinyy[i]+"px";
    tinyx[i]+=(i%5-2)/5;
    tiny[i].style.left=tinyx[i]+"px";
    }
    else {
    tiny[i].style.visibility="hidden";
    tinyv[i]=0;
    return;
    }
    }
    else tiny[i].style.visibility="hidden";
    }
    document.onmousemove=mouse;
    function mouse(e) {
    set_scroll();
    y=(e)?e.pageY:event.y+sdown;
    x=(e)?e.pageX:event.x+sleft;
    }
    function set_scroll() {
    if (typeof(self.pageYOffset)=="number") {
    sdown=self.pageYOffset;
    sleft=self.pageXOffset;
    }
    else if (document.body.scrollTop || document.body.scrollLeft) {
    sdown=document.body.scrollTop;
    sleft=document.body.scrollLeft;
    }
    else if (document.documentElement && (document.documentElement.scrollTop || document.documentElement.scrollLeft)) {
    sleft=document.documentElement.scrollLeft;
    sdown=document.documentElement.scrollTop;
    }
    else {
    sdown=0;
    sleft=0;
    }
    }
    window.onresize=set_width;
    function set_width() {
    if (typeof(self.innerWidth)=="number") {
    swide=self.innerWidth;
    shigh=self.innerHeight;
    }
    else if (document.documentElement && document.documentElement.clientWidth) {
    swide=document.documentElement.clientWidth;
    shigh=document.documentElement.clientHeight;
    }
    else if (document.body.clientWidth) {
    swide=document.body.clientWidth;
    shigh=document.body.clientHeight;
    }
    }
    function createDiv(height, width) {
    var div=document.createElement("div");
    div.style.position="absolute";
    div.style.height=height+"px";
    div.style.width=width+"px";
    div.style.overflow="hidden";
    div.style.backgroundColor=colour;
    return (div);
    }
    // ]]>
    </script>

    
      <script>

         jQuery(document).ready(function ($) {

         	$(".scroll").click(function (event) {

         		event.preventDefault();

         		$('html,body').animate({

         			scrollTop: $(this.hash).offset().top

         		}, 900);

         	});

         });

      </script>

 <script type="text/javascript">
     $(document).ready(function(){
       $('.start_read_submit').click(function(){

       var form_id = $(this).closest("form").attr('id');
      //  alert(form_id);

      var form_id_list= form_id.split('_');
      var res= form_id_list[3];
      //alert(res);
       var email=$('#email'+'_'+res).val();
       var _token = $('input[name="_token"]').val();
       var otp=$('#otp'+'_'+res).val();
       var otp_test=$('#otp_test'+'_'+res).val();
       //alert(email);
       if(otp_test==''){
         $.ajax({
      type: "POST", 
      url: "{{url('/school/send_otp')}}",
      dataType: "json",
      data:{email:email,_token:_token}
    }).done(function (data) {
        console.log(data);
       $('#otp_test'+'_'+res).val(data);
       $('#email_id'+'_'+res).removeClass("d-block").addClass("d-none");
       $('#name'+'_'+res).removeClass("d-block").addClass("d-none");
      // $('#otp_test2').removeClass("d-none").addClass("d-block");
       $('#otp2'+'_'+res).removeClass("d-none").addClass("d-block");
       
       var otp_test=$('#otp_test'+'_'+res).val();
       //alert(otp_test);
       $('#otp'+'_'+res).change(function(){

        var my_otp= $('#otp'+'_'+res).val();
        
        if(my_otp==otp_test){

          $('#start_read_form'+'_'+res).submit();
          location.reload();
        }else{
          alert('otp mismatch');
          var my_otp= $('#otp'+'_'+res).val('');
        }

       });

    }).fail(function (data) {
        console.log(data);
    });
       }else{



       }
    
     });
     });
          
    </script>
   <script type="text/javascript">
      function readmore(data){

       
        var result = data.split('_');
        //alert( result[1] );
        var value = result[0].concat('_',result[1],'_',result[3]);
        var value2 = result[0].concat('_',result[1],'_2_',result[3]);
        //alert(value);
        var button_txt=$('.'+data).text();
       // alert(button_txt);
      // alert(new_text);
         if(button_txt=='+ Read More'){
          $('.'+value).removeClass("d-none").addClass("d-inline");
          $('.'+value2).removeClass("d-inline-block").addClass("d-none");

          $('.'+data).text('- Read Less');
         }else if(button_txt=='- Read Less'){
         $('.'+value).removeClass("d-inline").addClass("d-none");
        $('.'+value2).removeClass("d-none").addClass("d-inline-block");

          $('.'+data).text('+ Read More');

         }
        

        //$('.'+data).removeClass("d-inline").addClass("d-none");
      }

   function readmoremin(data){

    //alert(data);
    var result = data.split('_');
        //alert( result[1] );
        var value1 = result[0].concat('_',result[1],'_',result[3]);
        //alert(value1);
        $('.'+value1).removeClass("d-inline-block").addClass("d-none");
        $('.'+data).removeClass("d-none").addClass("d-inline-block");
   }

   </script>




    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
      $('.datepicker').datepicker();
    </script>
      <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.7/vue.js'></script><script src='https://rawgit.com/Wlada/vue-carousel-3d/master/dist/vue-carousel-3d.min.js'></script>


    
      <script type="text/javascript">
  $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 200) {
        $(".header-bar").addClass("sticky");
    } else {
        $(".header-bar").removeClass("sticky");
    }
});  
</script>

<script>
  $(document).ready(function(){
      $('#school_profile').on('submit', function(event){
  event.preventDefault();
 
  var _token = $('input[name="_token"]').val();
    $.ajax({
   url:"{{url('/school/update_profile')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
   
    
    if(data.status=='ok'){
        
    $('#profile_error').removeClass("d-none").addClass(data.class_name).addClass("d-block");
    $('#profile_error').html(data.message);
   // $('#profile_error').addClass(data.class_name);
    }else{
        
       //alert(data.status); 
    }
    
   }
     
  }); 
    
    
      });   
  }) ;
    
</script>
<script>
  $(document).ready(function(){
      $('#reset_school_password').on('submit', function(event){
  event.preventDefault();
 
  var _token = $('input[name="_token"]').val();
    $.ajax({
   url:"{{url('/school/change_password')}}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
   
    
    if(data.status=='ok'){
        
    $('#reset_pass_error').removeClass("d-none").addClass(data.class_name).addClass("d-block");
    $('#reset_pass_error').html(data.message);
   // $('#profile_error').addClass(data.class_name);
    }else{
        
       //alert(data.status); 
    }
    
   }
     
  }); 
    
    
      });   
  }) ;
    
</script>
  <script>
    function change_new_pass(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("Your password must be at least 6 characters");
         $('.new_pass_mis').removeClass("d-none").addClass("d-block");
         $('.new_pass_mis').text("Your password must be at least 6 characters");
         
         $('#new_pass').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("Your password must contain at least one letter in lower case."); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("Your password must contain at least one letter in lower case.");
         $('#new_pass').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("Your password must contain at least one letter in upper case."); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
         $('.new_pass_mis').text("Your password must contain at least one letter in upper case.");
          $('#new_pass').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("Your password must contain at least one special character."); 
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("Your password must contain at least one special character.");
         $('#new_pass').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.new_pass_mis').removeClass("d-none").addClass("d-block");
        $('.new_pass_mis').text("Your password must contain at least one digit.");
        errors.push("Your password must contain at least one digit.");
         $('#new_pass').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.new_pass_mis').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        $('.new_pass_mis').removeClass("d-block").addClass("d-none");
        $('.new_pass_mis').hide();
        
        $('#new_pass').css('border','');
         return true;
    }
    }
</script> 
<script>
    function change_c_pass(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("Your password must be at least 6 characters");
         $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("Your password must be at least 6 characters");
         
         $('#c_password').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("Your password must contain at least one letter in lower case."); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("Your password must contain at least one letter in lower case.");
         $('#c_password').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("Your password must contain at least one letter in upper case."); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("Your password must contain at least one letter in upper case.");
          $('#c_password').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("Your password must contain at least one special character."); 
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("Your password must contain at least one special character.");
         $('#c_password').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.c_pass_mis').removeClass("d-none").addClass("d-block");
        $('.c_pass_mis').text("Your password must contain at least one digit.");
        errors.push("Your password must contain at least one digit.");
         $('#c_password').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.c_pass_mis').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        
       var new_pass= $('#c_password').val();
       var c_pass= $('#new_pass').val();
       if(new_pass!=c_pass){
          $('.c_pass_mis').removeClass("d-none").addClass("d-block");
         $('.c_pass_mis').text("Confirm Password not Match with New Password");  
           
       }else{
            $('.c_pass_mis').removeClass("d-block").addClass("d-none");
        $('.c_pass_mis').hide();
        
        $('#c_password').css('border','');
         return true;
           
       }
       
    }
    }
</script>

<script>
    $(document).ready(
            function() {
                setInterval(function() {
                   
var today = new Date();
var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;


                    var randomnumber = Math.floor(Math.random() * 100);
                    $('#show').text(''+ dateTime);
                }, 1000);
            });
</script>
<script>
   $(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
});

</script>





   </body>

</html>
