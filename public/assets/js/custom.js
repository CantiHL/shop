var slides = document.getElementsByClassName('slide');
var currentSlide = 0;
var slideInterval = setInterval(nextSlide, 3000); // Auto-next-slide interval in milliseconds

function showSlide(n) {
for (var i = 0; i < slides.length; i++) {
slides[i].style.display = 'none';
}
slides[n].style.display = 'block';
}

function nextSlide() {
currentSlide = (currentSlide + 1) % slides.length;
showSlide(currentSlide);
}

function previousSlide() {
currentSlide = (currentSlide - 1 + slides.length) % slides.length;
showSlide(currentSlide);
}

function restartSlideInterval() {
clearInterval(slideInterval);
slideInterval = setInterval(nextSlide, 2000);
}

// Add event listeners for mouseenter and mouseleave to pause and play the auto-next-slide functionality
document.addEventListener('mouseenter', function () {
clearInterval(slideInterval);
});

document.addEventListener('mouseleave', function () {
restartSlideInterval();
});

// Show the first slide initially
showSlide(currentSlide);

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.add_to_cart').on('click', function(event) {
        event.preventDefault();
        let url=$(this).data('url');
        alert('Add to cart success');
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
        })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    });
});
