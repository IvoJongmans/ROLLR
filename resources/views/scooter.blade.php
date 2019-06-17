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

    {{-- <div class="container">

            <div class="text-center">
                <h2 text-center>Step Up</h2>
                <p>Scooter ID: {{$scooter->id}}</p>
            </div>

            <form action="/">

              <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" id="name" placeholder="Step Up" name="name">
              </div>

              <div class="form-group">
                <label for="cc">Creditcard Number:</label>
                <input type="text" class="form-control" id="cc" placeholder="1234 1234 1234 1234" name="cc">
              </div>

              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
              </div>

              <button type="submit" class="btn btn-primary">Let's go!</button>

            </form>

    </div> --}}

    <form action="/charge" method="post" id="payment-form">
        <div class="form-row">
          <label for="card-element">
            Credit or debit card
          </label>
          <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
          </div>
      
          <!-- Used to display Element errors. -->
          <div id="card-errors" role="alert"></div>
        </div>
      
        <button>Submit Payment</button>
      </form>
    
@endsection