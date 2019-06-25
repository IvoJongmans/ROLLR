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
          <a href="/register">Register</a>
        </div>
      </form>
</div>

<img src="/images/scooter.png" class="fix">
      
@endsection