<?php

include_once "connecting/connect.php";

function randomPassword() {
    $pass = '';
    for ($i = 0; $i < 15; $i++) {
        if ($i%2==0){
            $pass.= chr(mt_rand(97,122));
        }else{
            $pass.= mt_rand(0,99);
        }
    }
    return $pass;
}

$generatePass = randomPassword();

if (isset($_POST['login']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = $connection->query("SELECT * FROM `users` WHERE `login`= '$username'");
    $sql = $select->fetchAll(PDO::FETCH_ASSOC);
    $db_login = $sql[0]['login'];
    $db_password = $sql[0]['password'];
    $db_id = $sql[0]['id'];


    if ($username === $db_login and $password === $db_password){
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        if (isset($_POST['remember'])){

            $update = "UPDATE `users` SET cookieKey = '$generatePass' WHERE id='$db_id'";
            $stmt = $connection->prepare($update);
            $stmt->execute();

            setcookie('username',$username,time()+60*60*7);
            setcookie('cookieKey',$generatePass,time()+60*60*7);
        }
        header('location: welcome.php');
    }else{
        echo "Username or password is invalid.<br> Click here to <a href='login.php'>Try again</a>";
    }

}else{
    header('location: login.php');
}
