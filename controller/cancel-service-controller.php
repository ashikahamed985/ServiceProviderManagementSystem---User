<?php

    require_once('../model/cart-model.php');

    if(isset($_GET['id'])){

        removeFromCart($_GET['id']);
        header('location:../view/cart.php');
        
    }

?>
