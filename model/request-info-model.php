<?php

    require_once('database.php');


    function createRequest($userID, $address, $bill, $requestDate){

        $con = dbConnection();
        $sql = "insert into RequestInfo values('', '{$userID}' ,'{$address}' , {$bill}, '{$requestDate}')";

        if(mysqli_query($con, $sql)) return true;
        else return false;
        
    }


?>