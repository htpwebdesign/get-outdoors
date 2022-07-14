jQuery(document).ready(function( $ ) {
    /**
    * initMap
    *
    * Renders a Google Map onto the selected jQuery element
    *
    * @date 22/10/19
    * @since 5.8.6
    *
    * @param jQuery $el The jQuery element.
    * @return object The map instance.
    */
    function initMap( $el ) {
        // Find marker elements within map.
        var $markers = $el.find('.marker');
        // Create gerenic map.
        var mapArgs = {
            zoom : $el.data('zoom') || 13.75,
            mapTypeId : google.maps.MapTypeId.ROADMAP,
            styles : [
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#c6eed9"
                        },
                        {
                            "weight": "0.30"
                        },
                        {
                            "saturation": "-75"
                        },
                        {
                            "lightness": "5"
                        },
                        {
                            "gamma": "1"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#c6eed9"
                        },
                        {
                            "saturation": "-75"
                        },
                        {
                            "lightness": "5"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#587767"
                        },
                        {
                            "visibility": "on"
                        },
                        {
                            "weight": "6"
                        },
                        {
                            "saturation": "0"
                        },
                        {
                            "lightness": "0"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#e6007e"
                        },
                        {
                            "weight": "1"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#587767"
                        },
                        {
                            "saturation": "0"
                        },
                        {
                            "lightness": "0"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#c6eed9"
                        },
                        {
                            "visibility": "simplified"
                        },
                        {
                            "saturation": "-75"
                        },
                        {
                            "lightness": "5"
                        },
                        {
                            "gamma": "1"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#587767"
                        },
                        {
                            "weight": 8
                        },
                        {
                            "saturation": "0"
                        },
                        {
                            "lightness": "0"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#c6eed9"
                        },
                        {
                            "weight": 8
                        },
                        {
                            "lightness": "5"
                        },
                        {
                            "gamma": "1"
                        },
                        {
                            "saturation": "-75"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#c6eed9"
                        },
                        {
                            "saturation": "-75"
                        },
                        {
                            "lightness": "5"
                        },
                        {
                            "gamma": "1"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#c6eed9"
                        },
                        {
                            "saturation": "-75"
                        },
                        {
                            "lightness": "5"
                        },
                        {
                            "gamma": "1"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#587767"
                        },
                        {
                            "saturation": "0"
                        },
                        {
                            "lightness": "0"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                }
            ]
        };
        var map = new google.maps.Map( $el[0], mapArgs );
        // Add markers.
        map.markers = [];
        $markers.each(function(){
            initMarker( $(this), map );
        });
        // Center map based on markers.
        centerMap( map );
        // Return map instance.
        return map;
    }
    /**
    * initMarker
    *
    * Creates a marker for the given jQuery element and map.
    *
    * @date 22/10/19
    * @since 5.8.6
    *
    * @param jQuery $el The jQuery element.
    * @param object The map instance.
    * @return object The marker instance.
    */
    function initMarker( $marker, map ) {
        // Get position from marker.
        var lat = $marker.data('lat');
        var lng = $marker.data('lng');
        var latLng = {
            lat: parseFloat( lat ),
            lng: parseFloat( lng )
        };
        // Create marker instance.
        var marker = new google.maps.Marker({
            position : latLng,
            map: map
        });
        // Append to reference for later use.
        map.markers.push( marker );
        // If marker contains HTML, add it to an infoWindow.
        if( $marker.html() ){
            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });
            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }
    /**
    * centerMap
    *
    * Centers the map showing all markers in view.
    *
    * @date 22/10/19
    * @since 5.8.6
    *
    * @param object The map instance.
    * @return void
    */
    function centerMap( map ) {
        // Create map boundaries from all map markers.
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function( marker ){
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
            });
        });
        // Case: Single marker.
        if( map.markers.length == 1 ){
            map.setCenter( bounds.getCenter() );
        // Case: Multiple markers.
        } else{
            map.fitBounds( bounds );
        }
    }
    // Render maps on page load.
    $(document).ready(function(){
        $('.acf-map').each(function(){
            var map = initMap( $(this) );
        });
    });
});