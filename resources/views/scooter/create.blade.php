@extends('layout')
@section('head')
<link rel="stylesheet" type="text/css" href={{asset('css/admin.css')}}>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
@endsection

@section('content')
{{-- Nav & logo --}}
<div class="container">
    <div class="row">
    <div class="col-6 text-left my-auto"><img src="/images/rollr_logo.png" style="height:50px;"></div>
    <div class="col-6 text-right">
        <a href="/admin">
            <div class="custom-button"> Admin Panel</div>
        </a>
    </div>
    </div>
</div> 

{{-- Create Scooter Form --}}
<section class="section">
    <div class="container">
        <div class="field">
          <label class="label has-text-white">
        IMEI nummer</label>
          <div class="control">
            <input class="input" type="text" placeholder="Text input">
          </div>

          <label class="label has-text-white">
            Name</label>
              <div class="control">
                <input class="input" type="text" placeholder="Text input">
              </div>

        </div>
    </div>
</section>
@endsection