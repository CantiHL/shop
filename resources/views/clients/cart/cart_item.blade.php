@extends('layouts.basic_layout')
@section('content')
    <section id="cart_items">
        @if(session()->has('message'))
            <h3 class="text-error text-center text-danger">{{session()->get('message')}}</h3>
        @endif
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td>Num</td>
                        <td class="image">Image</td>
                        <td class="image">Name</td>
                        <td class="description">Price</td>
                        <td class="price">Quantity</td>
                        <td class="price">Total</td>
                        <td class="quantity">Action</td>
                    </tr>
                    </thead>
                    @php
                        $subtotal=0;
                        $i=1;
                    @endphp
                    <tbody>
                    @if ($cartItem)
                        @foreach($cartItem as $cart)
                            @php
                                $subtotal+=$cart['price']*$cart['quantity'];
                            @endphp
                            <form action="{{ route('update_cart_item') }}" method="post">
                                <input type="hidden" name="id" id="id" value="{{ $cart['id'] }}">
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a href=""><img width="150" height="100" src="{{asset('assets/img/products/'.$cart['image'])}}" alt=""></a>
                                    </td>
                                    <td >
                                        <b>{{ $cart['name'] }}</b>
                                    </td>
                                    <td >
                                        <p>${{ number_format($cart['price'],'0','','.') }}</p>
                                    </td>
                                    <td >
                                        <input name="quantity" id="quantity" type="number" min="1" value="{{ $cart['quantity'] }}">
                                    </td>
                                    <td >
                                        <p>${{ number_format($cart['price']*$cart['quantity'],'0','','.') }}</p>
                                    </td>
                                    @csrf
                                    <td >
                                        <button type="submit" class="btn btn-success">Update</button>  |
                                        <a href="{{ route('delete_item_cart',['id'=>$cart['id']]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    @endif
                    @if (session('message_success'))
                        <h2 class="alert-success text-center">{{ session('message_success') }}</h2>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    @if (!empty(session('cart')))
        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="total_area">
                            <ul>
                                <li>SubTotal: <span>${{ number_format($subtotal,'0','','.') }}</span></li>
                            </ul>
                            <form action="{{ route('checkout') }} " method="post">
                                @csrf
                                <input type="hidden" name="amount" value="{{$subtotal}}">
                                @if (empty(session()->has('id')))
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                        <input required type="email" class="form-control" name="cus_email" id="email" placeholder="Email Address">
                                        <p class="alert-danger">@error('cus_email') {{ $message }} @enderror</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Full Name</label>
                                        <input required type="text" class="form-control" name="cus_name" id="inputName" placeholder="Full Name">
                                        <p class="alert-danger">@error('cus_name') {{ $message }} @enderror</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPhone">Phone</label>
                                        <input required type="text" class="form-control" name="cus_phone" id="inputPhone" placeholder="Phone Number">
                                        <p class="alert-danger">@error('cus_phone') {{ $message }} @enderror</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">Address</label>
                                        <input required type="text" class="form-control" name="cus_address" id="inputAddress" placeholder="Commune-District-City">
                                        <p class="alert-danger">@error('cus_address') {{ $message }} @enderror</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Note">Note(Optional)</label>
                                        <input type="text" name="note" class="form-control" id="Note">
                                    </div>
                                @else
                                    <div class="form-group col-md-12">
                                        <label for="Note">Note(Optional)</label>
                                        <input type="text" name="note" class="form-control" id="Note">
                                    </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <label class="text-success" for="payment_method">Payment method</label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        @foreach($paymethods as $paymethod)
                                            <option value="{{$paymethod->value}}">{{$paymethod->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-block btn-default check_out" href="">Check Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    @endif
@endsection

