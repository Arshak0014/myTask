<?php
session_start();
$id=$_SESSION["id"];
$name=$_GET["newCategory"];

require_once '../connecting/connect.php';

$update = "UPDATE categories SET name='$name' WHERE id=$id";

$connection->exec($update);


header('refresh:1; url=../categories_table.php');
