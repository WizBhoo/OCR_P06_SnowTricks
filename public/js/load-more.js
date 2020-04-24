$(document).ready(function() {
    let limit = 15;
    $(".card").slice(0, limit).removeClass("d-none");
    $("#load-more").on("click",function(e){
        limit += 15;
        e.preventDefault();
        $(".card").slice(0, limit).removeClass("d-none");
        $(".scroll-up").removeClass("d-none");
    });
});
