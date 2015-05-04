$(function() {
    resizeMap();
});

$( window ).resize(function() {
    resizeMap();
});

function resizeMap() {
    var map = $("#map");
    var HEADERHEIGHT = 120;

    var windowHeight = $(window).height();
    var mapHeight = windowHeight-HEADERHEIGHT;
    map.height(mapHeight);
}
