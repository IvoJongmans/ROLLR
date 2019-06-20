<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 53.214902, lng: 6.564738},
          zoom: 15
        });
        infoWindow = new google.maps.InfoWindow;
      };

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ACuBSISEBf6cm57NPd7FQalB66VV3-s&callback=initMap"
    async defer></script>
    <script>
    setInterval(updateMap, 2000);
    function updateMap() {
        URL = "/map/retrieve";
        // data send to server
        submitdata = {id: 1};

        //data retrieve from server, post ajax call
        $.post(URL, submitdata, function(data){
            scooterid = data['id'],
            latitude = data['lat'],
            longitude = data['lng']
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            }
        console.log(pos);
        console.log(scooterid);
        // map.setCenter(pos);
        infoWindow.setPosition(pos);
        infoWindow.setContent('Scooter location');
        infoWindow.open(map); 
        }); 
      }
    </script>
    
  </body>
</html>