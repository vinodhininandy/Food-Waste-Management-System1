<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Current Location on Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <link rel="stylesheet" href="../home.css">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
   
      #map-container {
        width: auto;
        height: 300px;
        margin: auto;
        margin: 10px 20px 10px 20px;
        z-index: 2;
      }

      #contain {
        font-family: 'Poppins', sans-serif;
        margin: auto;
        align-items: center;
        text-align: center;
      }

      .nav-bar a {
        background: #06C167;
      }

      @media screen and (max-width: 600px) {
        #map-container {
          height: 200px;
        }
      }
    </style>
</head>
<body>
  <header>
    <div class="logo">Food <b style="color: #06C167;">Donate</b></div>
    <div class="hamburger">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
    <nav class="nav-bar">
      <ul>
        <li><a href="delivery.php">Home</a></li>
        <li><a href="#" class="active">Map</a></li>
        <li><a href="deliverymyord.php">My Orders</a></li>
      </ul>
    </nav>
  </header>
  <br>
  <script>
    document.querySelector(".hamburger").onclick = function() {
      document.querySelector(".nav-bar").classList.toggle("active");
    }
  </script>
  <div id="contain">
    <h3>Current Location</h3>
    <div id="map-container"></div>
    <div id="city-name"></div>
    <div id="address"></div>
    <br>
  </div>

  <script>
    function initMap() {
      var mapContainer = document.getElementById("map-container");
      navigator.geolocation.getCurrentPosition(function(position) {
        var userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        var map = L.map(mapContainer).setView(userLocation, 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
          maxZoom: 18,
          tileSize: 512,
          zoomOffset: -1
        }).addTo(map);

        var marker = L.marker(userLocation).addTo(map);
        marker.bindPopup("<b>You are here!</b>").openPopup();

        var url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" + userLocation.lat + "&lon=" + userLocation.lng;
        fetch(url)
          .then(response => response.json())
          .then(data => {
            var cityName = data.address.city || data.address.town;
            document.getElementById("city-name").innerHTML = "You are in " + cityName;
            document.getElementById("address").innerHTML = `You are at ${data.display_name}`;
          });
      }, function() {
        alert("Error: The Geolocation service failed.");
      });
    }

    document.addEventListener("DOMContentLoaded", initMap);
  </script>
</body>
</html>
