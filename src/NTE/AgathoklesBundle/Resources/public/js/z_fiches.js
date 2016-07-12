/* global $ */

$(document).ready(function () {
  // index
  if ($('#fiches').length) {
    // little hack to hide timbres label of lieu select filter
    $("label[for='filter_fiches_timbres_0_lieu']").hide()
    $('[data-toggle="tooltip"]').tooltip()
  }

  // show
  if ($('#fiche').length) {
    $('#fiche').imagesLoaded(function () {
      $('.masonry-grid').masonry({
        // options
        itemSelector: '.masonry-grid-item',
        columnWidth: '.masonry-grid-sizer',
        percentPosition: true,
        gutter: 10
      })
    })
  }
})
