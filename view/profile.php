<?php

    session_start();
    if(!isset($_SESSION['flag'])) header('location:sign-in.php?err=signInFirst');

    require_once('../model/user-info-model.php');

    $id = $_COOKIE['id'];
    
    $userManagement = new UserManagement();
    $row = $userManagement ->  userInfo($id);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
    <body>
    <?php require_once('header.php') ?>
        <table width="50%" border="1" cellspacing="0" cellpadding="25" align="center">
           
                <td>
                <center>
                Fullname:  <?php echo $row["Fullname"]; ?> <br><br>
                Username:  <?php echo $row["Username"]; ?> <br><br>
                Phone:  <?php echo $row["Phone"]; ?> <br><br>
                Email:  <?php echo $row["Email"]; ?> <br><br>
                Address:  <?php echo $row["Address"]; ?> <br><br>
                </center>
                </td>
           
        </table>
    </body>
</html>