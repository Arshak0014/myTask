<?php
session_start();
$id=$_SESSION["id"];
$name=$_GET["newCategory"];
$CategoriesID=$_GET["cat"];
$ModelsID=$_GET["mod"];


require_once '../connecting/connect.php';

$update = "UPDATE `products` SET name='$name',categories_id='$CategoriesID', models_id='$ModelsID' WHERE id='$id'";

$connection->exec($update);


header('refresh:1; url=../products_table.php');

