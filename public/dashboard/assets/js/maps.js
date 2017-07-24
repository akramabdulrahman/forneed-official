// map 
var MapsGoogle = function () {

    var mapMarker = function () {
        var map = new GMaps({
            div: '#gmap_marker',
            lat: 31.428077,
            lng: 34.380341,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        $.get(window.location.origin + '/listings/projects/', function (data) {
            $(data).each(function (i, v) {
                map.addMarker({
                    lat: v.lat,
                    lng: v.lng,
                    title: v.name,
                    infoWindow: {
                        content: v.name
                    }
                });
            });
        })

        map.setZoom(10);

    }


    return {
        //main function to initiate map samples
        init: function () {
            mapMarker();
        }

    };

}();

jQuery(document).ready(function () {
    MapsGoogle.init();
});

