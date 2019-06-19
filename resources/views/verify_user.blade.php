@extends('layout')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@endsection

@section('style')

body {
    color:white;
    background-color: #001B2B;
}

h2 {
    padding: 20px;
}

body {
    background-image: url("/images/scooter_city.png");
    background-size: cover;
    background-repeat: no-repeat;
}

.spin-center {
        position: absolute;
      top: 50%;
      left: 50%;
      width: 30px;
      height: 30px;
      margin-top: -15px; /* Half the height */
      margin-left: -15px; /* Half the width */
}

img {
    position: absolute;
    top: 90%;
    left: 50%;
    width: 90px;
    height: 90px;
    margin-top: -45px; /* Half the height */
    margin-left: -45px; /* Half the width */
  }

@endsection

@section('content')      

<div class="container text-center spin-center">
        <i class="fas fa-spinner fa-spin fa-lg"></i>
</div>

<img src="/images/scooter.png" class="fix">

<script>
    setInterval(function()
    {
        $.ajax({
            type: "get",
            url: "/verify/{{$user->id}}",
            success:function(data)
            {
                // if(data == 'user validated') {
                    window.location = '/scooter/{{$scooter->id}}/user/{{$user->id}}';
                // }
            }
        });
    }, 3000); 
</script>

@endsection