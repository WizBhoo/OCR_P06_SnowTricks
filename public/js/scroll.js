$(function() {
    $('a[href="#part02"]').on('click', function(e) {
        e.preventDefault();
        $("html, body").animate(
            { scrollTop: $("#part02").offset().top - $("nav").height() },
            1000,
            'linear'
        );
    });
});
