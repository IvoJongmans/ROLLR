@extends('layout')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@endsection

@section('style')

body {
    color:white;
}

h2 {
    padding: 20px;
}

body {
    background-image: url("/images/scooter_city.png");
    background-size: cover;
    background-repeat: no-repeat;
}

@endsection

@section('content')      

<div class="container text-center">
        <i class="fas fa-spinner fa-spin fa-lg"></i>
</div>

<script>
    setInterval(function()
    {
        $.ajax({
            type: "get",
            url: "/verify/{{$user->id}}",
            success:function(data)
            {
                
                window.location = '/scooter/{{$scooter->id}}/user/{{$user->id}}';
                
            }
        });
    }, 3000); 
</script>

@endsection