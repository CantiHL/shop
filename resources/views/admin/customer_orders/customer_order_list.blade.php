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
                                <table class="table table-bordered table-danger" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Information</th>
                                            <th>Customer Information</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach ($data as $oder)
                                        <tr>
                                            <td>{{ $oder->id }}</td>
                                            <td>Product Name: <strong>{{ $oder->product_name }}</strong><br>
                                                Product price: <strong>{{ number_format($oder->product_price) }}</strong><br>
                                                Quantity: <strong>{{ $oder->quantity }}</strong><br>
                                                Total: <strong>{{ number_format($oder->product_price*$oder->quantity) }}</strong>
                                            </td>
                                            <td>Customer Name: <strong>{{ $oder->name }}</strong><br>
                                                Customer Phone: <strong>{{ $oder->phone }}</strong><br>
                                                Customer Address: <strong>{{ $oder->address }}</strong><br>
                                            </td>
                                            <td>@if($oder->note==null)
                                                No Require
                                                @else
                                                {{ $oder->note }}
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <form action="{{route('update_order')}}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $oder->id }}">
                                                    <select class="form-control" name="status" id="status">
                                                        <option selected value="{{$oder->status}}">{{$oder->status}}</option>
                                                        <option value="preparing">preparing</option>
                                                        <option value="delivering">delivering</option>
                                                        <option value="done">done</option>
                                                    </select>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-sm btn-block" type="submit">Update</button>
                                            </form>
                                                <a class="btn btn-danger btn-sm btn-block" href="{{ route('delete_order',['id'=>$oder->id]) }}">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@stop
