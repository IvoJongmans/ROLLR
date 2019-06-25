@extends('layout')

@section('style')
    
@endsection

@section('content')
    
    Account <br/>

    {{Auth::user()->id}} <br/>
    {{Auth::user()->user_validated}} <br/>
    {{Auth::user()->cc_validated}} <a href="/creditcard">ADD CC</a> <br/>
    {{Session::get('scooter')->id}}

@endsection