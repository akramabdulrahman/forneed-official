var google;
function map_recenter(map, latlng, offsetx, offsety) {
    console.log(map.getProjection());
    var point1 = map.getProjection().fromLatLngToPoint(
        (latlng instanceof google.maps.LatLng) ? latlng : map.getCenter()
    );
    var point2 = new google.maps.Point(
        ( (typeof(offsetx) == 'number' ? offsetx : 0) / Math.pow(2, map.getZoom()) ) || 0,
        ( (typeof(offsety) == 'number' ? offsety : 0) / Math.pow(2, map.getZoom()) ) || 0
    );
    map.setCenter(map.getProjection().fromPointToLatLng(new google.maps.Point(
        point1.x - point2.x,
        point1.y + point2.y
    )));
}
function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    // var myLatlng = new google.maps.LatLng(40.71751, -73.990922);
    var myLatlng = new google.maps.LatLng(31.3546763, 34.30882550000001);


    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 12,

        // The latitude and longitude to center the map (always required)
        center: myLatlng,
        draggable: false,
        keyboardShortcuts: false,
        disableDefaultUI: true,

        // How you would like to style the map.
        scrollwheel: false,
        styles: [{
            "featureType": "administrative.land_parcel",
            "elementType": "all",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "landscape.man_made",
            "elementType": "all",
            "stylers": [{"visibility": "off"}]
        }, {"featureType": "poi", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {
            "featureType": "road",
            "elementType": "labels",
            "stylers": [{"visibility": "simplified"}, {"lightness": 20}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [{"hue": "#f49935"}]
        }, {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [{"visibility": "simplified"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [{"hue": "#fad959"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "labels",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [{"visibility": "simplified"}]
        }, {
            "featureType": "road.local",
            "elementType": "labels",
            "stylers": [{"visibility": "simplified"}]
        }, {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "water",
            "elementType": "all",
            "stylers": [{"hue": "#a1cdfc"}, {"saturation": 30}, {"lightness": 49}]
        }]
    };


    // Get the HTML DOM element that will contain your map
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using out element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);

    google.maps.event.addListenerOnce(map, "projection_changed", function () {
       // map_recenter(map, myLatlng, -250, 0);
    });
    new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: 'images/loc.png'
    });


    function geo_success(position) {

      //  map_recenter(map, new google.maps.LatLng(position.coords.latitude, position.coords.longitude), -250, 0);
        map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
        new google.maps.Marker({
            position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            map: map,
            icon: 'images/loc.png'
        });
    }

    function geo_error(e) {
        console.log(e);
    }

    var geo_options = {
        enableHighAccuracy: true,
        maximumAge: 30000,
        timeout: 27000
    };

    var wpid = navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);


}
google.maps.event.addDomListener(window, 'load', init);