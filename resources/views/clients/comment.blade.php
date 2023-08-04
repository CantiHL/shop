<div class="recommended_items"><!--comment-->
	<h2 class="title text-center">comment place</h2>
	@foreach ($data_comments as $comment)
			<div class="col-sm-3">
		<div class="card" style="width: 18rem;">
				<ul class="list-group list-group-flush">
						<b class="list-group-item">{{ $comment->user_name }}</b>
						<li class="list-group-item">{{ $comment->comment_content }}</li>
						<li class="list-group-item">{{ $comment->created_at }}</li>
				</ul>
		</div>
	</div>
	@endforeach
</div><!--/recommended_items-->
<p>{{ $data_comments->links()}}</p>
<br>
@if (session()->has('id'))
	<form action="{{ route('comment') }} " method="post">
		@csrf
		<textarea name="comment" id="" cols="30" rows="5" placeholder="Type your comment here..."></textarea><br>
		<button style="margin-top: 10px" class="btn btn-success" type="submit">Leave Comment</button>
	</form>
@endif


