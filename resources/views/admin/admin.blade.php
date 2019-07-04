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
            <h2>Admin Panel</h2>
        </div>
    </div>
  <div class="container"> 
    <a href="/admin/users">
      <div class="custom-button">
        Users section
      </div>
    </a>
    <a href="/admin/scooters">
      <div class="custom-button">
        Scooters section
      </div>
    </a>
    <a href="/account">
      <div class="custom-button">
        Proceed to User environment >>
      </div>
    </a>
  </div>

@endsection