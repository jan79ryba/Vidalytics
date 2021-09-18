<?php

require_once('./Model/BasketRepository.php');
require_once('./Model/DeliveryRepository.php');
require_once('./Model/OffersRepository.php');
require_once('./Model/ProductRepository.php');

class BasketController extends BaseController
{
    /**
     * "/basekt/list"  get lsit of baskets
     */
    public function listAction()
    {       
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $basketRepository = new BasketRepository(); 
                $deliveryRepository = new DeliveryRepository(); 
                $offersRepository = new OffersRepository(); 
                $allBasket = $basketRepository->getAllBaskets();
                $allDelivery = $deliveryRepository->getAllDelivery();
                $allOffers = $offersRepository->getAllOffers();
                $output = [];
                foreach($allBasket as $basket){                    
                    $newPrice = $this->recalculateOffer($basket, $allOffers);
                    $basket["price"] = $newPrice;
                    $basket["delivery"] = $this->findDeliveryCost($allDelivery, $basket["price"]);
                    $basket["total"] = $basket["delivery"] +  $basket["price"];
                    array_push($output,$basket); 
                }
                $responseData = json_encode($output);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * "/basket/add" Endpoint - Add product
     */
    public function addAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
 
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $basketId = $input["basketId"]; 
                $productId = $input["productId"];
                $basketRepository = new BasketRepository(); 
                $basketRepository->addProduct($basketId,$productId);
                $responseData = json_encode($input);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    private function findDeliveryCost($allDelivery, $price){
        foreach($allDelivery as $delivery){
            if($price < $delivery['limit']){
                return $delivery["value"]; 
            }
        }
        return 0;
    }

    private function recalculateOffer($basket, $allOffers){
        $products = explode( ',', $basket["products"] );
        $total = $basket["price"];
        foreach($allOffers as $offer){
            $code = $offer["code"];
            $amount = $offer["amount"];
            $discount= $offer["discount"];
            $counter = 0;
            foreach($products as $product){      
                if(trim($product)== $code){ 
                    $counter++;
                    if($counter == $amount){
                        $productRepository = new ProductRepository(); 
                        $price = $productRepository->getProductPrice($code);
                        $counter = 0;                        
                        $total = $total - $price +  $price * ($discount/100);                        
                    }
                }
            }
        }
        return $total ;       
    }

}
