<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/5/2019
 * Time: 7:12 PM
 */

class Deleter{
    private static $conn;

    public function __construct(){
        self::$conn = Database::getConnection();
    }

    public function deleteProduct($id_produs){
        $stmt = self::$conn->prepare("DELETE FROM produse WHERE id_produs=?;");
        $stmt->bind_param('i', $id_produs);
        $check = $stmt->execute();
        $stmt->close();

        self::deleteProductFromCantitate_cumparata($id_produs, -1);
        self::deleteProductFromDetine($id_produs);

        return $check;
    }

    public function deleteProductFromCantitate_cumparata($id_produs, $id_lista_cumparaturi){
        if($id_lista_cumparaturi == -1){
            $stmt = self::$conn->prepare("DELETE FROM cantitate_cumparata WHERE id_produs=?");
            $stmt->bind_param('i', $id_produs);
        } else{
            $stmt = self::$conn->prepare("DELETE FROM cantitate_cumparata WHERE id_produs=? and id_lista_cumparaturi=?;");
            $stmt->bind_param('ii', $id_produs, $id_lista_cumparaturi);
        }

        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function kill(){
        self::$conn->close();
    }

    public function deleteProductFromDetine($id_produs){
        $stmt = self::$conn->prepare("DELETE FROM detine WHERE id_produs=?;");
        $stmt->bind_param('i', $id_produs);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }
}