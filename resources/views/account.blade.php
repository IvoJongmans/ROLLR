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
  
  .fix {
  position: absolute;
  top: 90%;
  left: 50%;
  width: 90px;
  height: 90px;
  margin-top: -45px; /* Half the height */
  margin-left: -45px; /* Half the width */
  }
  
  .dropdown-toggle:after { content: none }
  
  .hamburger {
    height:25px;
    width: 25px;  
  }
  
  .hamburger-button {
    background:    #001b2b;
    border:        4px solid #fb7612;
    border-radius: 5px;
    padding:       8px 20px;
    color:         #ffffff;        
    text-align:    center;  
    margin:        10px;
    }
@endsection

@section('content') 

    <div class="container">
        <div class="row">
        <div class="col-6 text-left my-auto"><img src="/images/rollr_logo.png" style="height:50px;"></div>
        <div class="col-6 text-right">
            <button type="button" class="hamburger-button dropdown-toggle" data-toggle="dropdown">
                <img src="/images/hamburger.png" class="hamburger">
            </button>
            
            <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Billing History</a>
            <a class="dropdown-item" href="#">Routes</a>
            <a class="dropdown-item" href="/logout">Logout</a>
            </div>
        </div>
        </div>
    </div> 
    
    <div class="container">
        <div class="text-center">
            <h2>Account Details</h2>
        </div>
    </div>

    <p class="text-center">Cell number: {{Auth::user()->cell_number}}</p><br/>
    
    @if(Auth::user()->user_validated == 'yes' && Auth::user()->cc_validated == 'no')
    <div class="text-center">
        Please add a creditcard: <a href="/creditcard"><button class="custom-button" style="margin-top:20px;">Add Creditcard</button></a>
    </div>
    @endif

    @if(Auth::user()->cc_validated == "yes" && Session::has('scooter'))
        <div class="text-center">
            <a href="scooter/{{Session::get('scooter')->id}}"><button class="custom-button" style="margin-top:20px;">Start Trip on scooter {{Session::get('scooter')->id}} </button></a>
        </div> 
    
    
    @endif
    
   

<img src="/images/scooter.png" class="fix">

@endsection