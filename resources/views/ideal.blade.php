@extends('layout')

@section('style')

@endsection

@section('content')

<div class="container">
    <form action="/ideal" method="post" id="payment-form">
    @csrf
    <div class="form-row flex-column">
        <label for="amount">
        Amount:
        </label>
        <input name="amount" id="amount">
    </div>

    <div class="form-row flex-column">
        <label for="ideal-bank-element">
        iDEAL Bank
        </label>
        <div id="ideal-bank-element">
        <!-- A Stripe Element will be inserted here. -->
        </div>
    </div>

    <button class="custom-button">Submit Payment</button>

    <!-- Used to display form errors. -->
    <div id="error-message" role="alert"></div>
    </form>

</div>

<script>

var stripe = Stripe('{{env('STRIPE_KEY')}}');

// Create an instance of Elements.
var elements = stripe.elements();

var options = {
  // Custom styling can be passed to options when creating an Element.
  style: {
    base: {
      // Add your base input styles here. For example:
      fontSize: '16px',
      color: '#32325d',
      padding: '10px 12px',
    },
  }
}

// Create an instance of the idealBank Element.
var idealBank = elements.create('idealBank', options);

// Add an instance of the idealBank Element into
// the `ideal-bank-element` <div>.
idealBank.mount('#ideal-bank-element');

idealBank.on('change', function(event) {
  var bank = event.value;
  // Perform any additional logic here...
});

// Create a source or display an error when the form is submitted.
var form = document.getElementById('payment-form');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  var sourceData = {
    type: 'ideal',
    amount: document.querySelector('input[name="amount"]').value * 100,
    currency: 'eur',
    owner: {
      name: '{{$stripe_id}}',
    },
    // Specify the URL to which the customer should be redirected
    // after paying.
    redirect: {
      return_url: 'https://app.rollr.nl/account',
    },
  };

  // Call `stripe.createSource` with the idealBank Element and
  // additional options.
  stripe.createSource(idealBank, sourceData).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('error-message');
      errorElement.textContent = error.message;
    } else {
      // Redirect the customer to the authorization URL.
      stripeSourceHandler(result.source);
    }
  });
});

function stripeSourceHandler(source) {
  // Redirect the customer to the authorization URL.
  document.location.href = source.redirect.url;
}
</script>

@endsection