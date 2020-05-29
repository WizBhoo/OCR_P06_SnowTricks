$(document).ready(function() {
    $("#load-media").on("click", function(e){
        e.preventDefault();
        $(".img").removeClass("d-none");
        $(".vid").removeClass("d-none");
        $("#load-media").addClass("d-none");
    });
});
