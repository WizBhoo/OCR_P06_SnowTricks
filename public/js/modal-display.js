$(document).ready(function(){
    $(".show-modal").on("click", function(){
        $.ajax({
            url: $(this).attr("href"),
            type: "GET",
            dataType: "html",
            success(response) {
                // Add response in Modal body
                $(".modal-content").html(response);
                // Display Modal
                $("#figureModal").modal();
            }
        });
    });

    $(".new-modal").on("click", function(){
        $.ajax({
            url: $(this).attr("href"),
            type: "GET",
            dataType: "html",
            success(response) {
                // Add response in Modal body
                $(".modal-content").html(response);
                // Display Modal
                $("#figureModal").modal();
            }
        });
    });
});
