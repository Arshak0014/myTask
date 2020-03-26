<?php
session_start();
include_once "../connecting/connect.php";

if (isset($_COOKIE['username']) and isset($_COOKIE['cookie_key'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['cookie_key'];

    $delete_cookie_key = null;

    $update = "UPDATE `users` SET cookie_key = '$delete_cookie_key' WHERE id=1";
    $stmt = $connection->prepare($update);
    $stmt->execute();


    setcookie('username', $username, time() - 3600);
    setcookie('cookie_key', $password, time() - 3600);
}

header('location: ../login.php');

session_unset();
session_destroy();
?>
