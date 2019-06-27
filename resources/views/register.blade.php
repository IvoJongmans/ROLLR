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

img {
position: absolute;
top: 90%;
left: 50%;
width: 90px;
height: 90px;
margin-top: -45px; /* Half the height */
margin-left: -45px; /* Half the width */
}
    
@endsection

@section('content')  

    <div class="container">

      <div class="text-center">
          <h2 text-center>ROLLR</h2>
      </div>

      <form action="/register" method="post" id="payment-form" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
        @csrf
        <p style="margin-bottom: 8px;">
          Cell Phone Number:
        </p>
        <div class="form-row">         
          <input class="form-control" type="tel" name="cell_number" id="phone" placeholder="+31612341234" required style="width:100%">
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
      
        <div class="form-row">
          <button class="custom-button" style="margin-top:20px;">Submit Details</button>
        </div>
      </form>

    </div>

    <img src="/images/scooter.png" class="fix">

    <script src="js/intlTelInput.js"></script>

    <script>
      var input = document.querySelector("#phone");
      window.intlTelInput(input);
    </script>

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