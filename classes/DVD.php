<?php
namespace Classes;

class DVD extends Product 
{
    public function setMeasurements($arr) 
    {
        $this->measurements = ["size" => $arr["dvd_size"] ];
    }

    public function addProduct($pdo) 
    {
        $size = $this->measurements["size"];
        if (!empty($size)) {

            $stmnt = "INSERT INTO main_info(product_sku, product_name, product_price, product_type) VALUES('$this->sku', '$this->name', $this->price, '$this->type')";

            $query = $pdo->prepare($stmnt)->execute();


            $stmnt = "INSERT INTO dvd_details(product_sku, dvd_size) VALUES('$this->sku', $size)";

            $query = $pdo->prepare($stmnt)->execute();
        }
    }
}
