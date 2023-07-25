<!DOCTYPE html>
<html>

<head>
    <title>Post User</title>
</head>

<body>
    <form method="POST" action="/process_register">
        @csrf
        <label>Username:</label>
        <input type="text" name="username"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>

        <label>Name:</label>
        <input type="text" name="name"><br>

        <label>Email:</label>
        <input type="email" name="email"><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>