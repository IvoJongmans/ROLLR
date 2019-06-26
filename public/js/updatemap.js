
    markerArray = [];
    
    setInterval(updateMap, 300000);
    /* documentation on the updatemap function:
    Outer foreach loop: runs through the JSON and created the labels and sets them in an Array
    Inner loop: checks for availability and creates icon accordingly
    */
    function updateMap() {
        URL = "/map/retrieve";
        $.post(URL, undefined, function(data){
            // numbers the last scooter for the setpos
            indexLastScooter = data.length - 1;
            console.log(indexLastScooter);  
            $.each(data, function(index, value){
            console.log(index);
            // If nr 1 = outer
            if (markerArray.length == index){           
            latitude = value['latitude'];
            longitude = value['longitude'];
            console.log(latitude);
            console.log(longitude); 
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
            // center on last scooter (untested)
            if(indexLastScooter == index){ 
              map.setCenter(pos);
            };
            // If nr 2 = inner
            if (value['availability'] == 'free'){
            markerArray[index] = new google.maps.Marker({
              position: pos,
              map: map,
              title: `${value['id']}`,
              label: {
              color: "yellow",
              fontSize: "20px",
              fontWeight: "bold",
              text: `${value['id']}`, 
            },
            icon: '/step_icon.png',
            });
          }
          // else nr 2
          else {
            markerArray[index] = new google.maps.Marker({
              position: pos,
              map: map,
              title: `${value['id']}`,
              label: {
              color: "yellow",
              fontSize: "20px",
              fontWeight: "bold",
              text: `${value['id']}`,
            },
            icon: '/step_icon_notfree.png',
            });
          }
          }
          // else nr1 = outer
          else {
            latitude = value['latitude'];
            longitude = value['longitude'];
            console.log('the latitude is' + latitude);
            console.log('the longitude is' + longitude); 
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
          // if nr2
        if(value['availability'] == 'free'){
          markerArray[index].setIcon('/step_icon.png');
        }
        // if nr2
        else {'/step_icon_notfree.png'};
        markerArray[index].setPosition(pos);
            }
            google.maps.event.addListener(markerArray[index], 'click', function() {
              window.location.href = `/scooter/${value['id']}`
          });
        });
      })
    }
    updateMap();  

