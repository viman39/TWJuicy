<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/5/2019
 * Time: 7:11 PM
 */

class Creator{
    private static $conn;

    public function __construct(){
        self::$conn = Database::getConnection();
    }

    public function insertProduct($id_seller, $productName, $price, $sour, $flavours, $photo_path){
        $stmt = self::$conn->prepare("INSERT INTO produse(id_vanzator, nume, pret, acidulat, arome, path_poza) VALUES(?, ?, ?, ?, ?, ?);");
        $stmt->bind_param('isiiss', $id_seller, $productName, $price, $sour, $flavours, $photo_path);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function insertDetine($id_seller, $id_product, $quantity){
        $stmt = self::$conn->prepare("INSERT INTO detine(id_vanzator, id_produs, cantitate) VALUES(?, ?, ?);");
        $stmt->bind_param('iii', $id_seller, $id_product, $quantity);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function insertVanzator($email, $cod){
        $stmt = self::$conn->prepare("INSERT INTO vanzator(id_vanzator, email, parola) VALUES(?, ?, ?)");
        $id_vanzator = self::$conn->insert_id;
        $stmt->bind_param('iss', $id_vanzator, $email, $cod);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function insertShoppingList($id_client, $vanzator){
        $check = self::insertShoppingListId();

        $reader = new Reader();
        $id_lista_cumparaturi = $reader->getLastShoppingListId();

        $check = self::insertShoppingListToClient($id_client, $id_lista_cumparaturi, $vanzator);

        return $check ? $id_lista_cumparaturi : -1;
    }

    public function insertShoppingListId(){
        $id_lista_cumparaturi = self::$conn->insert_id;
        $stmt = self::$conn->prepare("INSERT INTO lista_cumparaturi(id_lista_cumparaturi) VALUES(?);");
        $stmt->bind_param('i', $id_lista_cumparaturi);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function insertShoppingListToClient($id_client, $id_lista_cumparaturi, $vanzator){
        $stmt = self::$conn->prepare("INSERT INTO plateste_pentru(id_client, id_lista_cumparaturi, finalizare, vanzator) VALUES (?,?,?,?);");
        $finalizare = 0;
        $stmt->bind_param('iiii', $id_client, $id_lista_cumparaturi, $finalizare, $vanzator);
        $check = $stmt->execute();
        $stmt->close();

        return $check;
    }

    public function insertNewItem($id_lista_cumparaturi, $id_produs){
        $stmt = self::$conn->prepare("INSERT INTO cantitate_cumparata(id_lista_cumparaturi, id_produs, cantitate) VALUES(?, ?, ?);");
        $cantitate = 1;
        $stmt->bind_param('iii', $id_lista_cumparaturi, $id_produs, $cantitate);
        $check = $stmt->execute();
        return $check;
    }

    public function insertNewClient($address, $email, $name, $surname, $password){
        $id = self::$conn->insert_id;
        $stmt = self::$conn->prepare("INSERT INTO clienti(id_client, adresa, email, nume, prenume, parola) VALUES(?, ?, ?, ?, ?, ?);");
        $stmt->bind_param('isssss', $id, $address, $email, $name, $surname, $password);
        $check = $stmt->execute();

        return $check;
    }

    public function kill(){
        self::$conn->close();
    }
}