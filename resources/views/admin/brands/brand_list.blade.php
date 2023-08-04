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
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-primary" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_brands as $list_brand)
                                        <tr>
                                            <td>{{ $list_brand->brand_name }}</td>
                                            <td><img width="100" height="60" src="{{ asset('assets/img/brands/'.$list_brand->brand_image)  }}" alt="{{ $list_brand->brand_image }}"></td>
                                            <td>{{ $list_brand->brand_description }}</td>
                                            @if($list_brand->brand_status==0)
                                                <td><a class="btn btn-block btn-success" href="{{ route('update_status_brand',['id'=>$list_brand->brand_id,'value'=>1]) }}">Active</a></td>
                                            @else
                                                 <td><a class="btn btn-block btn-secondary" href="{{ route('update_status_brand',['id'=>$list_brand->brand_id,'value'=>0]) }}">UnActive</a></td>
                                            @endif
                                            <td><a href="{{ route('edit_form_brand',['id'=>$list_brand->brand_id]) }}" class="btn btn-block btn-info">Update</a></td>
                                            <td><a href="{{ route('delete_brand',['id'=>$list_brand->brand_id]) }}" class="btn btn-block btn-danger" >Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@stop
