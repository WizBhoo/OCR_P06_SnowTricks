$(document).ready(function() {
    $(".img-form-path").each(function() {
        let cur = $(this).prev();
        cur.children(".form-group").children(".custom-file").children(".custom-file-label").html($(this).html());
    });
});
