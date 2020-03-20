<?php
session_start();
include_once "connecting/connect.php";

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    $data = $connection->prepare("SELECT * FROM categories");
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);


    ?>

    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
    <div style="display: flex">
        <?php require_once 'leftMenu.php' ?>
        <div class="container mt-5">

            <h1>Add Categories</h1>
            <form method="POST">
                <input class="category" placeholder="Write categories" type="text" name="category"/><br>
                <button style="margin-top: 10px" class="btn btn-success" type="submit">CREATE</button>
                <a style="margin-top: 10px; color: #ffffff" class="btn btn-info" href="categories_table.php">TABLES
                    PAGE</a>
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
    if (isset($_POST['category'])) {
        $category = $_POST['category'];
        try {
            $query = "INSERT INTO `categories` (name, `create_date`, `update_date`) VALUES ('$category', now(), now())";
            $connection->exec($query);
            header('location: categories_table.php');
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
    }
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