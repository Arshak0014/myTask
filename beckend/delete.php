<?php
require_once '../connecting/connect.php';

$d = $_GET['id'];

$delete = "DELETE FROM categories WHERE id=$d";
$connection->exec($delete);

header('refresh:1; url=../categories_table.php');