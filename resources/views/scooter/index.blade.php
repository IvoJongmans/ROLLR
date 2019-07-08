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
{{-- Nav & logo --}}
<div class="container">
        <div class="row">
        <div class="col-12 text-right">
            <a href="/admin/scooters/create">
                <div class="custom-button">Add Scooter+</div>
            </a>
        </div>
        </div>
</div> 

{{-- index --}}
    <table class="table is-bordered is-striped is-hoverable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Accu GPS</th>
                <th>IMEI</th>
                <th>View Scooter</th>
                <th>Thumbnails</th>
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
                    <td>
                        {{$scooter->imei}}
                    </td>
                    <td>
                        <a href="/admin/scooters/{{$scooter->id}}"><button class="button is-black">Show detailed info & location</button></a>
                    </td>
                    <td>
                       @foreach($scooter->scooterpictures as $picture)
                    <img src={{Storage::url($picture->url)}} width="40px" height="10px">
                       @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
