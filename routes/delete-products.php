<?php
header('Access-Control-Allow-Origin: http://localhost:5173');

require '../config/db-connect.php';
require '../utils/autoloader.php';

if (!empty($_POST)) {
    \Classes\Product::deleteProduct($_POST, $pdo);

    $newList = \Classes\Product::fetchData($pdo);
    echo json_encode($newList);
}
