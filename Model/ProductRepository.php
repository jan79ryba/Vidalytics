<?php

require_once('./Model/Database.php');
require_once('./Model/Product.php');

class ProductRepository extends Database
{
    public function getAllProducts()
    {
        return $this->select("select * from product");
    }

    public function getProductPrice($code)
    {
        $params[0] = "s";
        $params[1] = [$code];
        $products =  $this->select("select price from product where product.code = ?", $params);
        return  $products[0]["price"];
    }

    public function addProduct($product)
    {
        $params[0] = "ssd";
        $params[1] = [$product->name, $product->code, $product->price];

        return $this->insert("INSERT INTO product (name,code,price) VALUES  (?,?,?)", $params);
    }
}
