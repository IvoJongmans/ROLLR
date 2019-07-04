@extends('layout')

@section('style')

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