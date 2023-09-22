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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Order</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-danger" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Information</th>
                            <th>Information</th>
                            <th>Note</th>
                            <th>Payment</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>
                                    <p>ID: {{$order->product->id}}</p>
                                    <p>Name: {{$order->product->name}}</p>
                                    <p>price: ${{$order->product->price}}</p>
                                    <p>Quantity : {{$order->quantity}}</p>
                                </td>
                                <td>
                                    <p>Name: {{$order->name}}</p>
                                    <p>Phone: {{$order->phone}}</p>
                                    <p>Address: {{$order->address}}</p>
                                </td>
                                <td>{{$order->note}}</td>
                                <td>
                                    @if(isset($order->payment->payment_id))
                                       <p>Pay Method: Paypal</p>
                                       <p>Payment Id: {{$order->payment->payment_id}}</p>
                                       <p>payer Email: {{$order->payment->payer_email}} </p>
                                       <p>Amount: ${{$order->payment->amount}} </p>
                                       <p>Payment Status: {{$order->payment->payment_status}}</p>
                                       <p>Created At: {{$order->payment->created_at}}</p>
                                    @else
                                        pay wnen recive
                                    @endif
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <form action="{{route('update_order')}}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <select class="form-control-sm"  name="status" id="status">
                                            <option selected value="{{$order->status}}">{{$order->status}}</option>
                                            <option value="pending">pending</option>
                                            <option value="delivering">delivering</option>
                                            <option value="done">done</option>
                                        </select>
                                </td>
                                <td>
                                            <button class="btn btn-success btn-sm btn-block" type="submit">Update</button>
                                        </form>
                                    <a class="btn btn-danger btn-sm btn-block" href="{{ route('delete_order',['id'=>$order->id]) }}">Delete</a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
