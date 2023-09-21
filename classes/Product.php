<?php
namespace Classes;

abstract class Product {
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $measurements;

    public function setSKU($sku) 
    {
        $this->sku = $sku;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function setPrice($price) 
    {
        $this->price = $price;
    }

    public function setType($type) 
    {
        $this->type = $type;
    }

    public function getSKU() 
    {
        return $this->sku;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    public function getType() 
    {
        return $this->type;
    }

    public function getMeasurements() 
    {
        return $this->measurements;
    }

    public static function checkSKU($sku, $pdo) 
    {
        $stmnt = "SELECT product_sku FROM main_info WHERE product_sku = '$sku'";

        $result = $pdo->query($stmnt)->fetch();

        if (!empty($result)) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function deleteProduct($arr, $pdo) 
    {
        foreach ($arr as $item) {
            $sku = $item['sku'];
            $type = strtolower($item['type']);

            $stmnt = "DELETE FROM {$type}_details WHERE product_sku = '$sku'";
            $query = $pdo->prepare($stmnt)->execute();

            $stmnt = "DELETE FROM main_info WHERE product_sku = '$sku'";
            $query = $pdo->prepare($stmnt)->execute();
        }
    }

    public static function fetchData($pdo) {
        $stmnt = "SELECT main_info.*, dvd_details.dvd_size, book_details.book_weight, furniture_details.furniture_height, furniture_details.furniture_width, furniture_details.furniture_length FROM main_info LEFT JOIN dvd_details ON main_info.product_sku = dvd_details.product_sku LEFT JOIN book_details ON main_info.product_sku = book_details.product_sku LEFT JOIN furniture_details ON main_info.product_sku = furniture_details.product_sku;";
        $query = $pdo->query($stmnt);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $arr = [];
        $namespace = "Classes";

        foreach($result as $entry) {
            // create object from data using factory and set props
            $factory = new \Classes\ProductFactory;
            $obj = $factory->createProduct($entry["product_type"], $namespace);
            $obj->setType($entry["product_type"]);
            $obj->setSKU($entry["product_sku"]);
            $obj->setName($entry["product_name"]);
            $obj->setPrice($entry["product_price"]);

            // set measurement property in the object
            $measurements = [
                "dvd_size" => $entry["dvd_size"],
                "book_weight" => $entry["book_weight"],
                "furniture_width" => $entry["furniture_width"],
                "furniture_height" => $entry["furniture_height"],
                "furniture_length" => $entry["furniture_length"],
            ];
            $obj->setMeasurements($measurements);

            // get all the data of a single product from obj and wrap in array
            $data = [
                "sku" => $obj->getSKU(),
                "name" => $obj->getName(),
                "price" => $obj->getPrice(),
                "type" => $obj->getType(),
                "measurements" => $obj->getMeasurements(),
            ];

            // add to array that will hold the data for each product
            array_push($arr, $data);
        }
        return $arr;
    }

    abstract public function setMeasurements($arr);

    abstract public function addProduct($pdo);
}
