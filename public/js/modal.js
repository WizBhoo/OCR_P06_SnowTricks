let $addImgButton = $("<button type='button' class='add_link btn btn-dark text-center'>Ajouter une image</button>");
let $addVidButton = $("<button type='button' class='add_link btn btn-dark text-center'>Ajouter une vidéo</button>");
let $newLinkImg = $("<span></span>").append($addImgButton);
let $newLinkVid = $("<span></span>").append($addVidButton);

function printFormErrors(errors) {
    for (let error in errors) {
        if (error !== "images" && error !== "videos") {
            $("#figure_form_" + error).addClass("is-invalid");
            for (let index in errors[error]) {
                $("#figure_form_" + error).after(
                    "<div class='invalid-feedback'>\n" +
                    errors[error][index] +
                    "</div>"
                );
            }
        }
    }
}

function printFormVideosErrors(errors) {
    for (let error in errors) {
        if ("videos" === error) {
            for (let index in errors[error]) {
                $("#figure_form_"+error+"_"+index+"_url").addClass("is-invalid");
                for (let messageIndex in errors[error][index]["url"]) {
                    $("#figure_form_" + error + "_" + index + "_url").after(
                        "<div class='invalid-feedback'>\n" +
                        errors[error][index]["url"][messageIndex] +
                        "</div>"
                    );
                }
            }
        }
    }
}

function printFormImagesErrors(errors) {
    for (let error in errors) {
        if ("images" === error) {
            for (let index in errors[error]) {
                $("#figure_form_"+error+"_"+index+"_file").addClass("is-invalid");
                for (let messageIndex in errors[error][index]["file"]) {
                    $("#figure_form_" + error + "_" + index + "_file").after(
                        '<div class="invalid-feedback">\n' +
                        errors[error][index]["file"][messageIndex] +
                        "</div>"
                    );
                }
            }
        }
    }
}

$(document).ready(function() {
    $("#figureModal").on("change", "[id^=figure_form_images]", function(){
        //get the file name
        let fileName = $(this).val();
        alert(fileName);
        //replace the "Choose a file" label
        $(this).next(".custom-file-label").html(fileName);
    })

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

    $("#figureModal").on("submit", "#fig-form",function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr("action");

        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(".is-invalid").removeClass("is-invalid");
                $(".invalid-feedback").remove();
            },
            success: function(urlFromController) {
                window.location.href = urlFromController;
            },
            error: function(xhr) {
                let errors = JSON.parse(xhr.responseText);
                printFormErrors(errors);
                printFormVideosErrors(errors);
                printFormImagesErrors(errors);
            }
        });
    });
});
