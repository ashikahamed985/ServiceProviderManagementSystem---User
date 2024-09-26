<?php 

    require_once('../model/user-info-model.php');
    function sanitize($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;

    }
    $userManagement = new UserManagement();

    $fullname = sanitize($_POST['fullname']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $cpassword = sanitize($_POST['cpassword']);
    $role = "User";

    if(empty($fullname)){
        header('location:../view/sign-up.php?err=fullnameEmpty'); 
        exit();
    }
    if(empty($phone)){
        header('location:../view/sign-up.php?err=phoneEmpty'); 
        exit();
    }
    if(empty($email)){
        header('location:../view/sign-up.php?err=emailEmpty'); 
        exit();
    }
    if(empty($address)){
        header('location:../view/sign-up.php?err=addressEmpty'); 
        exit();
    }
    if(empty($username)){
        header('location:../view/sign-up.php?err=usernameEmpty'); 
        exit();
    }
    if(empty($password)){
        header('location:../view/sign-up.php?err=passwordEmpty'); 
        exit();
    }
    if(empty($cpassword)){
        header('location:../view/sign-up.php?err=cpasswordEmpty'); 
        exit();
    }

    $namepart = explode(' ', $fullname);
    if(count($namepart) < 2) {
        header('location:../view/sign-up.php?err=fullnameInvalid'); 
        exit();
    }
    if(!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
        header('location:../view/sign-up.php?err=fullnameInvalid'); 
        exit();
    }
    if($phone[0] == "0" && $phone[1] == "1") {}
    else{
        header('location:../view/sign-up.php?err=phoneInvalid'); 
        exit();
    }
    if(is_numeric($phone)){
        if(strlen($phone)==11){}
        else {
            header('location:../view/sign-up.php?err=phoneInvalid'); 
            exit();
        }
    }
    else {
        header('location:../view/sign-up.php?err=phoneInvalid'); 
        exit();
    }
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('location:../view/sign-up.php?err=emailInvalid'); 
        exit();
    }
    
    if($userManagement -> uniqueEmail($email)==false){
        header('location:../view/sign-up.php?err=emailExists'); 
        exit();
    }
    if (!preg_match("/^[a-zA-Z-']*$/", $username)){
        header('location:../view/sign-up.php?err=usernameInvalid'); 
        exit();
    } 

    if (strlen($password) < 8){
        header('location:../view/sign-up.php?err=passwordInvalid'); 
        exit();
    }
    if ($password != $cpassword){
        header('location:../view/sign-up.php?err=passwordMismatch'); 
        exit();
    }
    
    $status = $userManagement ->  addUser($fullname, $phone, $email, $address, $username, $password, $role);
    if($status) header('location:../view/sign-in.php?success=created');

?>