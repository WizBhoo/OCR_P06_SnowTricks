$(document).ready(function() {
    let limitComment = 4;
    $(".comment").slice(0, limitComment).removeClass("d-none");
    $("#load-comment").on("click", function(e) {
        limitComment += 10;
        e.preventDefault();
        $(".comment").slice(0, limitComment).removeClass("d-none");
    });
});
