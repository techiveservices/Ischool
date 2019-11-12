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
          		<div class="col-md-4">
          			<h1 class="text-center">Edit Register</h1>
          			<div class="col-md-12">
          				<form action="{{url('/register_edit')}}" method="POST" class="text-center" enctype="multipart/form-data">
          					<?php echo($fetchData->name); ?>
          					<div class="col-md-12">
          						{{csrf_field()}}
          						<input type="hidden" name="edit_id" value="{{$fetchData->id}}" placeholder="" class="form-control mt-3" >
          						<input type="text" name="name" value="{{$fetchData->name}}" placeholder="Enter Name" class="form-control mt-3" >
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="email" value="{{$fetchData->email}}" placeholder="Enter Email" class="form-control mt-3">
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="mobile" value="{{$fetchData->mobile}}" placeholder="Enter Mobile" class="form-control mt-3">
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="status" value="{{$fetchData->status}}" placeholder="Enter Status" class="form-control mt-3">
          					</div>
                    @if($fetchData->image)
                    <div class="col-md-12">
                      <label for="">Previous Image</label>
                      <img src="{{url('images/'.$fetchData->image)}}" width='100px' alt="">
                    </div>
                    @endif
                      <div class="col-md-12">
                      <input type="file" name="image" value="{{old('image')}}" placeholder="" class="form-control mt-3">
                      <input type="hidden" name="pre_image" value="{{$fetchData->image}}">
                    </div>
          					<div class="col-md-12">
          						<input type="submit" name="submit" value="update"  class="btn btn-success mt-3 ">
          					</div>
          						<div class="col-md-12">
          							@if(session('success_message'))
          						<div class="aler alert-success mt-3">{{session('success_message')}}</div>
          						@endif
          					</div>
          					<div class="col-md-12">
          							@if(session('error_message'))
          						<div class="aler alert-success mt-3">{{session('error_message')}}</div>
          						@endif
          					</div>
          				</form>
          			</div>
          		</div>
          	
          	</div>
          </div>
    </body>
</html>