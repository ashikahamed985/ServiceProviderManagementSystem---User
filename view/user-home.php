<?php

    session_start();

    if(!isset($_SESSION['flag'])) header('location:sign-in.php?err=signInFirst');

    require_once('../model/user-info-model.php');
    require_once('../model/service-info-model.php');

    $userManagement = new UserManagement();
    $id = $_COOKIE['id'];
    $row = $userManagement -> userInfo($id);

    $serviceManagement = new ServiceManagement();
    $forYourHomeResult = $serviceManagement -> getAllForYourHomeServices();
    $trendingResult =  $serviceManagement -> getAllTrendingServices();
    $recommendedResult =  $serviceManagement -> getAllrecommendedServices();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php require_once('header.php'); ?>
<table border=0 cellspacing=0 cellpadding=20 width=100%>
    <tr>
        <td><center><img src="../vendors/emi-banner-ezgif.com-webp-to-jpg-converter.jpg" width=80%></center></td>
    </tr>
</table>
<table border=0 cellspacing=0 cellpadding=20 width=70% align=center>
    <tr>
        <td><font size=6>For Your Home</font></td>
    </tr>
    <tr>
        <?php 
            if(mysqli_num_rows($forYourHomeResult)>0 && mysqli_num_rows($forYourHomeResult)<4){

                while($row=mysqli_fetch_assoc($forYourHomeResult)){

                    $serviceID = $row['ServiceID'];
                    $name = $row['ServiceName'];
                    $image = $row['Image'];

                    echo "    
                        <td align=left>
                            <img src=\"../{$image}\" width=250px><br><br>
                            <a href=\"service-page.php?id=$serviceID\">$name</a>
                        </td>";
                }
            }else{
                echo"<td align=\"center\">No Services Available</td>";
            }
        ?>
    </tr>
</table>
<br>
<table border=0 cellspacing=0 cellpadding=20 width=70% align=center>
    <tr>
        <td><font size=6>Trending</font></td>
    </tr>
    <tr>
        <?php 
            if(mysqli_num_rows($trendingResult)>0 && mysqli_num_rows($trendingResult)<4){

                while($row=mysqli_fetch_assoc($trendingResult)){

                    $serviceID = $row['ServiceID'];
                    $name = $row['ServiceName'];
                    $image = $row['Image'];

                    echo "    
                        <td align=left>
                            <img src=\"../{$image}\" width=250px><br><br>
                            <a href=\"service-page.php?id=$serviceID\">$name</a>
                        </td>";
                }
            }else{
                echo"<td align=\"center\">No Services Available</td>";
            }
        ?>
    </tr>
</table>
<br>
<table border=0 cellspacing=0 cellpadding=20 width=70% align=center>
    <tr>
        <td><font size=6>Recommended</font></td>
    </tr>
    <tr>
        <?php 
            if(mysqli_num_rows($recommendedResult)>0 && mysqli_num_rows($recommendedResult)<4){

                while($row=mysqli_fetch_assoc($recommendedResult)){

                    $serviceID = $row['ServiceID'];
                    $name = $row['ServiceName'];
                    $image = $row['Image'];

                    echo "    
                        <td align=left>
                            <img src=\"../{$image}\" width=250px><br><br>
                            <a href=\"service-page.php?id=$serviceID\">$name</a>
                        </td>";
                }
            }else{
                echo"<td align=\"center\">No Services Available</td>";
            }
        ?>
    </tr>
</table>
<br><br><br><br><br>  
<table border=0 cellspacing=0 cellpadding=10 width=70% align=center>
<tr><td><center><font size=4>--WHY CHOOSE US</font></center></td> </tr>
    <td><center><font size=6>Because we care about your safety..</font></center></td>
    <table border=0 cellspacing=0 cellpadding=10 width=70% align=center>
    <td><center><img src="../vendors/safety1.jpg" width=120%></center></td>
    <td><center><img src="../vendors/safety2.jpg" width=80%></center></td>
        </table>
</table>

<table border=0 cellspacing=0 cellpadding=20 width=100%>
    <tr>
        <td><center><img src="../vendors/payment.jpg" width=80%></center></td>
    </tr>
</table>


</table>
<br>
</body>
</html>