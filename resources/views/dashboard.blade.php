@extends('layout')

@section('style')

body {
  color:white;
  background-color: #001B2B;
}

h2 {
  padding: 20px;
}

button {
  margin-top:25px;
}

.custom-button{
background:    #001b2b;
border:        4px solid #fb7612;
border-radius: 5px;
padding:       8px 20px;
color:         #ffffff;
display:       inline-block;
text-align:    center;
min-width:     150px;
}

.fix {
position: absolute;
top: 90%;
left: 50%;
width: 90px;
height: 90px;
margin-top: -45px; /* Half the height */
margin-left: -45px; /* Half the width */
}

.dropdown-toggle:after { content: none }

.hamburger {
  height:25px;
  width: 25px;  
}

.hamburger-button {
  background:    #001b2b;
  border:        4px solid #fb7612;
  border-radius: 5px;
  padding:       8px 20px;
  color:         #ffffff;        
  text-align:    center;  
  margin:        10px;
  }

.align-vertical {
  line-height: 30px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: red;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
#map {
  height: 200px;
  width: 200px;
}
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-6 text-left"><h2 class="align-vertical">ROLLR</h2></div>
    <div class="col-6 text-right">
      <button type="button" class="hamburger-button dropdown-toggle" data-toggle="dropdown">
          <img src="/images/hamburger.png" class="hamburger">
      </button>
      
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#">Billing History</a>
        <a class="dropdown-item" href="#">Routes</a>
        <a class="dropdown-item" href="{{ route('logout', compact('scooter')) }}">Logout</a>
      </div>
    </div>
  </div>
</div>


    <div class="container text-right">
      {{-- <button href="{{ route('logout', compact('scooter')) }}"><button class="custom-button">Logout</button></button> --}}
      {{-- <h2 class="text-center">Welcome to ROLLR</h2> --}}
      {{-- <p class="text-center">{{$user->cell_number}}</p> --}}
    </div>

    @if($user->cc_validated == "no")

    <div class="container">
        <form action="/scooter/{{$scooter->id}}/user/{{$user->id}}/cc_verify" method="post" id="payment-form">
            @csrf        
            <div class="form-row">
              <label for="card-element">
                Credit or debit card
              </label>
              <div id="card-element" class="form-control">
                <!-- A Stripe Element will be inserted here. -->
              </div>    
            </div>  
            <div class="form-row">
              <button class="custom-button" style="margin-top:20px;">Submit Details</button>
            </div>
          </form>
    </div>
    
    

    <script>

            // Create a Stripe client.
            var stripe = Stripe('pk_test_9GgUgNx8TfFAFPLEQWW5P4Hw00qF0wNQYJ');
            
            // Create an instance of Elements.
            var elements = stripe.elements();
            
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };
            
            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});
            
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });
            
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();
            
              stripe.createToken(card).then(function(result) {
                if (result.error) {
                  // Inform the user if there was an error.
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;
                } else {
                  // Send the token to your server.
                  stripeTokenHandler(result.token);
                }
              });
            });
            
            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);
            
              // Submit the form
              form.submit();
            }           
      </script>

    @endif

    @if($user->cc_validated == "yes" && $user->user_validated == "yes")

    <div class="container text-center">
      <p class="text-center">Scooter ID: {{$scooter->id}}</p>
    	<label class="switch">
          <input type="checkbox" id="checkbox">
          <span class="slider"></span>
        </label>
        <h2 id="timer" class="text-center"><span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span></h2>
    </div>

    <div class="container d-flex justify-content-center">
        <div id="map">
          
        </div>
    </div>

    @endif

    <div class="container" id="trip_json">
    
    </div>   

    <script>
      var seconds = 0;
      var minutes = 0;
      var hours = 0;
      var trip_id = '';
      $('#checkbox').click(function(){
        // console.log($('#checkbox').prop('checked'));
        if($('#checkbox').prop('checked') == true) {
          $.ajax({
            type: "get",
            url: "/scooter/{{$scooter->id}}/user/{{$user->id}}/starttrip",
            success:function(data)
            {
                
                trip_id = data;
                
            }
          });
          var interval = setInterval(function(){
            seconds++;
            if(seconds <= 9) {
              $('#seconds').html('0' + seconds);
            }
            else {
              $('#seconds').html(seconds); 
            }
            if(minutes <= 9) {
              $('#minutes').html('0' + minutes);
            }
            else {
              $('#minutes').html(minutes); 
            }
            
            if(hours <= 9) {
              $('#hours').html('0' + hours);
            }
            else {
              $('#hours').html(hours); 
            }
            
            // $('#seconds').html(seconds);  
            // $('#minutes').html(minutes);  
            // $('#hours').html(hours);  

            if(seconds == 59) {
              seconds = -1;
              minutes++;

              if(minutes == 60) { 
                minutes = 0;               
                hours++
              }
            }    
          
            if ($('#checkbox').prop('checked') == false){
              $.ajax({
            type: "get",
            url: "/scooter/{{$scooter->id}}/user/{{$user->id}}/stoptrip/"+ trip_id,
            success:function(data)
            {
              $('#trip_json').html(`<p class="text-center">Time: ${data['time']} seconds.</p>
                                    <p class="text-center">Cost: €${data['amount']}.</p>`);
            }
          });
            $('#checkbox').attr("disabled", true);
            clearInterval(interval);
            }
          }, 1000);          
        }
      });
    </script>
    <script>
        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.
        var map, infoWindow;
  
        function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 53.214902, lng: 6.564738},
            zoom: 17
          });
          infoWindow = new google.maps.InfoWindow;
          // map.setCenter(pos);
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
          submitdata = {id: 1};
          $.post(URL, submitdata, function(data){
              latitude = data['lat'],
              longitude = data['lng']
              console.log(latitude);
              console.log(longitude); 
              var pos = {
                  lat: parseFloat(latitude),
                  lng: parseFloat(longitude)
              }
          console.log(pos);
          // map.setCenter(pos);
          infoWindow.setPosition(pos);
          infoWindow.setContent('Scooter location');
          infoWindow.open(map); 
          }); 
          // number++; 
          // console.log(number);
        }
      </script>
    <img src="/images/scooter.png" class="fix">
    
@endsection