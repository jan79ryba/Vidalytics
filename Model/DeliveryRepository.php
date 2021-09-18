<?php

require_once('./Model/Database.php');

class DeliveryRepository extends Database
{
    public function getAllDelivery()
    {
        return $this->select("select * from delivery order by delivery.limit asc");
    } 
}
