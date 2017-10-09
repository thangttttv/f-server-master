var shapes = [];

function initMap() {
    var circle;

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 12
    });

    var bounds = new google.maps.LatLngBounds();
    var i;
    var currentLocationData = $('#location_data').val();
    if(currentLocationData == ''){
        var currentLocations = '';
    }else{
        var currentLocations = JSON.parse(currentLocationData);
    }


    for (i = 0; i < currentLocations.length; i++) {
        bounds.extend(currentLocations[i]);
    }

    console.log(bounds.getCenter());
    if(currentLocations != ''){
        map.setCenter(bounds.getCenter());
        var polygonShape = new google.maps.Polygon({
            editable: true,
            map: map,
            paths: currentLocations,
            strokeColor: '#ffff00',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#ffff00',
            fillOpacity: 0.35,
            draggable: true
        });
        google.maps.event.addListener(polygonShape.getPath(), 'set_at', changePolygon);
    }else{
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(initialLocation);
            });
        }
    }

    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
        },

        polygonOptions: {
            fillColor: '#fff000',
            fillOpacity: 0.2,
            strokeWeight: 5,
            editable: true,
            draggable: true,
            zIndex: 1
        }
    });

    drawingManager.setMap(map);
    //google.maps.event.addListener(drawingManager, 'circlecomplete', onCircleComplete);
    google.maps.event.addListener(drawingManager, 'polygoncomplete', onPolygonComplete);
    google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
        var newShape = event.overlay;
        newShape.type = event.type;console.log(newShape.type);
        if(newShape.type == 'polygon'){
            shapes.push(newShape);
            if (drawingManager.getDrawingMode()) {
                drawingManager.setDrawingMode(null);
            }
        }

    });
    google.maps.event.addListener(drawingManager, "drawingmode_changed", function () {
        if (drawingManager.getDrawingMode() != null) {
            for (var i = 0; i < shapes.length; i++) {
                shapes[i].setMap(null);
                $('#location_data').val(null);
            }
            shapes = [];
        }
    });
    function onPolygonComplete(shape) {
        shape = shape.getPath();
        var coordinates = (shape.getArray());

        $('#location_data').val(JSON.stringify(coordinates));
        google.maps.event.addListener(shape, 'set_at', changePolygon);

    }

    function onCircleComplete(shape) {
        if (shape == null || (!(shape instanceof google.maps.Circle))) return;

        if (circle != null) {
            circle.setMap(null);
            circle = null;
        }

        circle = shape;
        $("#latitude").val(circle.getCenter().lat());
        $("#longitude").val(circle.getCenter().lng());
        $("#radius").val(circle.getRadius());
        google.maps.event.addListener(circle, 'radius_changed', changeShape);
        google.maps.event.addListener(circle, 'center_changed', changeShape);

    }

    function changeShape() {
        $("#latitude").val(this.getCenter().lat());
        $("#longitude").val(this.getCenter().lng());
        $("#radius").val(this.getRadius());
    }

    function changePolygon() {
        var coordinates = (this.getArray());

        $('#location_data').val(JSON.stringify(coordinates));
    }

}
