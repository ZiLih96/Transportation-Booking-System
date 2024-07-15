@extends('layouts.user')

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

<h2>History of Trips Booking</h2>

@if ($trips->where('user_id', Auth::id())->count() === 0)
    <p>No booking records found.</p>
@else
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Startpoint</th>
            <th>Destination</th>
            <th>Price</th>
            <th>Start Booking Date</th>
            <th>End Booking Date</th>
            <th>Pickup Time</th>
            <th>Return Time</th>
            <th>Requirement</th>
            <th>Driver Name</th>
            <th>Status</th>
            <th>Reject Reason</th>
            <th>Give Rating after status change to Completed</th>
        </tr>
        @php
            $num = 0;
        @endphp

        @foreach ($trips as $index => $trip)
            @if ($trip->user_id == Auth::id())
                @php
                    $num++;
                @endphp
                <tr>
                    <td>{{ $num }}</td>
                    <td>{{ $trip->startpoint }}</td>
                    <td>{{ $trip->destination }}</td>
                    <td>{{ $trip->money }}</td>
                    <td>{{ $trip->start_date }}</td>
                    <td>{{ $trip->end_date }}</td>
                    <td>{{ $trip->pickup_time }}</td>
                    <td>{{ $trip->return_time }}</td>
                    <td>{{ $trip->requirement }}</td>
                    <td>{{ $trip->driver_name }}</td>
                    <td>{{ $trip->status }}</td>
                    <td>{{ $trip->rejection_reason }}</td>
                    <td>
                        @if($trip->rating === null)
                            @if($trip->status === 'Completed')
                                <form action="{{ route('giveRating', ['trip_id' => $trip->id]) }}" method="POST">
                                    @csrf
                                    <label for="rating">Give Rating (1-5): </label>
                                    <input type="number" id="rating" name="rating" min="1" max="5" required>
                                    <button type="submit">Submit Rating</button>
                                </form>
                            @else
                                <!-- Show a message indicating that rating is not available -->
                                Rating not available
                            @endif
                        @else
                            <!-- Show the rating if it has already been submitted -->
                            {{ $trip->rating }}
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

    <span>
       <p> {{$trips->links()}} </p>
    </span>
@endif
@endsection