<?php
namespace Classes;

class Furniture extends Product 
{
    public function setMeasurements($arr) 
    {
        $this->measurements = [
            "length" => $arr["furniture_length"],
            "width" => $arr["furniture_width"],
            "height" => $arr["furniture_height"],
        ];
    }

    public function addProduct($pdo) 
    {
        $length = $this->measurements["length"];
        $width = $this->measurements["width"];
        $height = $this->measurements["height"];
        if (!empty($length) && !empty($width) && !empty($height)) {

            $stmnt = "INSERT INTO main_info(product_sku, product_name, product_price, product_type) VALUES('$this->sku', '$this->name', $this->price, '$this->type')";

            $query = $pdo->prepare($stmnt)->execute();

            $stmnt = "INSERT INTO furniture_details(product_sku, furniture_length, furniture_width, furniture_height) VALUES('$this->sku', $length, $width, $height)";

            $query = $pdo->prepare($stmnt)->execute();
        }
    }
}
