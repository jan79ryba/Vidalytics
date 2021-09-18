<?php

require_once('./Controller/BaseController.php');
require_once('./Controller/ProductController.php');
require_once('./Controller/BasketController.php');

 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if((isset($uri[3]) && $uri[3] == 'product') ){
    $objFeedController = new ProductController();
}

if((isset($uri[3]) && $uri[3] == 'basket')){
    $objFeedController = new BasketController();
}

$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();
?>