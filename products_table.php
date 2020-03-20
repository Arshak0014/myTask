<?php
session_start();
require_once 'connecting/connect.php';

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    $result_per_page = 6;

    $data = $connection->prepare("SELECT products.*, models.name AS mod_name, categories.name AS cat_name FROM ((products 
LEFT JOIN models ON products.models_id = models.id)
LEFT JOIN categories ON models.categories_id = categories.id)");

    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);


    $number_of_results = count($result);

    $number_of_pages = ceil($number_of_results / $result_per_page);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $this_page_first_result = ($page - 1) * $result_per_page;


    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-3.4.1.min.js"></script>


    </head>
    <body>
    <div style="display: flex">
        <?php require_once 'leftMenu.php' ?>

        <div class="container mt-5">
            <h1>Products table</h1>
            <table class="mb-4 table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Categories_id</th>
                    <th scope="col">Models_id</th>
                    <th scope="col">Image path</th>
                    <th scope="col">Is new</th>
                    <th scope="col">Price</th>
                    <th scope="col">Create date</th>
                    <th scope="col">Update date</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                <?php

                $data = $connection->prepare("SELECT products.*, models.name AS mod_name, categories.name AS cat_name_f FROM products 
                LEFT JOIN models ON products.models_id = models.id
                LEFT JOIN categories ON products.categories_id = categories.id ORDER BY id DESC LIMIT $this_page_first_result,$result_per_page ");
                $data->execute();
                $result = $data->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <?php foreach ($result as $x): ?>
                    <tr>
                        <th scope="row"><?= $x['id'] ?></th>
                        <td><?= $x['name'] ?></td>
                        <td><?= $x['cat_name_f'] ?></td>
                        <td><?= $x['mod_name'] ?></td>
                        <td><?= $x['image_path'] ?></td>
                        <td><?php if ($x['is_new'] == 1) echo "New"; else echo  "Old"; ?></td>
                        <td><?= $x['price'] ?></td>
                        <td><?= $x['create_date'] ?></td>
                        <td><?= $x['update_date'] ?></td>
                        <td class="delete" id="delete"><a class="deleteF" data-id="<?= $x["id"] ?>">✘</a></td>
                        <td class="update"><a
                                    href="updatefieldproduct.php?id=<?= $x['id'] ?>&name=<?= $x['name'] ?>&category_id=<?= $x['categories_id'] ?>&model_id=<?= $x['models_id'] ?>">↻</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mainPagi">
                <div>
                    <?php
                    if ($page > 1) {
                        echo '<a class="pagi" href="products_table.php?page=' . ($page - 1) . '">⏪</a>';
                    }

                    for ($i = 1; $i <= $number_of_pages; $i++) {
                        if ($number_of_pages > 1) {
                            echo '<a class="pagi" href="products_table.php?page=' . $i . '">' . $i . '</a>';
                        } else {
                            echo null;
                        }
                    }

                    if ($page < $i - 1) {
                        echo '<a class="pagi" href="products_table.php?page=' . ($page + 1) . '">⏩</a>';
                    }
                    ?>
                </div>
                <div>
                    <a style="color: #ffffff" class="shadowButton btn btn-success" href="product_welcome.php">CREATE A
                        NEW PRODUCT</a>
                </div>
            </div>
            <br>


        </div>
    </div>
    <script>
        $('.deleteF').on('click', function () {
            let del_id = $(this).attr('data-id');
            let conf = confirm('delete?');
            if (conf) {
                $(this).attr('href', 'beckend/delete_product.php?id=' + del_id);
            }
        })
    </script>
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