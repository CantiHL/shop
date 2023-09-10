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
                <input required  type="text" class="form-control" name="password" id="name">
                <p class="alert-danger">@error('password') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">New Password</label>
                <input required type="text" class="form-control" name="newpassword" id="phone">
                <p class="alert-danger">@error('newpassword') {{ $message }}@enderror</p>
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-success">Change</button>
            </div>
        </form>
    </div>
		<hr>
    <div class="container">
        <div class="card shadow mb-4">
            <h4 class="text-success text-lg">Ordered</h4>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-danger" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($ordered as $order)
                                <tr>
                                    <form action="{{route('updateOrderQuantity')}}" method="post">
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <input type="hidden" name="product_id" value="{{$order->product->id}}">
                                        @csrf
                                        <td>{{$order->product->name}}</td>
                                        <td>{{$order->product->price}}</td>
                                        <td><input min="1" type="number" name="quantity" value="{{$order->quantity}}"></td>
                                        <td>${{$order->quantity*$order->product->price}}</td>
                                        <td>{{$order->status}}</td>
                                        @if($order->status=='pending'&&$order->payment_id==null)
                                            <td>
                                                <button type="submit" name="update" class="btn btn-success">Update</button>
                                                <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                            </td>
                                        @elseif($order->status==='pending'&&$order->payment_id!==null)
                                            <td>
                                                <button disabled type="submit" name="update" class="btn btn-success">Update</button>
                                                <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                            </td>
                                        @else
                                            <td>
                                                <button disabled type="submit" name="update" class="btn btn-success">Update</button>
                                                <button disabled type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                            </td>
                                        @endif
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
