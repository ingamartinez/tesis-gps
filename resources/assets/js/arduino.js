
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

function geo_success(position) {
    do_something(position.coords.latitude, position.coords.longitude);
}

function geo_error() {
    alert("Sorry, no position available.");
}

var geo_options = {
    enableHighAccuracy: true,
    maximumAge        : 30000,
    timeout           : 27000
};

var map;
var escallonVilla = {lat: 10.3910485, lng: -75.47942569999998};
var position;
var wpid;
var marker;

$(document).ready(function() {
    map = new google.maps.Map(document.getElementById('map'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 14,
        // center: {lat: lat, lng: long}
    });

    marker = new google.maps.Marker({
        // position: {lat: lat, lng: long},
        animation: google.maps.Animation.DROP,
        map: map
    });

    wpid = navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);

});

Echo.channel('rfid')
    .listen('CapturarRfid', (e) => {
        populateTable();

        console.log(e);

    });

function do_something(lat, long) {
    marker.setPosition({lat: lat, lng: long});
    map.panTo({lat: lat, lng: long})

}