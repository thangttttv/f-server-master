var shapes = [];

function initMap() {
    var circle;
    var userLocations = $('#user-locations').val();
    userLocations = (JSON.parse(userLocations));
    var center = {lat: 21.0134330, lng: 105.7944520};
    var areaLocations = $('#area-locations').val();
    areaLocations = (JSON.parse(areaLocations));
    var map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 12
    });
    var bounds = new google.maps.LatLngBounds();
    var i;
    for (i = 0; i < areaLocations[0].length; i++) {
        bounds.extend(areaLocations[0][i]);
    }
    map.setCenter(bounds.getCenter());
    for(var il = 0; il < userLocations.length; il++){

        var polygonShape = new google.maps.Polygon({
            map: map,
            paths: areaLocations[il],
            strokeColor: '#ffff00',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#ffff00',
            fillOpacity: 0.35
        });
    }


    for (i = 0; i < userLocations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(userLocations[i]['lat'], userLocations[i]['lng']),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(userLocations[i]['time']);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }


}
