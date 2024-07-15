@extends('layouts.user')

@section('content')
    <style>
        h1 {
            text-align: center;
            margin-top: 50px;
            font-size: 24px;
        }

        .driver-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="file"],
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
    <h1>Enter All Information for Driver's Application</h1>

<form action="{{ route('processDriverForm') }}" method="POST" enctype="multipart/form-data" class="driver-form">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="profilePicture">Profile Picture:</label>
        <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required>
    </div>

    <div class="form-group">
        <label for="drivingLicenseFront">Driving License (Front):</label>
        <input type="file" id="drivingLicenseFront" name="drivingLicenseFront" accept="image/*" required>
    </div>
    
    <div class="form-group">
        <label for="drivingLicenseBack">Driving License (Back):</label>
        <input type="file" id="drivingLicenseBack" name="drivingLicenseBack" accept="image/*" required>
    </div>

    <div class="form-group">
        <label for="icFront">Identification Card (IC) (Front):</label>
        <input type="file" id="icFront" name="icFront" accept="image/*" required>
    </div>
    
    <div class="form-group">
        <label for="icBack">Identification Card (IC) (Back):</label>
        <input type="file" id="icBack" name="icBack" accept="image/*" required>
    </div>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>
    </div>

    <div class="form-group">
        <label for="vehicleModel">Vehicle Model:</label>
        <input type="text" id="vehicleModel" name="vehicleModel" required>
    </div>

    <div class="form-group">
        <label for="vehiclePictures">Vehicle Pictures:</label>
        <input type="file" id="vehiclePictures" name="vehiclePictures" accept="image/*" required>
    </div>

    <div class="form-group">
        <label for="workingExperience">Working Experience:</label>
        <textarea id="workingExperience" name="workingExperience" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
    </div>
    
    <button type="submit" class="submit-button">Submit</button>
</form>
@endsection

