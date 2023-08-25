@extends('layouts.admin_layout')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Details</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-google" href="{{route('expport_orders')}}">export excel</a>
                <table class="table table-bordered table-success" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{$detail->product_id}}</td>
                            <td>{{$detail->name}}</td>
                            <td>{{$detail->price}}</td>
                            <td>{{$detail->quantity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h1 class="h3 mb-2 text-gray-800">Total</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-success" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Total sale</th>
                        <th>revenue</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{$quantity}}</td>
                            <td>$ {{$revenue}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
