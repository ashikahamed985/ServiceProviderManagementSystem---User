<?php

require_once('database.php');

class UserManagement {
    private $con;

    public function __construct() {
        $this->con = dbConnection();
    }

    public function login($email, $password) {
        $sql = $this->con->prepare("SELECT * FROM UserInfo WHERE email = ? AND password = ?");
        $sql->bind_param("ss", $email, $password);
        $sql->execute();
        $result = $sql->get_result();
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return false;
        }
    }

    public function addUser($fullname, $phone, $email, $address, $username, $password, $role) {
        $sql = $this->con->prepare("INSERT INTO UserInfo VALUES('', ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssssss", $fullname, $phone, $email, $address, $username, $password, $role);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function uniqueEmail($email) {
        $sql = $this->con->prepare("SELECT email FROM UserInfo WHERE email LIKE ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getUserByMail($email) {
        $sql = $this->con->prepare("SELECT * FROM UserInfo WHERE Email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
             
        $result = $sql->get_result();
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function changePassword($id, $newpass) {
        $sql = $this->con->prepare("UPDATE UserInfo SET Password = ? WHERE UserID = ?");
        $sql->bind_param("ss", $newpass, $id);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function userInfo($id) {
        $sql = "SELECT * FROM UserInfo WHERE UserID='$id'";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function updateUserInfo($id, $fullname, $email, $phone, $address, $username) {
        $sql = $this->con->prepare("UPDATE UserInfo SET Fullname = ?, Username = ?, Phone = ?, Email = ?, Address = ? WHERE UserID = ?");
        $sql->bind_param("ssssss", $fullname, $username, $phone, $email, $address, $id);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct() {
        mysqli_close($this->con);
    }
}