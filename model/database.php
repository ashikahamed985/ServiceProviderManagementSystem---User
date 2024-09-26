<?php

function dbConnection(){

    $conn = mysqli_connect('localhost', 'root', '', 'ServiceProviderManagementSytem');
    return $conn;
    
}

?>
