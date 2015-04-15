$(function() {
    // initialize Masonry
    var $container = $('.js-masonry').masonry();
    // layout Masonry again after all images have loaded
    $container.imagesLoaded( function() {
      $container.masonry();
    });
});
