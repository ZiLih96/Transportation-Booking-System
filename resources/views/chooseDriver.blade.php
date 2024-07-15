@extends('layouts.user')

@section('content')
    <style>
        body {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        height: 100vh;
        overflow: hidden;
        }

        .image-container {
            left: 650px;
            top: 150px; 
            position: relative;
            width: 200px;
            height: 200px;
            transform-style: preserve-3d;
            transform: perspective(1000px) rotateY(0deg);
            transition: transform 0.7s;
        }

        .image-container span {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        transform: rotateY(calc(var(--i) * 45deg)) translateZ(400px);
        }

        .image-container span img {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        }

        .btn-container {
        left: 150px;
        top: 150px;
        position: relative;
        width: 80%;
        }

        .btn {
        position: absolute;
        bottom: -80px;
        background: crimson;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        }

        #prev {
        left: 20%;
        }

        #next {
        right: 20%;
        }

        .btn:hover {
        filter: brightness(1.5);
        }
    </style>
    <h1>Select Your Driver</h1>
    <div class="image-container">
      <span style="--i: 1">
        <img
          src="https://img.freepik.com/free-photo/man-car-driving_23-2148889981.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1708387200&semt=sph"
          data-name="Ali"
          data-age="25"
          data-experience="2 years"
          data-habits="Good"
          rating="4"
        />
      </span>
      <span style="--i: 2">
        <img
          src="https://img.freepik.com/free-photo/man-drove-open-window-smilesd-happily_1150-51902.jpg?w=740&t=st=1708426535~exp=1708427135~hmac=09d76666076b9af1c4028e261e7557b1985f8cec77bd0cf3d434255b99beb37d"
          data-name="Kingston"
          data-age="41"
          data-experience="1 year"
          data-habits="Excellent"
          rating="3"
        />
      </span>
      <span style="--i: 3">
        <img
          src="https://img.freepik.com/premium-photo/standing-front-car-male-taxi-driver_8595-5571.jpg?w=740"
          data-name="John"
          data-age="31"
          data-experience="4 year"
          data-habits="Excellent"
          rating="3.75"
        />
      </span>
      <span style="--i: 4">
        <img
          src="https://img.freepik.com/free-photo/man-fastening-safety-belt-car_1303-32008.jpg?size=626&ext=jpg&ga=GA1.1.785154787.1708426524&semt=sph"
          data-name="Siti"
          data-age="23"
          data-experience="2 years"
          data-habits="Good"
          rating="4.5"
        />
      </span>
      <span style="--i: 5">
        <img
          src="https://img.cdndtl.co.uk/q6b740ajikod/c7344527-4164-4266-aa9b-97e695789576/680b22f20043c1c18b8c835290360943/1584550484223.jpg?w=967&auto=format&s=c2a102e88ddef5683297b59da5d12936"
          data-name="Dylan"
          data-age="35"
          data-experience="12 years"
          data-habits="Good"
          rating="3.33"
        />
      </span>
      <span style="--i: 6">
        <img
          src="https://img.freepik.com/free-photo/man-car-driving_23-2148889981.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1708387200&semt=sph"
          data-name="Ali"
          data-age="25"
          data-experience="2 years"
          data-habits="Good"
          rating="4"
        />
      </span>
      <span style="--i: 7">
        <img
          src="https://img.freepik.com/premium-photo/young-expectant-mother-driving-sitting-drivers-seat-car_116547-91038.jpg?w=740"
          data-name="Siti"
          data-age="23"
          data-experience="2 years"
          data-habits="Good"
          rating="4.5"
        />
      </span>
      <span style="--i: 8">
        <img
          src="https://img.freepik.com/free-photo/man-fastening-safety-belt-car_1303-32008.jpg?size=626&ext=jpg&ga=GA1.1.785154787.1708426524&semt=sph"
          data-name="Kenny"
          data-age="36"
          data-experience="2 years"
          data-habits="Good"
          rating="5"
        />
      </span>
    </div>

    <div class="btn-container">
      <button class="btn" id="prev">Prev</button>
      <button class="btn" id="next">Next</button>
    </div>

    <form action="{{ route('finish') }}" method="POST" style="display: flex; align-items: center;">
    @csrf
    <select name="driver_id" id="driverSelect" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; margin-right: 10px; margin-top: 210px;">
        <option value="1,Ali">Ali</option>
        <option value="2,Dylan">Dylan</option>
        <option value="3,Siti">Siti</option>
        <option value="4,Kenny">Kenny</option>
        <option value="5,Kingston">Kingston</option>
        <option value="6,John">John</option>
    </select>
    <button type="submit" class="button" style="background-color: #4caf50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Book Now</button>
    <!-- Hidden input field to store the concatenated driver's ID and name -->
    <input type="hidden" id="driverInfo" name="driver_info">
</form>
<script>
    document.querySelector('form').addEventListener('submit', function() {
        // Get the selected option
        var selectedOption = document.getElementById('driverSelect').options[document.getElementById('driverSelect').selectedIndex];
        
        // Set the value of the hidden input field to the concatenated driver's ID and name
        document.getElementById('driverInfo').value = selectedOption.value;
    });
</script>



    <script src="{{ asset('js/rotate.js') }}"></script>

    <script>
        // JavaScript for handling click event on images
        document.querySelectorAll('.image-container span img').forEach(img => {
        img.addEventListener('click', function() {
        // Get the src, alt, and custom data attributes of the clicked image
        const src = this.getAttribute('src');
        const alt = this.getAttribute('alt');
        const name = this.getAttribute('data-name');
        const age = this.getAttribute('data-age');
        const experience = this.getAttribute('data-experience');
        const habits = this.getAttribute('data-habits');
        const rating = this.getAttribute('rating');

        // Open a new popup window with the image details
        const popupWindow = window.open('', 'popupWindow', 'width=400,height=400');

        // Write HTML content to the popup window
        popupWindow.document.write(`
            <html>
            <head>
                <title>Image Details</title>
            </head>
            <body>
                <img src="${src}" alt="${alt}" style="max-width: 100%; max-height: 100%;">
                <p>
                    Name: ${name}<br>
                    Age: ${age}<br>
                    Experience: ${experience}<br>
                    Habits: ${habits}<br>
                    Rating: ${rating}<br>
                    Feel free to book my service for further negotiation.
                </p>
            </body>
            </html>
        `);

        // Prevent the default action of the click event
        return false;
          });
      });
    </script>
@endsection
