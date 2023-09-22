@extends('layouts.admin_layout')
@section('content')
    @if ($errors->any())
        <p class="alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </p>
    @endif
    @if (session('message'))
        <p class="alert-info text-center">{{ session('message') }}</p>
    @endif

    <h6 class="alert-secondary text-center p-3" >Add user</h6>
    <form action="" method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Name</label>
            <input value="{{request()->old('name')}}" name="name" type="text" class="form-control">
        </div>
        <div class="col-6">
            <label  class="form-label">Email</label>
            <input value="{{request()->old('email')}}" type="email" name="email" class="form-control">
        </div>
        <div class="col-6">
            <label  class="form-label">Password</label>
            <input value="{{request()->old('password')}}" type="password" name="password" class="form-control">
        </div>
        <div class="col-6">
            <label  class="form-label">Phone</label>
            <input value="{{request()->old('phone')}}" type="text" name="phone" class="form-control">
        </div>
        <div class="col-6">
            <label  class="form-label">Address</label>
            <input value="{{request()->old('address')}}" type="text" name="address" class="form-control">
        </div>
        @csrf
        <div class="col-12">
            <button type="submit" class="btn btn-block mt-2 btn-primary">Add</button>
        </div>
    </form>
@endsection
