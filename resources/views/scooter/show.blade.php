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
<script>
    var scooterid = {{$scooter->id}} ; 
</script>
<script src="{{asset('js/showonemap/initmap.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ACuBSISEBf6cm57NPd7FQalB66VV3-s&callback=initMap" async
    defer></script>
<script src="{{asset('js/showonemap/updatemap.js')}}"></script>
{{-- nav --}}
<div class="container">
    <div class="row">
        <div class="col-2 text-right">
            <a href="/admin/scooters">
                <div class="custom-button">Back to overview</div>
            </a>
        </div>
        <div class="col-4 text-right">
            <a href="/admin/scooters/{{$scooter->id}}/edit">
                <div class="custom-button">Edit Scooter</div>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <table class="table is-bordered is-striped is-hoverable">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{$scooter->id}}</td>
            </tr>
            <tr>
                <th>IMEI</th>
                <td>{{$scooter->imei}}</td>
            </tr>
            <tr>
                <th>Brand</th>
                <td>{{$scooter->brand}}</td>
            </tr>
            <tr>
                <th>Tradename</th>
                <td>{{$scooter->tradename}}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{$scooter->type}}</td>
            </tr>
            <tr>
                <th>Serialnumber</th>
                <td>{{$scooter->serialnumber}}</td>
            </tr>
            <tr>
                <th>BatteryStatus</th>
                <td>
                    @switch($scooter->battery)
                    @case(0)
                    <div id="batteryempty">Empty</div>
                    @break
                    @case(1)
                    <div id="batteryempty">Empty</div>
                    @break
                    @case(2)
                    <div id="batterylow">Low</div>
                    @break
                    @case(3)
                    <div id="batterymid">Mid</div>
                    @break
                    @case(4)
                    <div id="batteryhigh">High</div>
                    @break
                    @case(5)
                    <div id="batteryfull">Full</div>
                    @break
                    @case(6)
                    <div id="batteryfull">Full</div>
                    @break
                    @endswitch
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="container">
    @foreach($scooter->scooterpictures as $picture)
    <a href="{{Storage::url($picture->url)}}"><img src={{Storage::url($picture->url)}} width="200px" height="10px"></a>
    @endforeach
</div>


@endsection