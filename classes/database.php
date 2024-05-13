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

    function view ()
    {
        $con = $this->opencon();
        return $con->query("SELECT
        users.UserID,
        users.Firstname,
        users.Lastname,
        users.Birthday,
        users.Birthday,
        users.Sex,
        users.UserName,
        users.UserPass,
        CONCAT(
            user_address.user_add_street,
            ' ',
            user_address.user_add_barangay,
            ' ',
            user_address.user_add_city,
            ' ',
            user_address.user_add_province
        ) AS address
    FROM
        users
    JOIN user_address ON users.UserID = user_address.UserID;")->fetchAll();
    }

    function Delete ($id)
    {
        try{
        $con = $this->opencon();
        $con->beginTransaction();
        
        $query = $con->prepare("DELETE FROM user_address WHERE UserID = ?");
        $query->execute([$id]);

        $query2 = $con->prepare("DELETE FROM users WHERE UserID = ?");
        $query2->execute([$id]);

        $con->commit();
        return true;
        }catch (PDOException $e){
            $con->rollBack();
            return false;
        }
    }
}