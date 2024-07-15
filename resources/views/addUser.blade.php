<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User Form</title>
</head>
<body>
    <h1>Add User Form</h1>

    <form action="addUser" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Enter user name">
        <br><br>
        <input type="text" name="password" placeholder="Enter Password">
        <br><br>
        <label for="role">Select User Role:</label>
        <select name="role" id="role">
            <option value="Admin">Admin</option>
            <option value="Normal">Normal</option>
            <option value="Driver">Driver</option>
        </select>
        <br><br>
        <button type="submit">Add User</button>
    </form>
</body>
</html>
