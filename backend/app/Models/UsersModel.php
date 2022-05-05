<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;


class UsersModel {    
 
    public function checkUser($username) {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `admins`
            WHERE `username` = :username";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':username', $username, PDO::PARAM_STR);
        
        $pdoStatement->execute();
        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $row['password'];
    }
}