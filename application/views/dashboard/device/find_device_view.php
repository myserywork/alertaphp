<!-- Inclua o arquivo JavaScript do Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key=SUA_CHAVE_API&libraries=places"></script>

<style>
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}

#map {
    width: 100%;
    height: 100%;
}
</style>

<div id="map"></div>
<div id="address"></div>

<script>
// Função para obter a localização atual
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

// Função para exibir a posição no mapa
function showPosition(position) {
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var geocoder = new google.maps.Geocoder();

    var mapOptions = {
        zoom: 15
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    var marker = new google.maps.Marker({
        position: latlng,
        map: map
    });

    geocoder.geocode({
        'latLng': latlng
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                document.getElementById('address').innerHTML = 'Endereço: ' + results[0].formatted_address;
            } else {
                console.log('No results found');
            }
        } else {
            console.log('Geocoder failed due to: ' + status);
        }
    });

    // Ajusta o zoom e a posição do mapa com base no marcador
    var bounds = new google.maps.LatLngBounds();
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
}

// Função para ajustar a altura do mapa
function adjustMapHeight() {
    var mapElement = document.getElementById("map");
    var windowHeight = window.innerHeight;
    var mapHeight = windowHeight - mapElement.offsetTop - 40;
    mapElement.style.height = mapHeight + "px";
}

// Chama a função para obter a localização atual
getLocation();

// Ajusta a altura do mapa ao carregar o documento
document.addEventListener("DOMContentLoaded", adjustMapHeight);

// Ajusta a altura do mapa ao redimensionar a janela
window.addEventListener("resize", adjustMapHeight);
</script>