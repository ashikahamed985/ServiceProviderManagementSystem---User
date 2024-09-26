<?php

    session_start();
    if(!isset($_SESSION['flag'])) header('location:sign-in.php?err=signInFirst');
    require_once('../model/user-info-model.php');    
  
    $id = $_COOKIE['id'];
    
    $userManagement = new UserManagement();
    $row = $userManagement ->  userInfo($id);

    $fullnameMsg = $emailMsg = $phoneMsg = $addressMsg =  $usernameMsg = '';

    if (isset($_GET['err'])) {

    $err_msg = $_GET['err'];
    
    switch ($err_msg) {
        case 'fullnameEmpty': {
            $fullnameMsg = "Fullname can not be empty.";
            break;
        }
        case 'phoneEmpty': {
            $phoneMsg = "Phone number can not be empty.";
            break;
        }
        case 'addressEmpty': {
            $addressMsg = "Address can not be empty.";
            break;
        }
        case 'emailEmpty': {
            $emailMsg = "Email can not be empty.";
            break;
        }
        case 'usernameEmpty': {
            $usernameMsg = "Username can not be empty.";
            break;
        }
        case 'fullnameInvalid': {
            $fullnameMsg = "Fullname is not valid.";
            break;
        }
        case 'phoneInvalid': {
            $phoneMsg = "Phone number is not valid.";
            break;
        }
        case 'emailInvalid': {
            $emailMsg = "Email is not valid.";
            break;
        }
        case 'emailExists': {
            $emailMsg = "Email already exists.";
            break;
        }
        case 'usernameInvalid': {
            $usernameMsg = "Username is not valid.";
            break;
        }
    }
    }

$success_msg = '';

if (isset($_GET['success'])) {

  $s_msg = $_GET['success'];

  switch ($s_msg) {
    case 'changed': {
        $success_msg = "Information successfully updated.";
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
    <title>Edit Profile</title>
    <script src="javascript/edit-profile.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php require_once('header.php'); ?>

    <table width="27%" border="1" cellspacing="0" cellpadding="25" align="center">
        <tr>
            <td>
                <form method="post" action="../controller/edit-profile-controller.php" novalidate autocomplete="off" onsubmit="return isValid(this);">
                    Full Name:
                    <input type="text" name="fullname" size="43px" value= "<?php echo "{$row['Fullname']}"; ?>">
                    <?php if (strlen($fullnameMsg) > 0) { ?>
                        <br><br>
                        <font color="red"><?= $fullnameMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="fullnameError"></font><br>
                    Phone Number: 
                    <input type="text" name="phone" size="43px" value= "<?php echo "{$row['Phone']}"; ?>">
                    <?php if (strlen($phoneMsg) > 0) { ?>
                        <br><br>
                        <font color="red"><?= $phoneMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="phoneError"></font><br>
                    Email:<br>
                    <input type="email" name="email" size="43px" value= "<?php echo "{$row['Email']}"; ?>">
                    <?php if (strlen($emailMsg) > 0) { ?>
                        <br><br>
                        <font color="red"><?= $emailMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="emailError"></font><br>
                    Address:
                    <input type="text" name="address" size="43px" value= "<?php echo "{$row['Address']}"; ?>">
                    <?php if (strlen($addressMsg) > 0) { ?>
                        <br><br>
                        <font color="red"><?= $addressMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="addressError"></font><br>
                    Username:<br>
                    <input type="text" name="username" size="43px" value= "<?php echo "{$row['Username']}"; ?>">
                    <?php if (strlen($usernameMsg) > 0) { ?>
                        <br><br>
                        <font color="red"><?= $usernameMsg ?></font>
                    <?php } ?>
                    <br><font color="red" align="center" id="usernameError"></font><br>
                    <?php if (strlen($success_msg) > 0) { ?>
                        <font color="green" align="center"><?= $success_msg ?></font>
                        <br><br>
                    </div>
                    <?php } ?>
                    <a href="sign-up.php"><center><button class="button-red">Edit Profile </button></a></center>
                </form>
            </td>
        </tr>
    </table>
</body>
</html>