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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Producct</h6>
        </div>
        <div class="row ml-3">
            <div class="col-3">
                <a class="btn btn-success btn-sm" href="{{ route('add_product') }}">Add Product</a>
            </div>
            <form action="{{ route('import-product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file_import" accept=".xlsx">
                <button type="submit" class="btn btn-success btn-sm">Import Product</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-success" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Pro Date</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data_products as $list_products)
                        <tr>
                            <td>{{ $list_products->id }}</td>
                            <td>
                                {{ $list_products->name }}
                            </td>
                            <td>{{ number_format($list_products->price,0,'', '.') }}</td>
                            <td>{{ $list_products->brand->name }}</td>
                            <td>{{ $list_products->category->name }}</td>
                            <td>
                                <textarea class="form-control-plaintext" rows="7">
                                    {{ $list_products->description }}
                                </textarea>
                            </td>
                            <td><img width="100" height="60" src="{{ asset('assets/img/products/'.$list_products->image)  }}" alt="{{ $list_products->image }}"></td>
                            <td>{{ date("d-m-Y H:i:s",strtotime($list_products->created_at)) }}</td>
                            <td>{{ $list_products->quantity }}</td>
                            <td><a class="btn btn-block btn-info btn-sm" href="{{ route('edit_form_product',['id'=>$list_products->id]) }}">Update</a><br>
                                <a class="btn btn-block btn-danger btn-sm" href="{{ route('delete_product',['id'=>$list_products->id]) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
