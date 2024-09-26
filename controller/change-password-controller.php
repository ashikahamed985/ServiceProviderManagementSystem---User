<?php

require_once('../model/user-info-model.php');

function sanitize($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;

}
          
$id = $_COOKIE['id'];
$userManagement = new UserManagement();
$row = $userManagement -> userInfo($id);

$prevpassword = sanitize($_POST['prevpassword']);
$password = sanitize($_POST['password']);
$cpassword = sanitize($_POST['cpassword']);

if(empty($prevpassword)){
    header('location:../view/change-password.php?err=prevpasswordEmpty'); 
    exit();
}
if(empty($password)){
    header('location:../view/change-password.php?err=passwordEmpty'); 
    exit();
}
if(empty($cpassword)){
    header('location:../view/change-password.php?err=cpasswordEmpty'); 
    exit();
}

if($prevpassword != $row['Password']){
    header('location:../view/change-password.php?err=passwordError'); 
    exit();
}

if(strlen($password)<8){
    header('location:../view/change-password.php?err=invalid'); 
    exit();
}

if($password!=$cpassword){
    header('location:../view/change-password.php?err=mismatch'); 
    exit();
}

if($userManagement -> changePassword($id,$password)==true){
    header('location:../view/change-password.php?success=updated'); 
    exit();
}


?>