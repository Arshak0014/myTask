<?php
ob_start();
session_start();
include_once "connecting/connect.php";

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    $category_result = $connection->prepare("SELECT id,name FROM categories  ORDER BY id DESC");
    $category_result->execute();
    $result_cat = $category_result->fetchAll(PDO::FETCH_ASSOC);


    $model_result = $connection->prepare("SELECT id,name, count(name) c FROM models group by name having c = 1 ORDER BY id DESC");
    $model_result->execute();
    $result_mod = $model_result->fetchAll(PDO::FETCH_ASSOC);


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

            <h1>Add Products</h1>
            <form style="width: 300px;" method="POST">
                <select name="cat" id="inputState" class="form-control">
                    <option disabled selected value>Select a category</option>
                    <?php foreach ($result_cat as $x): ?>
                        <option value="<?= $x['id'] ?>"><?= $x['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="mod" id="inputState" class="form-control mt-2">
                    <option disabled selected value>Select a model</option>
                    <?php foreach ($result_mod as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <input class="category" placeholder="Write product name" type="text" name="product"/><br>

                <input placeholder="Write product image" type="file" name="image_path"/>

                <select name="is_new" id="inputState" class="form-control mt-2">
                    <option disabled selected value>Is new?</option>
                    <option value="1">New</option>
                    <option value="0">Old</option>
                </select>

                <input class="category" placeholder="Write product description" type="text" name="description"/><br>

                <input class="category" placeholder="Write product price" type="text" name="price"/><br>

                <button style="margin-top: 10px" class="btn btn-success" type="submit">CREATE</button>
                <a style="margin-top: 10px; color: #ffffff" class="btn btn-info" href="products_table.php">TABLES
                    PAGE</a>
            </form>
        </div>
    </div>
    </body>
    </html>

    <?php


    if (isset($_POST['product']) and isset($_POST['mod'])) {
        $prod = $_POST['product'];
        $mod = $_POST['mod'];
        $cat = $_POST['cat'];

        $img_path = $_POST['image_path'];
        $is_new = $_POST['is_new'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        try {
            $query = "INSERT INTO `products` (`name`,`categories_id`,`models_id`,	`image_path`,`is_new`,`description`,`price`,`create_date`, `update_date`)
                                     VALUES ('$prod','$cat', '$mod', '$img_path', '$is_new', '$description', '$price', now(), now())";
            $connection->exec($query);
            header('location: products_table.php');
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
ob_flush();



