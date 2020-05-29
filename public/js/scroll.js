$(function() {
    $("a[href=\"#scroll-anchor\"]").on("click", function(e) {
        e.preventDefault();
        $("html, body").animate(
            { scrollTop: $("#scroll-anchor").offset().top - $("nav").height() },
            1000,
            "linear"
        );
    });
});
