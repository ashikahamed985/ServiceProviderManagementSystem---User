<?php 
   require('../model/delete-user-model.php');
   session_start();
    deleteUser($_SESSION['UserID']);
    session_destroy();
    setcookie("id","",time()-1,"/");
    header("location:../view/sign-in.php");
    
    
    
?>