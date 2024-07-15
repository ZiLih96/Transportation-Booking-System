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

<h2>List of Driver's Application</h2>

@if ($applications->isEmpty())
<br><br><br><br><br><br><br><br><br><br>
    <h2>No applications available.</h2>
@else
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>All Document Requested</th>
            <th>Vehicle Model</th>
            <th>Working Experience</th>
            <th>Age</th>
            <th colspan="2" style="text-align: center;">Options</th>
        </tr>
        @foreach ($applications as $index => $application)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $application->name }}</td>
                <td>{{ $application->email }}</td>
                <td>{{ $application->phone }}</td>
                <td style="text-align: center;"><button onclick="openPopup('{{ $application->profile_picture }}', '{{ $application->driving_license_front }}', '{{ $application->driving_license_back }}', '{{ $application->ic_front }}', '{{ $application->ic_back }}', '{{ $application->vehicle_pictures }}')">View Pictures</button></td>
                <td>{{ $application->vehicle_model }}</td>
                <td>{{ $application->working_experience }}</td>
                <td>{{ $application->age }}</td>
                <td>
                    <a href="{{ route('approveApplication', $application->id) }}">Approve</a>
                </td>
                <td>
                    <a href="{{ route('deleteApplication', $application->id) }}">Reject</a>
                </td>
            </tr>
        @endforeach
    </table>

    <span>
        <p>{{ $applications->links() }}</p>
    </span>
@endif

<script>
function openPopup(profilePicture, drivingLicenseFront, drivingLicenseBack, icFront, icBack, vehicle_pictures) {
    // Construct the HTML content for the popup window
    var popupContent = '<html><head><title>Application Documents</title></head><body>';
    popupContent += '<h2>Profile Picture Path:</h2>';
    popupContent += '<img src=../storage/'+ profilePicture +'>';
    popupContent += '<h2>Driving License (Front) Path:</h2>';
    popupContent += '<img src=../storage/'+ drivingLicenseFront +'>';
    popupContent += '<h2>Driving License (Back) Path:</h2>';
    popupContent += '<img src=../storage/'+ drivingLicenseBack +'>';
    popupContent += '<h2>Identification Card (IC) (Front) Path:</h2>';
    popupContent += '<img src=../storage/'+ icFront +'>';
    popupContent += '<h2>Identification Card (IC) (Back) Path:</h2>';
    popupContent += '<img src=../storage/'+ icBack +'>';
    popupContent += '<h2>Vehicle Photo:</h2>';
    popupContent += '<img src=../storage/'+ vehicle_pictures +'>';
    popupContent += '</body></html>';

    // Open a new window and display the text content
    var popupWindow = window.open('', '_blank', 'width=600,height=400');
    popupWindow.document.open();
    popupWindow.document.write(popupContent);
    popupWindow.document.close();
}

</script>

@endsection