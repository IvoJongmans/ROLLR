@extends('layout')

@section('style')
  
@endsection

@section('content')

<div class="container">

<div class="text-center">
  <h2 text-center>Verify Account</h2>
</div>

<form action="/retryverifysms" method="post">
@csrf

<div class="form-row">
  <label for="pin">
    SMS code:
  </label>
  <input type="password" class="form-control" name="pin" id="pin" minlength="4" required>
</div>             

<div class="form-row">
  <button class="custom-button" style="margin-top:20px;">Verify</button>
</div>
</form>

<div class="form-row">
      <p>Didn't receive an SMS? Try again <a href="/account"> later</a>.</p>  
</div>

</div>

<img src="/images/scooter.png" class="fix">

@endsection