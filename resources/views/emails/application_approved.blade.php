<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Approved</title>
</head>
<body>
    <h1>Congratulations!</h1>
    <p>Your application has been approved. You are now a member of our platform.</p>
    <p>Details:</p>
    <ul>
        <li>Name: {{ $application->name }}</li>
        <li>Email: {{ $application->email }}</li>
        <!-- Add any other details you want to include -->
    </ul>
</body>
</html>
