
    markerArray = [];
    
    setInterval(updateMap, 300000);
    /* documentation on the updatemap function:
    Outer foreach loop: runs through the JSON and created the labels and sets them in an Array
    Inner loop: checks for availability and creates icon accordingly
    */
    function updateMap() {
        URL = "/map/retrieveone";
        console.log(`the scooter id is ${scooterid}`);
        $.post(URL, {id: scooterid}, function(data){
            // numbers the last scooter for the setpos
            // If nr 1 = outer           
            latitude = data['latitude'];
            longitude = data['longitude'];
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
            map.setCenter(pos);
            map.setZoom(15);
            // If nr 2 = inner
            if (data['availability'] == 'free'){
            markerArray[0] = new google.maps.Marker({
              position: pos,
              map: map,
              title: `${data['id']}`,
              label: {
              color: "yellow",
              fontSize: "20px",
              fontWeight: "bold",
              text: `${data['id']}`, 
            },
            icon: '/step_icon.png',
            });
          }
          // else nr 2
          else {
            markerArray[0] = new google.maps.Marker({
              position: pos,
              map: map,
              title: `${data['id']}`,
              label: {
              color: "yellow",
              fontSize: "20px",
              fontWeight: "bold",
              text: `${data['id']}`,
            },
            icon: '/step_icon_notfree.png',
          })}
        })
    }
    
          // else nr1 = outer
         
    updateMap();