<?php
header('Access-Control-Allow-Origin: http://localhost:5173');

require '../config/db-connect.php';
require '../utils/autoloader.php';
require '../utils/sanitize-input.php';

if ($_POST) {
    $sku = sanitizeInput($_POST['sku']);
    $skuExists = \Classes\Product::checkSKU($sku, $pdo);
    echo json_encode($skuExists);
}
