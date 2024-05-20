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
    function viewdata($id){
    try{
        $con = $this->opencon();
        $query = $con->prepare("SELECT users.UserID, users.Firstname, users.Lastname, users.Birthday, users.Sex, users.UserName, users.UserPass, user_address.user_add_street, user_address.user_add_barangay, user_address.user_add_city, user_address.user_add_province FROM users JOIN user_address ON users.UserID = user_address.UserID WHERE users.UserID = ?");
        $query->execute([$id]);
        return $query->fetch();
 
    } catch (PDOException $e){
    return [] ;
    }  
}
    function updateUser($user_id, $firstname, $lastname, $birthday,$sex, $username, $password) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE users SET Firstname=?, Lastname=?, Birthday=?, Sex=?, UserName=?, UserPass=? WHERE UserID=?");
        $query->execute([$firstname, $lastname,$birthday,$sex,$username, $password, $user_id]);
        // Update successful
        $con->commit();
        return true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
         $con->rollBack();
        return false; // Update failed
    }
}
 
    function updateUserAddress($user_id, $street, $barangay, $city, $province) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE user_address SET user_add_street=?, user_add_barangay=?, user_add_city=?, user_add_province=? WHERE UserID=?");
        $query->execute([$street, $barangay, $city, $province, $user_id]);
        $con->commit();
        return true; // Update successful
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
        $con->rollBack();
        return false; // Update failed
    }
     
}
}