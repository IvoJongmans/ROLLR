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
      <div class="row">
        <div class="col text-center">
          <a href="/scooter/{{$scooter->id}}/login"><button class="custom-button">Login</button></a>
        </div>
      </div>
      <div class="row">
      	<div class="col text-center">
          <a href="/scooter/{{$scooter->id}}/register"><button class="custom-button">Register</button></a>
        </div>
      </div>
    </div>

    
    <img src="/images/scooter.png" class="fix">
    



    {{-- <div class="container">

      <div class="text-center">
          <h2 text-center>Step Up</h2>
          <p>Scooter ID: {{$scooter->id}}</p>
      </div>

      <form action="/charge" method="post" id="payment-form">
        @csrf
        <div class="form-row">
          <label for="name">
            Name:
          </label>
          <input class="form-control" type="text" name="name" id="name" placeholder="Step Up">
        </div>
        <div class="form-row">
          <label for="email">
            Email:
          </label>
          <input class="form-control" type="text" name="email" id="email" placeholder="scooter@step.com">
        </div>
        <div class="form-row">
          <label for="card-element">
            Credit or debit card
          </label>
          <div id="card-element" class="form-control">
            <!-- A Stripe Element will be inserted here. -->
          </div>
      
          <!-- Used to display form errors. -->
          <div id="card-errors" role="alert"></div>
        </div>

        <!--IS THIS THE RIGHT WAY? -->
        <input type="hidden" name="scooter_id" value="{{$scooter->id}}">
      
        <div class="form-row">
          <button class="btn btn-primary" style="margin-top:20px;">Submit Details</button>
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
      </script> --}}
    
@endsection