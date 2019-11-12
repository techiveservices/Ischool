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
          			<h1 class="text-center">Register</h1>
          			<div class="col-md-12">
          				<form action="{{url('/reg')}}" method="POST" class="text-center" enctype="multipart/form-data">
          					<div class="col-md-12">
                      <?php 
                                if($errors->any()){
                                  echo '<div class="alert alert-danger"><ul>';
                                  foreach($errors->all() as $error){
                                   echo  '<li>'.$error.'</li>';
                                  }
                                  echo "</div></ul>";
                                }
                      ?>
          						{{csrf_field()}}
          						<input type="text" name="name" value="{{old('name')}}" placeholder="Enter Name" class="form-control mt-3">
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="email" value="{{old('email')}}" placeholder="Enter Email" class="form-control mt-3">
          					</div>
          					<div class="col-md-12">
          						<input type="text" name="mobile" value="{{old('mobile')}}" placeholder="Enter Mobile" class="form-control mt-3">
          					</div>
                      <div class="col-md-12">
                      <input type="file" name="image" value="{{old('image')}}" placeholder="" class="form-control mt-3">
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
          		<!-- view -->
          		<div class="col-md-8">
          			<h1 class="text-center">View Data </h1>
                <p>Total Data :{{$fetchRows->total()}}</p>
          			<table class="table table-hover">
          			<thead>
          				<tr>
          					<th>Sno</th>
          					<th>Name</th>
          					<th>Email</th>
          					<th>Mobile</th>
                    <th>Image</th>
                    <th>Created Date</th>
          					<th>Action</th>
          				</tr>
          			</thead>
          			<tbody>
          				<?php $i=1; ?>
          				@foreach($fetchRows as $val)
                         <tr>
          					<td>{{$i++}}</td>
          					<td>{{$val->name}}</td>
          					<td>{{$val->email}}</td>
          					<td>{{$val->mobile}}</td>
                    @if($val->image)
                    <td><img src="{{url('images/'.$val->image)}}" width="100px" alt="{{$val->name}}"></td>
                    @else
                    <td>No image</td>
                    @endif
                    <td>{{$val->created_at->diffForHumans()}}</td>
          					<td><div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="{{url('register_edit/'.$val->id)}}">Edit</a></li>
      <li><a href="{{url('register_delete/'.$val->id)}}">Delete</a></li>
    </ul>
  </div></td>
          				</tr>
          				@endforeach
          			</tbody>
          			<tfoot>
          				<tr>
          					<th>Sno</th>
          					<th>Name</th>
          					<th>Email</th>
          					<th>Mobile</th>
                    <th>Image</th>
                    <th>Created Date</th>
          					<th>Action</th>
          				</tr>
          			</tfoot>
          			</table>
                <div class="col-md-3">
                  {{$fetchRows->links()}}
                </div>
          		</div>
          		<!-- /view -->
          	</div>
          </div>
    </body>
</html>