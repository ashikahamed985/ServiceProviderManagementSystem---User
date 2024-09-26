<?php

    require_once('../model/cart-model.php');
    require_once('../model/service-info-model.php');

    $serviceID = $_GET['id'];
    $userID = $_COOKIE['id'];
    $serviceManagement = new ServiceManagement();
    $row = $serviceManagement->getServiceByID($serviceID); 
    $price = $row['Price'];

    $status = addToCart($serviceID, $userID, $price);
    if($status){

        header('location:../view/cart.php');

    } 

?>