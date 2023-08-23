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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Brand</h6>
        </div>
        <div class="row ml-3">
            <div class="col-3">
                <a class="btn btn-success" href="{{ route('add_brand') }}">Add Brand</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-primary" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_brands as $list_brand)
                        <tr>
                            <td>{{ $list_brand->name }}</td>
                            <td>{{ $list_brand->description }}</td>
                            <td><a href="{{ route('edit_form_brand',['id'=>$list_brand->id]) }}" class="btn btn-block btn-info">Update</a></td>
                            <td><a href="{{ route('delete_brand',['id'=>$list_brand->id]) }}" class="btn btn-block btn-danger" >Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
