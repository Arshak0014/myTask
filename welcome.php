<?php
session_start();
include_once "connecting/connect.php";

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    $categories = "CREATE TABLE IF NOT EXISTS `categories` (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    create_date DATE,
    update_date DATE
    )";


    $connection->exec($categories);

    $models = "CREATE TABLE IF NOT EXISTS `models` (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    categories_id INT(11),
    name VARCHAR(100) NOT NULL,
    create_date DATE,
    update_date DATE
    )";

    $connection->exec($models);

    $products = "CREATE TABLE IF NOT EXISTS `products` (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    categories_id INT(11),
    models_id INT(11),
    name VARCHAR(100) NOT NULL,
    image_path VARCHAR(100),
    is_new TINYINT(1),
    description TEXT,
    price INT(20),
    create_date DATE,
    update_date DATE 
    )";


    $connection->exec($products);
?>

    <div style="display: flex">
            <?php require_once 'leftMenu.php' ?>
        <div style="width: 100%; padding: 100px">
            <h3>Welcome</h3>
        </div>
    </div>

<?php

} else if (isset($_COOKIE["username"]) && isset($_COOKIE['cookie_key'])) {

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

