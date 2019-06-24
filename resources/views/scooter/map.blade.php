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
      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 53.214902, lng: 6.564738},
          zoom: 17
        });
        // infoWindow = new google.maps.InfoWindow;
      };

      function handleLocationError(browserHasGeolocation, infoWindow) {
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      };
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ACuBSISEBf6cm57NPd7FQalB66VV3-s&callback=initMap"
    async defer></script>

    <script>
    infoWindowArray = [];
    
    setInterval(updateMap, 2000);
    function updateMap() {
        URL = "/map/retrieve";
        $.post(URL, undefined, function(data){
            $.each(data, function(index, value){
            console.log(index); 
            if (infoWindowArray.length == index){ 
            
            latitude = value['latitude'];
            longitude = value['longitude'];
            console.log(latitude);
            console.log(longitude); 
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
            infoWindowArray[index] = new google.maps.Marker({
            position: pos,
            map: map,
            title: `Scooter ${index + 1}`,
            label: `${index + 1}`,
            });
        
        // infoWindowArray[index].setPosition(pos);
        // // infoWindowArray[index].title(`scooter location ${index + 1}`);
        // infoWindowArray[index].open(map); 
          }
          else {
            latitude = value['latitude'];
            longitude = value['longitude'];
            console.log('the latitude is' + latitude);
            console.log('the longitude is' + longitude); 
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            }
        infoWindowArray[index].setPosition(pos);
            }
            
        });
      })
    } 
    </script>
    











  </body>
</html>