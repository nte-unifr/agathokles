$(function() {

    // initialize Masonry
    $("#fiches-masonry").masonry();

    // little hack to hide timbres label of lieu select filter
    $("label[for='filter_fiches_timbres_0_lieu']").hide();
});
