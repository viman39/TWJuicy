<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/5/2019
 * Time: 7:06 PM
 */

class Reader{
    private static $conn;

    public function __construct(){
        self::$conn = Database::getConnection();
    }

    public function clientExists($email, $password){
        $stmt = self::$conn->prepare("SELECT * FROM clienti WHERE email=? and parola=?;");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if($result->num_rows > 0 ){
            $result->close();
            return true;
        } else{
            $result->close();
            return false;
        }
    }

    public function sellerExists($email, $password){
        $stmt = self::$conn->prepare("SELECT * FROM vanzator WHERE email=? and parola=?;");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if($result->num_rows > 0 ){
            $result->close();
            return true;
        } else{
            $result->close();
            return false;
        }
    }
}