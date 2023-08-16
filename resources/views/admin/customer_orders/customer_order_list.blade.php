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
                            <th>Customer Information</th>
                            <th>Note</th>
                            <th>Pay method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>
                                    @php $i=1; @endphp
                                    @foreach($order->id_product as $product_order_id)
                                        @foreach($products as $product)
                                            @if($product->id==$product_order_id)
                                                Product {{$i}} Name: <strong>{{$product->product_name}}</strong><br>
                                                Product price: <strong>{{$product->product_price}}</strong><br>
                                            @endif
                                        @endforeach
                                        @php $i++; @endphp
                                    @endforeach
                                    @php $i=1; @endphp
                                    @foreach($order->quantity as $quantity)
                                            Quantity product {{$i}} : <strong>{{$quantity}}</strong><br>
                                        @php $i++; @endphp
                                    @endforeach
                                    Total: <strong>{{$order->total}}</strong>
                                </td>
                                <td>
                                    Customer Name: <strong>{{$order->name}}</strong><br>
                                    Customer Phone: <strong>{{$order->phone}}</strong><br>
                                    Customer Address: <strong>{{$order->address}}</strong><br>
                                </td>
                                <td>{{$order->note}}</td>
                                <td>
                                    @foreach($payments as $payment)
                                        @if($payment->order_id==$order->id)
                                            Pay Method: Paypal <br>
                                            Payment Id: {{$payment->payment_id}} <br>
                                            payer Email: {{$payment->payer_email}} <br>
                                            Amount: {{$payment->amount}} <br>
                                            Payment Status: {{$payment->payment_status}} <br>
                                            Created At: {{$payment->created_at}} <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{route('update_order')}}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <select class="form-control-sm"  name="status" id="status">
                                            <option selected value=""</option>
                                            <option value="preparing">preparing</option>
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
