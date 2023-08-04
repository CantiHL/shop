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
                                <table class="table table-bordered table-success" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Brand Id</th>
                                            <th>Category Id</th>
                                            <th>Des</th>
                                            <th>Image</th>
                                            <th>Pro Date</th>
                                            <th>Status</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data_products as $list_products)
                                        <tr>
                                            <td>{{ $list_products->product_name }}</td>
                                            <td>{{ number_format($list_products->product_price,0,'', '.') }}</td>
                                            <td>{{ $list_products->brand_name }}</td>
                                            <td>{{ $list_products->category_name }}</td>
                                            <td>{{ $list_products->product_description }}</td>
                                            <td><img width="100" height="60" src="{{ asset('assets/img/products/'.$list_products->product_image)  }}" alt="{{ $list_products->product_image }}"></td>
                                            <td>{{ date("d-m-Y H:i:s",strtotime($list_products->product_date)) }}</td>
                                             @if($list_products->product_status==0)
                                                <td><a class="btn btn-block btn-success" href="{{ route('update_status_product',['id'=>$list_products->id,'value'=>1]) }}">Available</a></td>
                                            @else
                                                 <td><a class="btn btn-block btn-secondary" href="{{ route('update_status_product',['id'=>$list_products->id,'value'=>0]) }}">Sold Out</a></td>
                                            @endif
                                            <td><a href="{{ route('edit_form_product',['id'=>$list_products->id]) }}">Update</a></td>
                                            <td><a href="{{ route('delete_product',['id'=>$list_products->id]) }}">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@stop
