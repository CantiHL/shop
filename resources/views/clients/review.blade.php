<div class="recommended_items"><!--comment-->
	<h2 class="title text-center">comment place</h2>
    <div class="container"  style="overflow: scroll; width: auto; height: 355px" >
        @foreach ($reviews as $review)
            <div class="comment col-sm-3">
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <b style="background-color: #33FF66;" class="list-group-item">Name: {{ $review->user->user_name }}</b>
                        <span class="ml-3 list-group-item">Star: {{$review->rating}} <i class="fa fa-star text-danger"></i></span>
                        <textarea class="list-group-item">{{ $review->content }}</textarea>
                        <li class="list-group-item">{{ $review->created_at }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
<br>
@if (session()->has('id'))
	<form action="{{ route('review') }} " method="post">
        <label for="">Star: <i class="fa fa-star text-danger"></i></label>
        <div class="row">
            <div class="col-sm-2">
                <select class="form-control d-inline-block" name="rating" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="product_id" value="{{$product_detail->id}}">
		@csrf
        <label for="">Content: </label>
		<textarea name="rv_content" id="" cols="30" rows="5" placeholder="Type your comment here..."></textarea><br>
		<button style="margin: 10px 0;" class="btn btn-success" type="submit">Leave Comment</button>
	</form>
@endif

