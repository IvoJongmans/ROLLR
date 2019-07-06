@extends('layout')

@section('style')
    
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
          <input class="form-control" type="tel" name="cell_number" id="phone" required style="width:100%">
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
      var input = document.querySelector("#phone"), output = document.querySelector("#output");
      // window.intlTelInput(input);
      var iti = window.intlTelInput(input, {
  nationalMode: true,
  utilsScript: "../../build/js/utils.js?1562189064761" // just for formatting/placeholders etc
});

var handleChange = function() {
  var text = (iti.isValidNumber()) ? "International: " + iti.getNumber() : "Please enter a number below";
  var textNode = document.createTextNode(text);
  output.innerHTML = "";
  output.appendChild(textNode);
};

// listen to "keyup", but also "change" to update when the user selects a country
input.addEventListener('change', handleChange);
input.addEventListener('keyup', handleChange);


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