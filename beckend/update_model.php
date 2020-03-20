<?php
session_start();
$id=$_SESSION["id"];
$name=$_GET["newCategory"];
$CategoriesID=$_GET["cat"];

//echo $name." ".$CategoriesID;
require_once '../connecting/connect.php';

//$update = "UPDATE models SET name='$name' WHERE id=$id";
$update = "UPDATE `models` SET name='$name', categories_id='$CategoriesID' WHERE id='$id'";

$connection->exec($update);


header('refresh:1; url=../models_table.php');

