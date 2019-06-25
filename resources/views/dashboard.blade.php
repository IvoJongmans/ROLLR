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

{{-- This can be a substitute for the logo --}}
{{-- .align-vertical {
  line-height: 30px;
}
<h2 class="align-vertical">ROLLR</h2> --}}

.switch {
  position: relative;
  display: inline-block;
  width: 120px;
  height: 68px;
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
  height: 52px;
  width: 52px;
  left: 8px;
  bottom: 8px;
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
  -webkit-transform: translateX(52px);
  -ms-transform: translateX(52px);
  transform: translateX(52px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-6 text-left my-auto"><img src="/images/rollr_logo.png" style="height:50px;"></div>
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

    

    <div class="container text-center">
      <p class="text-center" style="font-size:25px;">Scooter ID: {{$scooter->id}}</p>
    	<label class="switch">
          <input type="checkbox" id="checkbox">
          <span class="slider"></span>
        </label>
        <h2 id="timer" class="text-center"><span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span></h2>
    </div>


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
            url: "/scooter/{{$scooter->id}}/starttrip",
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
            url: "/scooter/{{$scooter->id}}/stoptrip/"+ trip_id,
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
   
    <img src="/images/scooter.png" class="fix">
    
@endsection