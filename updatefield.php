<?php
session_start();
require_once 'connecting/connect.php';

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">


    </head>
    <body>
    <?php
    $id = $_GET["id"];
    $_SESSION["id"] = $id;
    $name = $_GET['name'];
    ?>
    <div style="display: flex">
        <?php require_once 'leftMenu.php' ?>
        <div class="container mt-5">
            <h1>Update Fields</h1>

            <div id="updateProduct">
                <form action="beckend/update.php" method="get">
                    <input class="category" placeholder="Write new category" value="<?= $name ?>" type="text"
                           name="newCategory">
                    <button style="margin-left: 30px" class="btn btn-success" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>

    </body>
    </html>

    <?php
}else if (isset($_COOKIE["username"]) && isset($_COOKIE['cookie_key'])) {

    $username = $_SESSION['username'];

    $select = $connection->query("SELECT * FROM `users` WHERE `login`= '$username'");
    $sql = $select->fetchAll(PDO::FETCH_ASSOC);
    if ($_COOKIE['username'] == $sql[0]['login'] && $_COOKIE['cookie_key'] == $sql[0]['cookie_key']){
        echo "Session Start";
    }else {
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}