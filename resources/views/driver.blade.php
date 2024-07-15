@extends('layouts.driverheader')

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

<h2>List of Trip Bookings</h3>

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
        <th>Status</th>
        <th>Action</th>
    </tr>
    @php
        $num = 0;
    @endphp
    @foreach ($trips as $index => $trip)
        @if ($trip->status != 'Completed')
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
                <td>{{ $trip->status }}</td>
                <td>
                    <a href="{{ route('acceptTrip', $trip->id) }}">Accept</a>
                    <a href="#" class="reject-btn" data-trip-id="{{ $trip->id }}">Reject</a>
                    <div class="reason-input" style="display: none;">
                        <form action="{{ route('rejectTrip', $trip->id) }}" method="POST">
                            @csrf
                            <label for="reason{{ $trip->id }}">Reason for Rejection:</label>
                            <textarea id="reason{{ $trip->id }}" name="reason" required></textarea><br><br>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                    <a href="{{ route('completeTrip', $trip->id) }}">Complete</a>
                </td>
            </tr>
        @endif
    @endforeach

</table>

<span>
   <p> {{$trips->links()}} </p>
</span>

<script>
    document.querySelectorAll('.reject-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var reasonInput = this.nextElementSibling;
            reasonInput.style.display = 'block';
        });
    });
</script>
@endsection