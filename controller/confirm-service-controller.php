<?php

    require_once('../model/user-info-model.php');
    require_once('../model/request-info-model.php');
    require_once('../model/cart-model.php');
            
    $id = $_COOKIE['id'];
    
    $userManagement = new UserManagement();

    $row = $userManagement -> userInfo($id);


    $password = $_POST['password'];

    if(empty($password)){
        header('location:../view/confirm-service.php?err=empty'); 
        exit();
    }

    if($password != $row['Password']){
        header('location:../view/confirm-service.php?err=mismatch'); 
        exit();
    }

    $address = $_POST['address'];
    $bill = getTotalBill($id);
    $requestDate = date("l, F jS Y");

    $status = createRequest($id, $address, $bill, $requestDate);
    if($status){

        clearCart($id);
        header('location:../view/confirm-service.php?success=confirmed');

    } 


?>