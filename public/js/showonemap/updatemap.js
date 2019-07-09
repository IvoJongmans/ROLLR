
    markerArray = [];
    
    setInterval(updateMap, 300000);
    /* documentation on the updatemap function:
    Outer foreach loop: runs through the JSON and created the labels and sets them in an Array
    Inner loop: checks for availability and creates icon accordingly
    */
    function updateMap() {
        URL = "/map/retrieveone";
        $.post(URL, {id: scooterid}, function(data){        
            latitude = data['latitude'];
            longitude = data['longitude'];
            var pos = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
            console.log(pos); 
            if (markerArray.length == 0){
            map.setCenter(pos);
            map.setZoom(16);
            }; 

            if (markerArray.length == 0){
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
        }
// END FIRST SETUP OF MARKER
// BEGIN UPDATE SET OF MARKER
else {
  markerArray[0].setPosition(pos);
  console.log(pos); 
  if(data['availability'] == 'free'){
    markerArray[0].setIcon('/step_icon.png');
  }
  // if nr2
  else {markerArray[0].setIcon('/step_icon_notfree.png')};
}




        })
    }
    
          // else nr1 = outer
         
    updateMap();