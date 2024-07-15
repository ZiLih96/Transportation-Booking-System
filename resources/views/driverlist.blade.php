@extends('layouts.adminheader')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        form {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #69C3B8;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        .w-5{
            display: none
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
<body>

<h2>List of Driver</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Delete</th>
    </tr>
    @foreach ($drivers as $index => $driver)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{$driver['name']}}</td>
        <td>{{$driver['email']}}</td>
        <td>{{$driver['created_at']}}</td>
        <td>{{$driver['updated_at']}}</td>
        <td> <a href={{"deleteDriver/".$driver['id']}}> Delete </a></td>
    </tr>
    @endforeach
</table>

<span>
   <p> {{$drivers->links()}} </p>
</span>
@endsection