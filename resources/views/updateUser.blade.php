<h1>Update Users</h1>

<form action="updateUser" method="POST">

@csrf

<input type="hidden" name="id" value="{{$data['id']}}">
<input type="text" name="username" value="{{$data['username']}}">
<br><br>
<input type="text" name="password" value="{{$data['password']}}">
<br><br>
<label for="role">Select User Role:</label>
        <select name="role" id="role">
            <option value="Admin">Admin</option>
            <option value="Normal">Normal</option>
            <option value="Driver">Driver</option>
        </select>
<br><br>
<button type="submit"> update user </button>

</form>