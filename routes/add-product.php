<?php
header('Access-Control-Allow-Origin: http://localhost:5173');

require '../config/db-connect.php';
require '../utils/autoloader.php';
require '../utils/sanitize-input.php';

if (!empty($_POST)) {
    // clean up incoming data and remove unwanted characters
    $sku = sanitizeInput($_POST["sku"]);
    $type = sanitizeInput($_POST["productType"]);
    $name = sanitizeInput($_POST["name"]);
    $price = sanitizeInput($_POST["price"]);
    $measurements = [];
    foreach($_POST["measurements"] as $prop => $key) {
        $measurements[$prop] = sanitizeInput($key);
    };

    // specify namespace and factory name
    $namespace = "Classes";
    $className = "\\" . $namespace . "\\" . "ProductFactory";

    // use product factory to create the different product types
    $factory = new $className();
    $obj = $factory->createProduct($type, $namespace);

    // set product props
    $obj->setSKU($sku);
    $obj->setType($type);
    $obj->setName($name);
    $obj->setPrice($price);
    $obj->setMeasurements($measurements);

    // add product to db
    $obj->addProduct($pdo);
}
