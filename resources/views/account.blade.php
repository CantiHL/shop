<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Account</title>
	<link href="{{asset('clients/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('clients/css/main.css')}}" rel="stylesheet">
</head>
<body>
	@include('clients.header')
	<hr>
	@if(session('message_success'))
	<h3 class="alert-success text-center">{{session('message_success')}}</h3>
	@endif
	<div class="container">
		<form action="{{route('update_account')}}" method="post">
			@foreach($data as $user_data => $value)
			@csrf
			<input type="hidden" name="id" value="{{$value->id}}">
		  <div class="form-group col-md-6">
		    <label for="exampleInputEmail1">User Name</label>
		    <input type="text" class="form-control" name="user_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$value->user_name}}">
		  </div>
		   <div class="form-group col-md-6">
		    <label for="exampleInputEmail1">Email</label>
		    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$value->email}}">
		  </div>
		   <div class="form-group col-md-6">
		    <label for="exampleInputEmail1">Phone</label>
		    <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$value->phone}}">
		  </div>
		   <div class="form-group col-md-6">
		    <label for="exampleInputEmail1">Address</label>
		    <input type="text" class="form-control" name="address" id="" aria-describedby="emailHelp" value="{{$value->address}}">
		  </div>
		  <button type="submit" class="btn btn-success ">Update</button>
		  @endforeach
		</form>
	</div>
		<hr>
		@include('clients.footer')
</body>
</html>
		