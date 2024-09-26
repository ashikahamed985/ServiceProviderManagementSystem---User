<?php

$error_msg = '';

if (isset($_GET['err'])) {

  $err_msg = $_GET['err'];
  
  switch ($err_msg) {
    case 'mismatch': {
        $error_msg = "Wrong email or password.";
        break;
      }
      case 'signInFirst': {
        $error_msg = "You need to sign in first.";
        break;
      }
    case 'empty': {
        $error_msg = "Field(s) can not be empty.";
        break;
      }
  }
}

$success_msg = '';

if (isset($_GET['success'])) {

  $s_msg = $_GET['success'];

  switch ($s_msg) {
    case 'created': {
        $success_msg = "Account creation successful. Please sign in.";
        break;
      }
    case 'changed': {
        $success_msg = "Password change successful. Please sign in.";
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
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="javascript/sign-in.js"></script>
    
</head>
<body>
<br><br><br><br><br><br>
    <table width="27%" border="1" cellspacing="0" cellpadding="25" align="center"> 
        <tr>
            <td>
                <form method="post" action="../controller/sign-in-controller.php" onsubmit="return isValid(this);">
                    Email: <br>
                    <input type="text" name="email" size="43px" placeholder="Enter Your Email">
                    <br><center><font color="red" id="emailError"></font></center><br>
                    Password: <br>
                    <input type="password" name="password" size="43px"placeholder="Enter Your Password">
                    </div>
                    <br><center><font color="red" id="passwordError"></font></center><br>
                    <br>
                    <?php if (strlen($error_msg) > 0) { ?>
                        <br>
                        <center><font color="red" align="center"><?= $error_msg ?></font></center>
                        <br><br>
                    <?php } ?>
                    <?php if (strlen($success_msg) > 0) { ?>
                        <br>
                        <center><font color="green" align="center"><?= $success_msg ?></font></center>
                        <br><br>
                    <?php } ?>
         
                    <center><button class="button-red" name="submit">Login</button></button></center>
                    
                    <br><br>
                    </form>
                    <hr width="auto">
                    <center>Don't have an account?</center>
                    <br><br>             
                    <a href="sign-up.php"><center><button class="button-red">Register Now</button></a></center>

                    
            </td>
        </tr>
    </table>
</body>
</html>