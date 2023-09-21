<?php
require_once "config.php";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
}
catch (PDOException $e) {
    die($e->getMessage());
}
