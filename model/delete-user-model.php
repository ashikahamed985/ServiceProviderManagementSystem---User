<?php

 require_once('database.php');

 function deleteUser($userID){

    $con=dbConnection();
    $sql=" DELETE FROM userinfo WHERE UserID='{$userID}';";

    $result=mysqli_query($con,$sql);

    return $result;
    
}

?>