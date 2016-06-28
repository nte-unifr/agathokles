/* global $ */

function resizeImgContainer () {
  var img = $('#fiches img').first()
  var height = img.height()
  $('#fiches .img-placeholder').height(height)
}

$(document).ready(function () {
  // little hack to hide timbres label of lieu select filter
  $("label[for='filter_fiches_timbres_0_lieu']").hide()

  $('#fiches').imagesLoaded(function () {
    resizeImgContainer()
  })

  $('[data-toggle="tooltip"]').tooltip()
})
