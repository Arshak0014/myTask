<?php
require_once '../connecting/connect.php';

$d = $_GET['id'];

$delete = "DELETE FROM products WHERE id=$d";
$connection->exec($delete);

header('refresh:1; url=../products_table.php');