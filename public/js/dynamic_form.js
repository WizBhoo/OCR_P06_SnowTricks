let $addImgButton = $("<button type='button' class='add_link btn btn-dark text-center'>Ajouter une image</button>");
let $addVidButton = $("<button type='button' class='add_link btn btn-dark text-center'>Ajouter une vidéo</button>");
let $newLinkImg = $("<span></span>").append($addImgButton);
let $newLinkVid = $("<span></span>").append($addVidButton);

$(document).ready(function() {
    // Get the div that holds the collection of images and videos
    let $collectionHolderImg = $("div.images-form");
    let $collectionHolderVid = $("div.videos-form");

    function addImgFormDeleteLink($imgFormSpan) {
        let $removeFormButton = $("<div class='text-right'><button type='button' class='btn btn-warning mb-3'>Supprimer Image</button></div>");
        $imgFormSpan.append($removeFormButton);

        $removeFormButton.on("click", function(e) {
            $imgFormSpan.remove();
        });
    }

    function addImgForm($collectionHolderImg, $newLink) {
        let prototype = $collectionHolderImg.data("prototype");

        let index = $collectionHolderImg.data("index");

        let newForm = prototype;
        // You need this only if you didn't set 'label' => false in your images field in FigureFormType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolderImg.data("index", index + 1);

        // Display the form in the page in a span, before the "Add an image" link span
        let $newFormSpan = $("<span></span>").append(newForm);
        $newLink.before($newFormSpan);

        addImgFormDeleteLink($newFormSpan);
    }

    function addVidFormDeleteLink($vidFormSpan) {
        let $removeFormButton = $("<button type='button' class='btn btn-warning mr-3'>Supprimer Vidéo</button>");
        $vidFormSpan.append($removeFormButton);

        $removeFormButton.on("click", function(e) {
            $vidFormSpan.remove();
        });
    }

    // Same for videos
    function addVidForm($collectionHolderVid, $newLink) {
        let prototype = $collectionHolderVid.data("prototype");
        let index = $collectionHolderVid.data("index");
        let newForm = prototype;

        newForm = newForm.replace(/__name__/g, index);
        $collectionHolderVid.data("index", index + 1);

        let $newFormSpan = $("<span></span>").append(newForm);
        $newLink.before($newFormSpan);

        addVidFormDeleteLink($newFormSpan);
    }

    $collectionHolderImg.find(".img-form").each(function() {
        addImgFormDeleteLink($(this));
    });
    $collectionHolderVid.find("span").each(function() {
        addVidFormDeleteLink($(this));
    });

    // add the anchor and span to the images and videos div
    $collectionHolderImg.append($newLinkImg);
    $collectionHolderVid.append($newLinkVid);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolderImg.data("index", $collectionHolderImg.find("input").length);
    $collectionHolderVid.data("index", $collectionHolderVid.find("input").length);

    $addImgButton.on("click", function(e) {
        // add a new image form (see previous code block)
        addImgForm($collectionHolderImg, $newLinkImg);
    });

    $addVidButton.on("click", function(e) {
        addVidForm($collectionHolderVid, $newLinkVid);
    });
});
