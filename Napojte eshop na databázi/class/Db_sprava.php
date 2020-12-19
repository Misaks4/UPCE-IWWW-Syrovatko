<?php


class Db_sprava
{
    static function setUserId($email){
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT id FROM db_sprava.table_name WHERE email = '$email'");
        $stmt->execute();
        $dataset = $stmt->fetchAll();
        return $dataset[0][0];
    }

    static function getUserRights($id){
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT role FROM db_sprava.table_name WHERE id = '$id'");
        $stmt->execute();
        $dataset = $stmt->fetchAll();
        return $dataset[0][0];
    }

    static function registerUser($email, $pass, $role){
        $conn = Connection::getPdoInstance();
        $sql = "INSERT INTO table_name (email, heslo, role) VALUES (:email, :heslo, :role)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":heslo", $pass, PDO::PARAM_STR_CHAR);
        $stmt->bindParam(":role", $role, PDO::PARAM_INT);

        $stmt->execute();
    }

    static function userAuthentication($email, $pass){
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT id FROM db_sprava.table_name WHERE email = '$email' AND heslo = '$pass'");
        $stmt->execute();
        $dataset = $stmt->fetchAll();
        return is_numeric($dataset[0][0]);
    }

    static function getUserInformation($id){
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM db_sprava.table_name WHERE id = '$id'");
        $stmt->execute();
        $dataset = $stmt->fetchAll();
        return $dataset;
    }

    static function updateUser($id,$email, $pass, $role){
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("UPDATE db_sprava.table_name SET email='$email', heslo='$pass', role='$role' WHERE id='$id'");
        $stmt->execute();
        return true;
    }
}