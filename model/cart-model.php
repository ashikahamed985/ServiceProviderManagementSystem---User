<?php

    require_once('database.php');

    function addToCart($bookID, $userID, $price){

        $con = dbConnection();
        $sql = "insert into Cart values('', '{$bookID}' ,'{$userID}', {$price})";

        if(mysqli_query($con, $sql)) return true;
        else return false;
        
    }

    function cartInfo($userID){

        $con=dbConnection();
        $sql="select * from Cart where UserID = '$userID'";

        $result=mysqli_query($con,$sql);

        return $result;
        
    }

    function getCart($cartID){

        $con=dbConnection();
        $sql="select * from Cart where CartID = '$cartID'";

        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);

        return $row;
        
    }

    function removeFromCart($id){

        $con = dbConnection();
        $sql = "delete from Cart where CartID = '$id'";
             
        if(mysqli_query($con,$sql)) return true;
        else return false; 

    }

    function getTotalBill($id){

        $con = dbConnection();
        $sql = "select sum(Price) as sum from Cart where UserID = '{$id}';";

        $result = mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);

        return $row['sum'];

    }

    function clearCart($id){

        $con = dbConnection();
        $sql = "delete from Cart where UserID = '$id'";
             
        if(mysqli_query($con,$sql)) return true;
        else return false; 

    }

?>