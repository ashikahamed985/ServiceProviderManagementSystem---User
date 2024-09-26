<?php

    require_once('../model/cart-model.php');
    require_once('../model/service-info-model.php');

    $result = cartInfo($_COOKIE["id"]);
    $flag = 0;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php require 'header.php'; ?>
    <?php 
        if(mysqli_num_rows($result)>0){
        echo"<table width=\"70%\" border=\"1\" cellspacing=\"0\" cellpadding=\"15\" align=\"center\">
        <tr>
            <td>
                Service
            </td>
            <td>
                Price
            </td>
            <td>
                Action
            </td>
            <br>
        </tr>";
            while($w=mysqli_fetch_assoc($result)){
                $id=$w['CartID'];
                $serviceID=$w['ServiceID'];
                $serviceManagement = new ServiceManagement();
                $serviceInfo = $serviceManagement->getServiceByID($serviceID); 
                $title=$serviceInfo['ServiceName'];
                $price=$serviceInfo['Price'];
                echo "    
                <tr><td>$title</td>
                <td>$price</td>
                <td><a href=\"../controller/cancel-service-controller.php?id={$id}\">Cancel Service</a></td>          
                </tr>";
            }
        }else{
            $flag = 1;
            echo"<table width=\"70%\" border=\"1\" cellspacing=\"0\" cellpadding=\"15\" align=\"center\">
            <tr>
                <td>
                    Service
                </td>
                <td>
                    Price
                </td>
                <td>
                    Action
                </td>
                <br>
            </tr>
            <tr>
                <td align=\"center\" colspan=\"3\">No services available at this moment</td>
            </tr>";
        }
    ?>
    </table>
    <br><br>
    <center><?php if($flag == 0) echo "<a href=\"confirm-service.php\">Confirm Service</a>"; ?></center>
</body>
</html>