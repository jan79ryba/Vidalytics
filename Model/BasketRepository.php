<?php

require_once('./Model/Database.php');

class BasketRepository extends Database
{
    public function getAllBaskets()
    {
        return $this->select("select basket_product.basket_id as id , sum(product.price) as price, GROUP_CONCAT(product.code SEPARATOR ', ') as products from basket_product left join product on basket_product.product_id = product.id group by basket_product.basket_id 
        ");
    } 

    public function addProduct($basketId, $productId)
    {
        $params[0] = "ii";
        $params[1] = [$basketId, $productId];

        return $this->insert("INSERT INTO basket_product (basket_id, product_id) VALUES  (?,?)", $params);
    }


}
