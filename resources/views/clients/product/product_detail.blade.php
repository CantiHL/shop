@extends('layouts.basic_layout')
@section('content')
<div class="product-detail-content container">
    <div class="row">
        <div class="col-sm-12 padding-right">
            @foreach($data as $product_detail)
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-4">
                        <div class="view-product">
                            <img src="{{asset('assets/img/products/'.$product_detail->image)}}" alt=""/>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <form action="" method="post">
                            @csrf
                            <div class="product-information"><!--/product-information-->
                                <h2>Product Name: {{$product_detail->name}}</h2>
                                <input type="hidden" name="product_id" value="{{$product_detail->id}}">
                                <span>
									<span>Price: ${{number_format($product_detail->price,'0','','.')}}</span>
									<a data-url="{{ route('add_to_cart',['id'=>$product_detail->id]) }}"
                                       class="btn btn-fefault cart add-to-cart add_to_cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</a>
								</span>
                                <p><b>Brand:</b> {{$product_detail->brand->name}}</p>
                                <p><b>Category:</b> {{$product_detail->category->name}}</p>
                                <p><b>Created_at:</b>{{$product_detail->created_at}}</p>
                                <p><b>Quantity:</b>{{$product_detail->quantity}}</p>
                                <p>
                                    @if($product_detail->averageRating() != null)
                                        <b>{{$product_detail->averageRating()}}</b> <i class="fa fa-star text-danger">
                                            ({{$product_detail->countRating()}})</i>
                                    @else
                                        ? <i class="fa fa-star text-danger"></i>
                                    @endif
                                </p>
                                <label>Description: </label>
                                <textarea readonly name="" id="" cols="30"
                                          rows="5">{{$product_detail->description}}</textarea>
                            </div><!--/product-information-->
                        </form>
                    </div>
                </div><!--/product-details-->
            @endforeach
        </div>
    </div>
</div>
<div class="container">
    @include('clients.review')
</div>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.add_to_cart').on('click', function (event) {
            event.preventDefault();
            let url = $(this).data('url');
            alert('Add to cacrt success');
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
            })
                .done(function () {
                    console.log("success");
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });

        });
    });
</script>
@endsection
