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
{{-- map --}}

<div id="map"></div>
<script src="{{asset('js/adminmap/initmap.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ACuBSISEBf6cm57NPd7FQalB66VV3-s&callback=initMap"
async defer></script>
<script src="{{asset('js/adminmap/updatemap.js')}}"></script>


{{-- index --}}
    <table class="table is-bordered is-striped is-hoverable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>IMEI</th>
                <th>View Scooter</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scooters as $scooter)
                <tr>
                    <td>
                        {{$scooter->id}}
                    </td>
                    <td>
                        {{$scooter->availability}}
                    </td>
                    <td>
                        {{$scooter->imei}}
                    </td>
                    <td>
                        <a href="/admin/scooter/{{$scooter->id}}"><button class="button is-black">Show info & location</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
