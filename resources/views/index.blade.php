@extends('layout')

@section('style')

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
            <a class="dropdown-item" href="/login">Login</a>
            <a class="dropdown-item" href="/register">Register</a>            
            </div>
        </div>
        </div>
    </div> 
    
    
@endsection