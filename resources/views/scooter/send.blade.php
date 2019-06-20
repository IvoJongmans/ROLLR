<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
  </head>
  <body>
    <script>
        if (navigator.geolocation) {
          navigator.geolocation.watchPosition(function(position) {
            var lat = position.coords.latitude; 
            var lng = position.coords.longitude;
            console.log(lat);
            console.log(lng);
          }, function() {
            handleLocationError(true);
          },
          {
            enableHighAccuracy: true,
            timeout: 2000,
            maximumAge: 3000,
          }
          );
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        };

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      }
    </script>
  </body>
</html>