<?php

    session_start();
    if(!isset($_SESSION['flag'])) header('location:sign-in.php?err=signInFirst');
    require_once('../model/user-info-model.php');    
  
    $id = $_COOKIE['id'];
   $userManagement = new UserManagement();
    $row = $userManagement ->  userInfo($id);

    $prevpasswordMsg = $passwordMsg = $cpasswordMsg = '';

    if (isset($_GET['err'])) {

    $err_msg = $_GET['err'];
    
    switch ($err_msg) {
        case 'prevpasswordEmpty': {
            $prevpasswordMsg = "Previous password can not be empty.";
            break;
        }
        case 'passwordEmpty': {
            $passwordMsg = "Password can not be empty.";
            break;
        }
        case 'cpasswordEmpty': {
            $cpasswordMsg = "Confirm password can not be empty.";
            break;
        }
        case 'passwordError': {
            $prevpasswordMsg = "Incorrect password.";
            break;
        }
        case 'invalid': {
            $passwordMsg = "Invalid password.";
            break;
        }
        case 'mismatch': {
            $cpasswordMsg = "Passwords do not match.";
            break;
        }
    }
    }

$success_msg = '';

if (isset($_GET['success'])) {

  $s_msg = $_GET['success'];

  switch ($s_msg) {
    case 'updated': {
        $success_msg = "Password successfully updated.";
        break;
      }
  }
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <script src="javascript/change-password.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<?php require 'header.php'; ?>
<br><br><br><br>
    <table width="27%" border="1" cellspacing="0" cellpadding="25" align="center">
        <tr>
            <td>
                <form method="post" action="../controller/change-password-controller.php" novalidate autocomplete="off" onsubmit="return isValid(this);">
        
                    Previous Password:
                    <input type="password" name="prevpassword" size="43px"placeholder="Enter Your Previous Password">
                    <?php if (strlen($prevpasswordMsg) > 0) { ?>
                        <br><br>
                        <font color="red" align="center"><?= $prevpasswordMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="prevPasswordError"></font><br>
                    New Password:
                    <input type="password" name="password" size="43px"placeholder="Enter Your New Password">
                    <?php if (strlen($passwordMsg) > 0) { ?>
                        <br><br>
                        <font color="red" align="center"><?= $passwordMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="passwordError"></font><br>
                    Confirm New Password:
                    <input type="password" name="cpassword" size="43px"placeholder="Enter Your Confirm Password">
                    <?php if (strlen($cpasswordMsg) > 0) { ?>
                        <br><br>
                        <font color="red" align="center"><?= $cpasswordMsg ?></font>
                    <?php } ?>
                    <?php if (strlen($success_msg) > 0) { ?>
                        <br><br>
                        <font color="green" align="center"><?= $success_msg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="cpasswordError"></font><br>
                    <a href="sign-up.php"><center><button class="button-red">Chnage Password</button></a></center>
                    
                </form>
            </td>
        </tr>
    </table>
</body>
</html>