<?php
require_once '../connecting/connect.php';

$d = $_GET['id'];

$delete = "DELETE FROM models WHERE id=$d";
$connection->exec($delete);

header('refresh:1; url=../models_table.php');