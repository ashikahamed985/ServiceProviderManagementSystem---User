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
    $row = $userManagement ->  userInfo($id);

    $fullname = sanitize($_POST['fullname']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $username = sanitize($_POST['username']);

    if(empty($fullname)){
        header('location:../view/edit-profile.php?err=fullnameEmpty'); 
        exit();
    }
    if(empty($phone)){
        header('location:../view/edit-profile.php?err=phoneEmpty'); 
        exit();
    }
    if(empty($email)){
        header('location:../view/edit-profile.php?err=emailEmpty'); 
        exit();
    }
    if(empty($address)){
        header('location:../view/edit-profile.php?err=addressEmpty'); 
        exit();
    }
    if(empty($username)){
        header('location:../view/edit-profile.php?err=usernameEmpty'); 
        exit();
    }

    $namepart = explode(' ', $fullname);
    if(count($namepart) < 2) {
        header('location:../view/edit-profile.php?err=fullnameInvalid'); 
        exit();
    }
    if(!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
        header('location:../view/edit-profile.php?err=fullnameInvalid'); 
        exit();
    }

    if($phone[0] == "0" && $phone[1] == "1") {}
    else{
        header('location:../view/edit-profile.php?err=phoneInvalid'); 
        exit();
    }
    if(is_numeric($phone)){
        if(strlen($phone)==11){}
        else {
            header('location:../view/edit-profile.php?err=phoneInvalid'); 
            exit();
        }
    }
    else {
        header('location:../view/edit-profile.php?err=phoneInvalid'); 
        exit();
    }
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('location:../view/edit-profile.php?err=emailInvalid'); 
        exit();
    }
    if($email != $row['Email'] && $userManagement -> uniqueEmail($email)==false){
        header('location:../view/edit-profile.php?err=emailExists'); 
        exit();
    }
    if (!preg_match("/^[a-zA-Z-']*$/", $username)){
        header('location:../view/edit-profile.php?err=usernameInvalid'); 
        exit();
    }
    
    
    if( $userManagement -> updateUserInfo($id, $fullname, $email, $phone, $address, $username) === true){
        header('location:../view/edit-profile.php?success=changed'); 
        exit();
    }


?>