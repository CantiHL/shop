$(function(){
	$('.add_to_cart').on('click', function(event) {
		event.preventDefault();
		let urlAddToCart=$(this).data('url');

		  $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
	$.ajax({

			url: urlAddToCart,
			type: 'post',
			dataType: 'json',
			data: {
				id: $('#id').val(),
				name: $('#name').val(),
				price: $('#price').val(),
			},
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function(data) {
			console.log("complete");
		});
	});
	
})
