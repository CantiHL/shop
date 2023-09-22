@extends('layouts.admin_layout')
@section('content')
@if (session('message'))
    <p class="alert-info text-center">{{ session('message') }}</p>
@endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
        </div>
        <div class="row ml-3">
            <div class="col-3">
                <a class="btn btn-success" href="{{ route('add_user') }}">Add User</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-primary" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data_users as $list_user)
                        <tr>
                            <td>{{ $list_user->id }}</td>
                            <td>{{ $list_user->user_name }}</td>
                            <td>{{ $list_user->email }}</td>
                            <td>{{ str_replace($list_user->password,'***********',$list_user->password) }}</td>
                            <td>{{ $list_user->phone }}</td>
                            <td>{{ $list_user->address }}</td>
                            <td>
                                <a href="{{ route('edit_form_user',['id'=>$list_user->id]) }}" class="btn btn-block btn-info btn-sm">Update</a>
                                <a href="{{ route('delete_user',['id'=>$list_user->id]) }}" class="btn btn-block btn-danger btn-sm" >Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
