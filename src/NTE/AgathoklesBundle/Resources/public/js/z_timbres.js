var PUBLIC_KEY = "pk.eyJ1IjoibnRlIiwiYSI6IjNuaWc4XzQifQ.FV_ZIkwWG_gJKP7PIdLuJw";
var MAP_ID = "nte.24c9e767";
var ATTRIBUTION = '<a href="https://www.mapbox.com/about/maps/">&copy; Mapbox &copy; OpenStreetMap</a>'+
    ' | <a href="https://www.mapbox.com/map-feedback/">Improve this map</a> | &copy; Implementation :'+
    ' N. Badoud &amp; <a href="http://www.unifr.ch/nte/">Centre NTE</a> - Université de Fribourg - Suisse';
var POPUP_OFFSET = new L.Point(0, -15);
var HEADERHEIGHT = 235;

$( document ).ready(function() {
    resizeMap();
    var map = initMap();
    var markers = populateMarkers(map);
    setSettings(map, markers);
});

$( window ).resize(function() {
    resizeMap();
});

function resizeMap() {
    var map = $("#map");

    var windowHeight = $(window).height();
    var mapHeight = windowHeight-HEADERHEIGHT;
    map.height(mapHeight);
}

function initMap() {
    var map = L.map('map', {maxZoom: 12}).setView([35.69, 18.52], 4);
    L.tileLayer('http://{s}.tiles.mapbox.com/v4/'+MAP_ID+'/{z}/{x}/{y}.png?access_token='+PUBLIC_KEY, {
        attribution: ATTRIBUTION,
        minZoom: 3,
        maxZoom: 18
    }).addTo(map);
    return map;
}

function populateMarkers(map) {
    // init markercluster
    var markers = new L.MarkerClusterGroup({ singleMarkerMode: true, spiderfyOnMaxZoom: false, zoomToBoundsOnClick: false });
    setEvents(markers, map);

    // create a marker for each timbre
    $("#map-data li").each(function( index ) {
        var title = $(this).data("title");
        var lat = $(this).data("lat");
        var lng = $(this).data("lng");
        var count = $(this).data("count");
        var path = $(this).data("path");
        var marker = L.marker(new L.LatLng(lat, lng));
        var content = '<h3>'+title+'</h3><p>'+count+' '+pluralize("Timbre", count)+'</p><a href="'+path+'" class="btn btn-info">Consulter</a>';
        marker.bindPopup(content, {offset: POPUP_OFFSET});
        markers.addLayer(marker);
    });

    // add markers to map
    map.addLayer(markers);

    return markers;
}

function setSettings(map, markers) {
    // setview if asked else fitBounds
    var mapData = $("#map-data");
    var lat = mapData.data("lat");
    var lng = mapData.data("lng");

    if (lat && lng) {
        latLngAsked = L.latLng(lat, lng);
        map.setView(latLngAsked, 10);
    } else {
        map.fitBounds(markers.getBounds());
    }
}

function setEvents(markers, map) {
    // define the click on clusters
    markers.on('clusterclick', function (a) {
        // prepare vars
        var children = a.layer.getAllChildMarkers();
        var latLngRef = children[0].getLatLng();
        var twins = true;

        // iterate over each child to check if they have all the same latlng
        $.each(children, function( index, child ) {
          if(!child.getLatLng().equals(latLngRef)) {
              twins = false;
          }
        });

        // if they have the same latlng, open popup of first, else zoomToBounds
        if(twins) {
            customPopup = L.popup({offset: POPUP_OFFSET})
                .setLatLng(children[0].getLatLng())
                .setContent(children[0].getPopup().getContent())
                .openOn(map);
        }
        else {
            a.layer.zoomToBounds();
        }
    });
}

function pluralize(word, count) {
    return count > 1 ? word+"s" : word;
}
