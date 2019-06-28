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
                <h2 text-center>Verify Account</h2>
            </div>
      
            <form action="/verifysmslogin" method="post">
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