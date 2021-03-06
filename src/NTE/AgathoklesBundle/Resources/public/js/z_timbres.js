var PUBLIC_KEY = "pk.eyJ1IjoibnRlIiwiYSI6IjNuaWc4XzQifQ.FV_ZIkwWG_gJKP7PIdLuJw";
var MAP_ID = "nte.24c9e767";
var POPUP_OFFSET = new L.Point(0, -15);
var HEADERHEIGHT = 239;
var FOOTERHEIGHT = 80;

var map;
var markerGroup;
var min = 0;
var max = -9999;
var currentFabricant = 0;
var currentEponyme = 0;

$( document ).ready(function() {
    resizeContainer();
    initMinMax();
    initMap();
    initGroup();
    populate();
    postInit();
    initSliders();
    initFilters();
});

$( window ).resize(function() {
    resizeContainer();
});

// MAP FUNCS

function initMinMax() {
    $("#map-data li").each(function( index ) {
        var start = $(this).data("start");
        var end = $(this).data("end");
        min = (start < min) ? start : min;
        max = (end > max) ? end : max;
    });
}

function initMap() {
    map = L.map('map', {maxZoom: 12}).setView([35.69, 18.52], 4);
    L.tileLayer('http://{s}.tiles.mapbox.com/v4/'+MAP_ID+'/{z}/{x}/{y}.png?access_token='+PUBLIC_KEY, {
        minZoom: 3,
        maxZoom: 18
    }).addTo(map);
}

function initGroup() {
    markerGroup = new L.MarkerClusterGroup({ singleMarkerMode: true, spiderfyOnMaxZoom: false, zoomToBoundsOnClick: false });

    // define the click on clusters
    markerGroup.on('clusterclick', function (a) {
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

    map.addLayer(markerGroup);
}

function populate() {

    // first clear the group, in case it's recalled
    markerGroup.clearLayers();

    // create a marker for each timbre
    $("#map-data li").each(function( index ) {
        var title       = $(this).data("title");
        var lat         = $(this).data("lat");
        var lng         = $(this).data("lng");
        var count       = $(this).data("count");
        var start       = $(this).data("start");
        var end         = $(this).data("end");
        var path        = $(this).data("path");
        var fabricant   = $(this).data("fabricant");
        var eponyme     = $(this).data("eponyme");
        // check lat AND lng are set
        if (lat && lng) {
          // check timbre is in the range of dates selected
          if((start >= min && start <= max) || (end >= min && end <= max) || start == "-") {
              if ((currentFabricant == 0 || currentFabricant == fabricant) && (currentEponyme == 0 || currentEponyme == eponyme)) {
                  var marker = L.marker(new L.LatLng(lat, lng));
                  var content = '<h3>'+title+'</h3><p>'+count+' '+pluralize("Timbre", count)+'</p><a href="'+path+'" class="btn btn-info">Afficher '+pluralize("la", count)+' '+pluralize("matrice", count)+' '+pluralize("associée", count)+'</a>';
                  marker.bindPopup(content, {offset: POPUP_OFFSET});
                  markerGroup.addLayer(marker);
              }
          }
        }
    });
}

function postInit() {
    // setview if asked else fitBounds
    var mapData = $("#map-data");
    var lat = mapData.data("lat");
    var lng = mapData.data("lng");

    if (lat && lng) {
        latLngAsked = L.latLng(lat, lng);
        map.setView(latLngAsked, 10);
    } else {
        map.fitBounds(markerGroup.getBounds());
    }
}

function initSliders() {
    var mapSlider = document.getElementById('map-slider');

    noUiSlider.create(mapSlider, {
    	start: [min, max],
        connect: true,
        step: 1,
    	range: {
    		'min': min,
    		'max': max
    	}
    });

    var tipHandles = mapSlider.getElementsByClassName('noUi-handle'),
	tooltips = [];

    // Add divs to the slider handles.
    for ( var i = 0; i < tipHandles.length; i++ ){
    	tooltips[i] = document.createElement('div');
    	tipHandles[i].appendChild(tooltips[i]);
    }

    // Add a class for styling
    tooltips[0].className += 'map-slider-tooltip';
    tooltips[1].className += 'map-slider-tooltip';

    // When the slider changes, write the value to the tooltips.
    mapSlider.noUiSlider.on('update', function( values, handle ) {
    	tooltips[handle].innerHTML = Math.floor(values[handle]);
    });

    mapSlider.noUiSlider.on('set', function() {
        var values = mapSlider.noUiSlider.get();
        min = values[0];
        max = values[1];
        populate();
    });
}

function initFilters() {
    $( ".js-select-fabricant" ).change(function() {
        currentFabricant = $(this).val();
        populate();
    });
    $( ".js-select-eponyme" ).change(function() {
        currentEponyme = $(this).val();
        populate();
    });
}

// HELPERS

function pluralize(word, count) {
    if (word == "la" || word == "le") {
      return count > 1 ? "les" : word;
    }
    return count > 1 ? word+"s" : word;
}

// UTILITY

function resizeContainer() {
    var container = $("#map");

    var windowHeight = $(window).height();
    var mapHeight = windowHeight-HEADERHEIGHT-FOOTERHEIGHT;
    container.height(mapHeight);
    $(".application-footer").css("margin-top", 0);
}
