<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/login_style.css">
</head>
<body>

<form action="validate.php" method="post">
    <h1>Admin Login</h1>
    <div style="width: 25%;margin: 0 auto" class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Login" id="username" name="username" ><br>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="password" name="password" ><br>

        <input type="checkbox" name="remember" value="1"> remember me

        <button type="submit" value="login" name="login">Login</button>
    </div>
</form>

<?php
if (isset($_SESSION['username']) and isset($_SESSION['password'])){
    header('location: welcome.php');
}
?>

</body>
</html>