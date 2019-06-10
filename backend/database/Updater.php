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

    public function newPurchasedQuantity($id_lista_cumparaturi, $id_produs, $cantitate){
        $stmt = self::$conn->prepare("UPDATE cantitate_cumparata SET cantitate=? WHERE id_lista_cumparaturi=? and id_produs=?;");
        $stmt->bind_param('iii', $cantitate, $id_lista_cumparaturi, $id_produs);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function updateProductQuantity($id_produs, $quantity){
        if($quantity == 0){
            $stmt = self::$conn->prepare("UPDATE detine SET cantitate = 0 WHERE id_produs=?");
            $stmt->bind_param('i', $id_produs);
        } else{
            $stmt = self::$conn->prepare("UPDATE detine SET cantitate=cantitate+? WHERE id_produs=?;");
            $stmt->bind_param('ii', $quantity, $id_produs);
        }
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function updatePlateste_pentruFinalizare($id_lista_cumparaturi){
        $stmt = self::$conn->prepare("UPDATE plateste_pentru SET finalizare = 1 WHERE id_lista_cumparaturi=?");
        $stmt->bind_param('i', $id_lista_cumparaturi);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function kill(){
        self::$conn->close();
    }
}