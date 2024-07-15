@extends('layouts.user')

@section('content')
    <br><br><br><br>
    <h1 style="  text-align: center;"> Thanks for Your application <br><br>
    Your application will be approve as soon as possible </h1>
    <br>
    <a href="{{ route('dashboard') }}" style="position: absolute; top: 500px; left: 46.25%;">
        <button class="button">Back to Main Page</button>
    </a>
@endsection

