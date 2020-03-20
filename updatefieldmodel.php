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
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
<?php

$id = $_GET["id"];
$_SESSION["id"] = $id;
$name = $_GET['name'];
$category_id = $_GET['category_id'];
?>
<div style="display: flex">
    <?php require_once 'leftMenu.php';
    include "connecting/connect.php";

    $data = $connection->prepare("SELECT * FROM `categories`");

    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="container mt-5">
        <h1>Update Fields</h1>

        <div id="updateProduct">
            <form style="    width: 300px;" action="beckend/update_model.php" method="get">

                <select name="cat" id="inputState" class="form-control">
                    <?php
                    foreach ($result as $x) {
                        ?>
                        <option value="<?=$x["id"] ?>" <?php if ($x['id'] == $category_id){ ?> selected <?php } ?>> <?=$x["name"] ?></option>
                        <?php
                    }

                    ?>

                </select>

                <input class="category" placeholder="Write new category" value="<?= $name ?>" type="text"
                       name="newCategory">
                <button class="btn btn-success" type="submit">Update</button>
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