<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script>
        if (navigator.geolocation) {
          navigator.geolocation.watchPosition(function(position) {
            var lat = position.coords.latitude; 
            var lng = position.coords.longitude;
            var URL = "/map/storelocation"; 
            var data = {
                latitude: lat,
                longitude: lng,
            }; 
            document.write(lat);
            document.write(lng);
            $.post(URL, data, 
            function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
             });
          }, function() {
            handleLocationError(true);
          },
          {
            enableHighAccuracy: true,
            timeout: 1000,
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