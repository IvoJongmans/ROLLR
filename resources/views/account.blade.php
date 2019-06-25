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

    

@endsection