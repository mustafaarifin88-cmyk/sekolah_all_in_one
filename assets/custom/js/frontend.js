$(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
        $('.navbar-custom').addClass('fixed-top');
    } else {
        $('.navbar-custom').removeClass('fixed-top');
    }
});

$(document).ready(function() {
    if($('.hero-slider').length > 0) {
        $('.hero-slider').carousel({
            interval: 5000,
            pause: "hover"
        });
    }

    $('#btn-cek-kelulusan').on('click', function(e) {
        e.preventDefault();
        $('#modalKelulusan').modal('show');
    });
});