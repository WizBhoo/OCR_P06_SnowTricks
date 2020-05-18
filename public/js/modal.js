$(document).ready(function(){
    $(".show-modal, .new-modal, .update-modal").on("click", function(){
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

    $("#fig-form").submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            success: function(data)
            {
                if(!data.success) {
                    let innerHTML = $(data).find('#fig-form').html();
                    $('#fig-form').html(innerHTML);
                } else {
                    //Submit Ok
                }
            }
        });
    });
});
