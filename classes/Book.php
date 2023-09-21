<?php
namespace Classes;

class Book extends Product 
{
    public function setMeasurements($arr) 
    {
        $this->measurements = ["weight" => $arr["book_weight"] ];
    }

    public function addProduct($pdo) 
    {
        $weight = $this->measurements["weight"];
        if (!empty($weight)) {
            $stmnt = "INSERT INTO main_info(product_sku, product_name, product_price, product_type) VALUES('$this->sku', '$this->name', $this->price, '$this->type')";

            $query = $pdo->prepare($stmnt)->execute();

            $stmnt = "INSERT INTO book_details(product_sku, book_weight) VALUES('$this->sku', $weight)";

            $query = $pdo->prepare($stmnt)->execute();
        }
    }
}
