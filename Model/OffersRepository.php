<?php

require_once('./Model/Database.php');

class OffersRepository extends Database
{
    public function getAllOffers()
    {
        return $this->select("select * from offer");
    } 
}
