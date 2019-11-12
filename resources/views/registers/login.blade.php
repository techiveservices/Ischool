<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </head>
    <body>
          <div class="container">
          	<div class="row">
          		<div class="col-md-12">
          			<h1 class="text-center">Login</h1>
          			<div class="col-md-4 mx-auto">
          				<form action="{{url('/mylogin')}}" method="POST" class="text-center">
          					<div class="col-md-12">
          						{{csrf_field()}}
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="email" value="" placeholder="Enter Email" class="form-control mt-3">
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="mobile" value="" placeholder="Enter Mobile" class="form-control mt-3">
          					</div>
          					<div class="col-md-12">
          						<input type="submit" name="submit" value="Submit"  class="btn btn-success mt-3 ">
          					</div>
          						<div class="col-md-12">
          							@if(session('success_message'))
          						<div class="aler alert-success mt-3">{{session('success_message')}}</div>
          						@endif
          					</div>
          					<div class="col-md-12">
          							@if(session('error_message'))
          						<div class="aler alert-danger mt-3">{{session('error_message')}}</div>
          						@endif
          					</div>
          				</form>
          			</div>
          		</div>
          	   <!-- 2nd part -->
               
               @if(!empty($sel))
              @foreach($sel as $val)
               <div class="col-md-12">
                <h3>Hi {{$val->name}} You are Login</h3>
                 <div class="col-md-4">
                    <label for="">Name :</label> <span>{{$val->name}}</span>
                 </div>
                  <div class="col-md-4">
                    <label for="">Email :</label> <span>{{$val->email}}</span>
                 </div>
                  <div class="col-md-4">
                    <label for="">Mobile :</label> <span>{{$val->mobile}}</span>
                 </div>
                 <div class="col-md-4">
                   <p><a href="{{url('mylogout')}}">Logout</a></p>
                 </div>
               </div>
               @endforeach
              
               @endif
          	</div>
          </div>
    </body>
</html>