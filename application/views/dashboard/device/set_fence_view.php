
 <style>
    #map {
      height: 300px;
      margin-bottom: 10px;
    }


  </style>

  <div class="container mt-5">
 
    <form id="formAnamnese" method="POST" action="https://eosmdmeuukvndhn.m.pipedream.net">
      <div class="form-group address" >
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" class="form-control" placeholder="Digite o endereço"><br>
        <button type="button" class="btn btn-primary" onclick="geocodeAddress()" style="margin-bottom: 5px;">Procurar Endereço</button>
     
      </div>
      <div class="form-group">
        <label for="localizacaoCerca">Localização da Cerca:</label>
      
        <div id="map"></div>
        <div class="form-group">
          <label for="raioCerca">Raio da Cerca (em metros):</label>
          <input type="range" min="1" max="5000" value="1" class="form-control-range" id="raioCerca" name="raioCerca" oninput="updateCircle(); document.getElementById('rangeValue').innerHTML = this.value;" required>
          <span id="rangeValue">1</span>
        </div>
        <input type="hidden" id="latitudeCerca" name="latitudeCerca" class="location-input" required>
        <input type="hidden" id="longitudeCerca" name="longitudeCerca" class="location-input" required>
      </div>
      <button type="submit" class="btn btn-primary" id="submitBtn">Enviar</button>
    </form>
  </div>


<script>
  var map;
  var marker;
  var circle;

  function openMap() {
    var latitude = parseFloat(document.getElementById('latitudeCerca').value);
    var longitude = parseFloat(document.getElementById('longitudeCerca').value);
    var mapCenter = latitude && longitude ? { lat: latitude, lng: longitude } : { lat: -23.5505, lng: -46.6333 };

    map = new google.maps.Map(document.getElementById('map'), {
      center: mapCenter,
      zoom: 13,
      mapTypeId: 'satellite',
      streetViewControl: false
    });

    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP
    });

    google.maps.event.addListener(marker, 'dragend', function() {
      var position = marker.getPosition();
      document.getElementById('latitudeCerca').value = position.lat();
      document.getElementById('longitudeCerca').value = position.lng();
      updateCircle();
    });

    getCurrentLocation();
  }

  function getCurrentLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var mapCenter = { lat: position.coords.latitude, lng: position.coords.longitude };
        document.getElementById('latitudeCerca').value = mapCenter.lat;
        document.getElementById('longitudeCerca').value = mapCenter.lng;

        map = new google.maps.Map(document.getElementById('map'), {
          center: mapCenter,
          zoom: 13,
          mapTypeId: 'satellite',
          streetViewControl: false
        });

        marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: mapCenter
        });

        google.maps.event.addListener(marker, 'dragend', function() {
          var position = marker.getPosition();
          document.getElementById('latitudeCerca').value = position.lat();
          document.getElementById('longitudeCerca').value = position.lng();
          updateCircle();
        });
      });
    }
  }

  function geocodeAddress() {
    var endereco = document.getElementById('endereco').value;
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({'address': endereco}, function(results, status) {
      if (status === 'OK') {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();

        document.getElementById('latitudeCerca').value = latitude;
        document.getElementById('longitudeCerca').value = longitude;

        map.setCenter(results[0].geometry.location);
        marker.setPosition(results[0].geometry.location);
        updateCircle();
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }

  function updateCircle() {
    var latitude = parseFloat(document.getElementById('latitudeCerca').value);
    var longitude = parseFloat(document.getElementById('longitudeCerca').value);
    var raio = parseFloat(document.getElementById('raioCerca').value);

    if (!isNaN(latitude) && !isNaN(longitude) && !isNaN(raio)) {
      if (circle) {
        circle.setMap(null);
      }

      map.setCenter({ lat: latitude, lng: longitude });

      marker.setPosition({ lat: latitude, lng: longitude });

      circle = new google.maps.Circle({
        strokeColor: '#0000FF',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#0000FF',
        fillOpacity: 0.3,
        map: map,
        center: { lat: latitude, lng: longitude },
        radius: raio
      });
    }
  }

  $(document).ready(function() {
    openMap();
    setTimeout(() => {
      getCurrentLocation();
   
}, "5000");

    $('#formAnamnese').submit(function(e) {
      e.preventDefault();

      $.ajax({
        url: 'https://eosmdmeuukvndhn.m.pipedream.net',
        type: 'post',
        data: $('#formAnamnese').serialize(),
        success: function() {
          alert('Formulário enviado com sucesso!');
        },
        error: function() {
          alert('Ocorreu um erro ao enviar o formulário. Por favor, tente novamente.');
        }
      });
    });
  });
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAXJzoEihWHKDCRPXZAuLyfWK2bDWHa50&callback=openMap"></script>

