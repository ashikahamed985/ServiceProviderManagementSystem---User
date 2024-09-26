<?php

    session_start();

    if(!isset($_SESSION['flag'])) header('location:sign-in.php?err=signInFirst');

    require_once('../model/user-info-model.php');
    require_once('../model/service-info-model.php');

    $id = $_COOKIE['id'];
    $userManagement = new UserManagement();
    $row = $userManagement ->  userInfo($id);

    $serviceManagement = new ServiceManagement();
    $serviceID = $_GET['id'];
    $serviceInfo = $serviceManagement->getServiceByID($serviceID);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php require_once('header.php') ?>
<br>
<a href="../controller/request-service-controller.php?id=<?php echo $serviceInfo["ServiceID"] ?>">Request Service</a>
<center>
Service Name: <?php echo $serviceInfo["ServiceName"]; ?> <br><br>
Price: <?php echo $serviceInfo["Price"]; ?> <br><br> 
Description: <?php echo $serviceInfo["Description"]; ?><br><br>
<img src="../<?php echo $serviceInfo["Image"]; ?>" width=400px>
</center>
</body>
</html>