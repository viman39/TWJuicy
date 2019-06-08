<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/5/2019
 * Time: 7:12 PM
 */

class Updater{
    private static $conn;

    public function __construct(){
        self::$conn = Database::getConnection();
    }

    public function incrementPurchasedQuantity($id_lista_cumparaturi, $id_produs){
        $stmt = self::$conn->prepare("UPDATE cantitate_cumparata SET cantitate=cantitate+1 WHERE id_lista_cumparaturi=? and id_produs=?;");
        $stmt->bind_param('ii', $id_lista_cumparaturi, $id_produs);
        $check = $stmt->execute();
        $stmt->close();
        return $check;
    }

    public function kill(){
        self::$conn->close();
    }
}