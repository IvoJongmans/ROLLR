@extends('layout')

@section('style')

body {
    color:white;
}

h2 {
    padding: 20px;
}

body {
    background-image: url("/images/scooter_city.png");
    background-size: cover;
    background-repeat: no-repeat;
}
    
@endsection

@section('content')  

    <div class="container">

      <div class="text-center">
          <h2 text-center>Step Up</h2>
          <p>Scooter ID: {{$scooter->id}}</p>
      </div>

      <form action="https://safe-beyond-49098.herokuapp.com/scooter/{{$scooter->id}}/register" method="post" id="payment-form" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
        @csrf
        <div class="form-row">
          <label for="cell_number">
            Cell Phone Number:
          </label>
          <input class="form-control" type="text" name="cell_number" id="cell_number" placeholder="+31612341234" required>
        </div>
        <div class="form-row">
          <label for="password">
            Password:
          </label>
          <input type="password" class="form-control" name="password" id="password" minlength="8" required>
        </div>
        <div class="form-row">
            <label for="confirm_password">
                Confirm Password:
            </label>
                <input type="password" class="form-control" id="confirm_password" minlength="8" required>
        </div>
        <!--IS THIS THE RIGHT WAY? -->
        <input type="hidden" name="scooter_id" value="{{$scooter->id}}">
      
        <div class="form-row">
          <button class="btn btn-primary" style="margin-top:20px;">Submit Details</button>
        </div>
      </form>

    </div>

    <script>

        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
            
    </script>
      
@endsection