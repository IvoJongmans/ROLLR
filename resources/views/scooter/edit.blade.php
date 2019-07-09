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
        <form method="POST" action="/admin/scooters/{{$scooter->id}}/update" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
            <label class="label has-text-white">
                IMEI nummer</label>
            <div class="control">
            <input class="input" type="text" placeholder="IMEI number" name="imei" value={{$scooter->imei}} required>
            </div>

            <label class="label has-text-white">
                Brand</label>
            <div class="control">
                <input class="input" type="text" placeholder="Brand name" value={{$scooter->brand}} name="brand" required>

            </div>
            <label class="label has-text-white">
                Tradename</label>
            <div class="control">
                <input class="input" type="text" placeholder="Trade name" name="trade" value={{$scooter->tradename}} required>
            </div>

            <label class="label has-text-white">
                Type</label>
            <div class="control">
                <input class="input" type="text" placeholder="Type" value={{$scooter->type}} name="type" required>
            </div>

            <label class="label has-text-white">
                Serial number</label>
            <div class="control">
                <input class="input" type="text" placeholder="Serial number" name="serial" value={{$scooter->serialnumber}} required>
            </div>
            <div class="control">
                <label class="label has-text-white" for="image">Pictures</label>
                <input type="file" name="image[]" class="form-control" multiple>
            </div>
            
            <div class="control submitbutton">
                <input class="button" value="Submit" type="submit" required>
            </div>
        </form>
            
        </div>
        @if($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="box">
                @foreach($scooter->scooterpictures as $picture)
                <div>
                    <img src={{Storage::url($picture->url)}} width="200px" height="10px">
                <form action='/admin/scooterpicture/{{$picture->id}}/delete' method="POST">
                        @method('delete')
                        @csrf
                        <input class="button" type="submit" value="delete">
                    </form>
                </div>
                   @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1 text-right">
            <form action="/admin/scooters/{{$scooter->id}}/delete" method="POST">
                    @method('delete')
                    @csrf 
                    <input type="submit" class="custom-button" value="delete scooter">
                </form>
                </div>
        </div>
    </div>
</section>

@endsection