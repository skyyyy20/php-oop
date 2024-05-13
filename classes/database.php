<?php
class database{
    function opencon() {
        return new PDO('mysql:host=localhost;dbname=loginmethod','root','');
    }
    function check($username, $password) {
        $con = $this -> opencon();    
        $query = "Select * from users WHERE UserName ='".$username."'&& UserPass ='".$password."'";
        return  $con->query($query)->fetch();
    }

    function signup($UserName, $UserPass, $firstname, $lastname, $birthday, $sex){
        $con = $this->opencon();
        $query = $con->prepare("SELECT UserName FROM users WHERE UserName = ?");
        $query->execute([$UserName]);
        $existingUser = $query->fetch();

        if($existingUser) {
            return false;
        }

        return $con->prepare("INSERT INTO users (UserName, UserPass, firstname, lastname, birthday, sex) VALUES (?, ?, ?, ?, ?, ?)") ->execute([$UserName, $UserPass, $firstname, $lastname, $birthday, $sex]);
    }

    function signupUser($Firstname, $Lastname, $Birthday, $Sex, $UserName, $UserPass){
        $con = $this->opencon();
        $query = $con->prepare("SELECT UserName FROM users WHERE UserName = ?");
        $query->execute([$UserName]);
        $existingUser = $query->fetch();
        if($existingUser) {
            return false;
        }
        $con->prepare("INSERT INTO users (Firstname, Lastname, Birthday, Sex, UserName, UserPass ) VALUES (?, ?, ?, ?, ?, ?)") ->execute([ $Firstname, $Lastname, $Birthday, $Sex, $UserName, $UserPass,]);
        return $con->lastInsertId();
    }

    function insertAddress($UserID, $user_add_street, $user_add_barangay, $user_add_city, $user_add_province){
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (UserID, user_add_street, user_add_barangay, user_add_city, user_add_province) VALUES (?, ?, ?, ?, ?)") ->execute([$UserID, $user_add_street, $user_add_barangay, $user_add_city, $user_add_province]);
    }
}