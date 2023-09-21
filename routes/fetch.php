<?php
header('Access-Control-Allow-Origin: http://localhost:5173');

require '../config/db-connect.php';
require '../utils/autoloader.php';

$data = \Classes\Product::fetchData($pdo);

echo json_encode($data);
