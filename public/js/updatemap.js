
    markerArray = [];
    
    setInterval(updateMap, 300000);
    function updateMap() {
        URL = "/map/retrieve";
        $.post(URL, undefined, function(data){
            $.each(data, function(index, value){
            console.log(index); 
            if (markerArray.length == index){           
            latitude = value['latitude'];
            longitude = value['longitude'];
            console.log(latitude);
            console.log(longitude); 
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
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
          else {
            latitude = value['latitude'];
            longitude = value['longitude'];
            console.log('the latitude is' + latitude);
            console.log('the longitude is' + longitude); 
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
        if(value['availability'] == 'free'){
          markerArray[index].setIcon('/step_icon.png');
        }
        else {'/step_icon_notfree.png'};
        markerArray[index].setPosition(pos);
            }
        });
      })
    }
    updateMap();  

