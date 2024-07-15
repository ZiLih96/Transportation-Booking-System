@extends('layouts.user')

@section('content')
<div class="container">
    <br>
    <h1 style="text-align: center;">Welcome!</h1>

    <div style="text-align: center;">
        <img src="{{ asset('images/dashboard-pic1.png') }}" alt="Image 1" style="width: 250px; margin-right: 180px;">
        <img src="{{ asset('images/dashboard-pic2.png') }}" alt="Image 2" style="width: 250px;">
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('trip') }}"><button class="button" style="width: 120px; margin-right: 350px;">WHERE TO GO</button></a>
        <a href="{{ route('driver_application') }}"><button class="button" style="width: 120px;">TO BE DRIVER</button></a>
    </div>
</div>
@endsection
