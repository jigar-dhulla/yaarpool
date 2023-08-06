<div>
    <div wire:ignore id="map" style="width:800px;height:400px;" x-on:place-selected.window=onPlaceSelected($event.detail.selectedPrediction)></div>
</div>
<script async
    src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&libraries=places&callback=initMap">
</script>
<script>
    /* How to initialize the map */
    let map;
    let userPosition;
    let marker;
    let markers = [];

    async function initMap() {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        function showError(error) {
            console.log('getCurrentPosition returned error', error);
        }
        
        function showPosition(position) {
            userPosition = { "lat": position.coords.latitude, "lng": position.coords.longitude};
            marker = new google.maps.Marker({
                position: userPosition,
                map: map,
                title: 'User Location',
            });
            markers.push(marker);
            map.setCenter(userPosition);
        }

        const position = { lat: {{ $lat }}, lng: {{ $lng }} };

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: position,
            mapId: "ESTABLISHMENT_MAP_ID",
        });

        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: 'Selected Establishment',
        });
        markers.push(marker);
        map.setCenter(position);
    }

    function onPlaceSelected(place){
        userPosition = { "lat": place.geometry.location.lat, "lng": place.geometry.location.lng};
        setMapOnAll(null);
        markers = [];
        marker = new google.maps.Marker({
            position: userPosition,
            map: map,
            title: 'Selected Establishment',
        });
        markers.push(marker);
        map.setCenter(userPosition);
    }

    function removeMarkers(){
        setMapOnAll(null);
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
</script>