$(document).ready(function() {
    $("#load-media").on("click", function(e){
    //$(document).on("click", "#load-media", function(e) {
        e.preventDefault();
        $(".img").removeClass("d-none");
        $(".vid").removeClass("d-none");
        $("#load-media").addClass("d-none");
    });
});
