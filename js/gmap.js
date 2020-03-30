(function( $ ) {

  /**
   * initMap
   *
   * Renders a Google Map onto the selected jQuery element
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @return  object The map instance.
   */
  function initMap( $el ) {
  
      // Find marker elements within map.
      var $markers = $el.find('.map__marker');
  
      // Create gerenic map.
      var mapArgs = {
        zoom        : $el.data('zoom') || 14,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        mapTypeControl : false,
        streetViewControl: false,
        fullscreenControl: false,
        styles: [
            {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#706a7e"
                    },
                    {
                        "lightness": "0"
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#cc897d"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#1d126b"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#1d126b"
                    },
                    {
                        "lightness": "0"
                    },
                    {
                        "gamma": "1.00"
                    },
                    {
                        "weight": "1.00"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#594f8f"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#26196b"
                    },
                    {
                        "lightness": "0"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#cc897d"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#64436b"
                    },
                    {
                        "lightness": "0"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#462f6b"
                    },
                    {
                        "lightness": "0"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#cc897d"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#523d6b"
                    },
                    {
                        "lightness": "0"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#cc897d"
                    },
                    {
                        "lightness": "0"
                    },
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#3c3273"
                    },
                    {
                        "lightness": "0"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#443d77"
                    },
                    {
                        "lightness": "0"
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
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @param   object The map instance.
   * @return  object The marker instance.
   */
  function initMarker( $marker, map ) {
  
      // Get position from marker.
      var lat = $marker.data('lat');
      var lng = $marker.data('lng');
      var latLng = {
          lat: parseFloat( lat ),
          lng: parseFloat( lng )
      };

      var markerIcon = `${themeUri}/img/marker.png`;
  
      // Create marker instance.
      var marker = new google.maps.Marker({
          position : latLng,
          map: map,
          icon: markerIcon
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
          // google.maps.event.addListener(marker, 'click', function() {
              infowindow.open( map, marker );
          // });
      }
  }
  
  /**
   * centerMap
   *
   * Centers the map showing all markers in view.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   object The map instance.
   * @return  void
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
      $('.map').each(function(){
          var map = initMap( $(this) );
      });
  });
  
})(jQuery);