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
	@if(session('message'))
	<h3 class="alert-success text-center">{{session('message')}}</h3>
	@endif
	<div class="container">
		<form action="{{route('update_account')}}" method="post">
            @csrf
            <div class="form-group col-md-6">
                <label for="name">User Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->user_name}}">
                <p class="alert-danger">@error('name') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                <p class="alert-danger">@error('phone') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{$user->email}}">
                <p class="alert-danger">@error('email') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
                <p class="alert-danger">@error('address') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            <div class="form-group col-md-3">
                <button class="btn btn-success btnchangepass">Change password</button>
            </div>
		</form>
	</div>
    <div style="display: none" id="formupdatepassword" class="container form-update-password">
        <form action="{{route('upadtepasword')}}" method="post">
            @csrf
            <div class="form-group col-md-6">
                <label for="name">Password</label>
                <input type="text" class="form-control" name="password" id="name">
                <p class="alert-danger">@error('password') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">New Password</label>
                <input type="text" class="form-control" name="newpassword" id="phone">
                <p class="alert-danger">@error('newpassword') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-success">Change</button>
            </div>
        </form>
    </div>
		<hr>
		@include('clients.footer')

<script>
    var btnChange=document.querySelector('.btnchangepass');
    btnChange.addEventListener('click',function (e){
        e.preventDefault();
        var formUpdatePass=document.getElementById('formupdatepassword');
        if (formUpdatePass.style.display=='flex'){
            formUpdatePass.style.display='none';
        }else{
            formUpdatePass.style.display='flex';
        }
    });
</script>
</body>
</html>
