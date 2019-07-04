@extends('layout')

@section('style')
    
@endsection

@section('content') 

<div class="container">
    <h2 class="text-center">Login</h2>
</div>

<div class="container">
    <form action="/login" method="post">
        @csrf
        <div class="form-row">
          <label for="phone_number">
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
        @if(Session::has('nomatch'))
        <p>
            {{ Session::get('nomatch')}}
        </p>
        @endif
  
      
        <div class="form-row">
          <button class="custom-button" style="margin-top:20px;">Login</button>
        </div>

        <div class="form-row">
          <p>Don't have an account yet? Please<a href="/register"> register</a>.</p>  
        </div>
      </form>
</div>

<img src="/images/scooter.png" class="fix">
      
@endsection