<div class="recommended_items"><!--comment-->
	<h2 class="title text-center">comment place</h2>
    <div class="container"  style="overflow: scroll; width: auto; height: 355px" >
        @foreach ($data_comments as $comment)
            <div class="comment col-sm-3">
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <b style="background-color: #33FF66;" class="list-group-item">{{ $comment->user_name }}</b>
                        <textarea class="list-group-item">{{ $comment->comment_content }}</textarea>
                        <li class="list-group-item">{{ $comment->created_at }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
<br>
@if (session()->has('id'))
	<form action="{{ route('comment') }} " method="post">
		@csrf
		<textarea name="comment" id="" cols="30" rows="5" placeholder="Type your comment here..."></textarea><br>
		<button style="margin: 10px 0;" class="btn btn-success" type="submit">Leave Comment</button>
	</form>
@endif

