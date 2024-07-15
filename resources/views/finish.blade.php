@extends('layouts.user')

@section('content')
    <br><br><br><br>
    <h1 style="  text-align: center;"> Your Booking is Successfully</h1>
    <br>
    <h2 style="  text-align: center;"> Wait for Reply TQ</h2>
    <a href="{{ route('dashboard') }}" style="position: absolute; top: 500px; left: 46.25%;">
        <button class="button">Back to Main Page</button>
    </a>
@endsection

