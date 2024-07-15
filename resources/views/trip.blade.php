@extends('layouts.user')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            height: 1800px
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
                /* 
        * Always set the map height explicitly to define the size of the div element
        * that contains the map. 
        */
        #map {
            height: 400px; /* Set the height of the map */
            width: 700px; /* Set the width of the map */
            margin-left: auto; /* Center the map horizontally */
            margin-right: auto; /* Center the map horizontally */
            border-radius: 8px; /* Add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8); /* Add a shadow */
        }
        /* 
        * Optional: Makes the sample page fill the window. 
        */
        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }

        #map {
        height: 100%;
        }

        /* 
        * Optional: Makes the sample page fill the window. 
        */
        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }

        .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #origin-input,
        #destination-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 200px;
        }

        #origin-input:focus,
        #destination-input:focus {
        border-color: #4d90fe;
        }

        #mode-selector {
        color: #fff;
        background-color: #4d90fe;
        margin-left: 12px;
        padding: 5px 11px 0px 11px;
        }

        #mode-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
        }
    </style>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- DateRangePicker CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- jQuery (required by DateRangePicker) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Moment.js (required by DateRangePicker) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- DateRangePicker JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <div style="text-align: center; margin-top: 20px; margin:100px">
    <form method="GET" action="{{ route('chooseDriver') }}">
        <img src="../images/startpoint.png" style="width: 250px; margin-right: 180px;   margin-left: auto; margin-right: auto;">
        <label for="money">Enter Startpoint and Destination:</label>
        <input
            id="origin-input"
            class="controls"
            type="text"
            name="startpoint"
            placeholder="Enter an origin location"
        />

        <input
            id="destination-input"
            class="controls"
            type="text"
            name="destination"
            placeholder="Enter a destination location"
        />

        <div id="mode-selector" class="controls">
            <input
            type="radio"
            name="type"
            id="changemode-walking"
            checked="checked"
            />
            <label for="changemode-walking">Walking</label>

            <input type="radio" name="type" id="changemode-transit" />
            <label for="changemode-transit">Transit</label>

            <input type="radio" name="type" id="changemode-driving" />
            <label for="changemode-driving">Driving</label>
        </div>

        <div id="map"></div>
        <br>

        <img src="../images/money.png" style="width: 100px; margin-right: 180px; margin-left: auto; margin-right: auto;">
        <label for="money">Enter Amount (in RM):</label>
        <input type="number" id="money" name="money" min="0" step="0.01" required placeholder="Enter amount">

        <div class="date-input-container">
            <img src="../images/calendar.png" style="width: 100px; margin-right: 180px; margin-left: auto; margin-right: auto;">
            <label for="dateRange">Select Booking Date Range:</label>
            <input type="text" id="dateRange" name="dateRange" class="form-control" required>
        </div>

        <img src="../images/pickup_time.png" style="width: 100px; margin-right: 180px; margin-left: auto; margin-right: auto;">
        <label for="time">Select Pickup Time:</label>
        <input type="time" id="time" name="pickup_time" required>

        <img src="../images/return_time.png" style="width: 100px; margin-right: 180px; margin-left: auto; margin-right: auto;">
        <label for="time">Select Return Time:</label>
        <input type="time" id="time" name="return_time" required>

        <input type="text" id="customDuration" name="customDuration" style="display: none;" placeholder="Enter custom duration">
        <br>
        <img src="../images/requirement.png" style="width: 100px; margin-right: 180px; margin-left: auto; margin-right: auto;">
        <label for="requirement">Others Requirement:</label>
        <input type="text" id="requirement" name="requirement" placeholder="Any requirement? Ex: Everyday in this period except weekend">

        <button class="button">Submit</button>
    </form>
    </div>
    <!-- JavaScript for dropdown menu -->
    <script>
    function showInput() {
        var select = document.getElementById("duration");
        var userInput = document.getElementById("customDuration");
        userInput.style.display = select.value === "other" ? "block" : "none";
    }
    </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8xjXLWPakZbsGwDdsOxXUN0vPDUcjWS4&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8xjXLWPakZbsGwDdsOxXUN0vPDUcjWS4&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
    <script src="{{ asset('js/index.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dateRange').daterangepicker({
                opens: 'left' // Adjust the calendar position as needed
            });
        });
    </script>
@endsection