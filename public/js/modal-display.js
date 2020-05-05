$(document).ready(function(){
    $(".show-modal").on("click", function(){
        $.ajax({
            url: $(this).attr("href"),
            type: "get",
            success(response) {
                // Add response in Modal body
                $(".modal-content").html(response);
                // Display Modal
                $("#empModal").modal("show");
            }
        });
    });
});
