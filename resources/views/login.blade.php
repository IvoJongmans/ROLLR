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
    <h2 class="text-center">Login</h2>
</div>

<div class="container">
    <form action="/scooter/{{$scooter->id}}/login" method="post">
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
    
        <input type="hidden" name="scooter_id" value="{{$scooter->id}}">
      
        <div class="form-row">
          <button class="btn btn-primary" style="margin-top:20px;">Login</button>
        </div>
      </form>
</div>

      
@endsection