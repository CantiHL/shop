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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Category</h6>
        </div>
        <div class="row ml-3">
            <div class="col-3">
                <a class="btn btn-success" href="{{ route('add_category') }}">Add Category</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-danger" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_categories as $list_category)
                        <tr>
                            <td>{{ $list_category->id }}</td>
                            <td>{{ $list_category->name }}</td>
                            <td>{{ $list_category->description }}</td>
                            <td><a class="btn btn-block btn-info btn-sm" href="{{ route('edit_form_category',['id'=>$list_category->id]) }}">Update</a>
                            <a class="btn btn-block btn-danger btn-sm"  href="{{ route('delete_category',['id'=>$list_category->id]) }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
