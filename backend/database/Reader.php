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

    public function getClientId($email){
        $stmt = self::$conn->prepare("SELECT id_client FROM clienti WHERE email = ?;");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($result->num_rows == 0){
            $result->close();
            return -1;
        }
        $row = $result->fetch_assoc();
        $result->close();
        return $row['id_client'];
    }

    public function getSellerId($email){
        $stmt = self::$conn->prepare("SELECT id_vanzator FROM vanzator WHERE email = ?;");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($result->num_rows == 0){
            $result->close();
            return -1;
        }
        $row = $result->fetch_assoc();
        $result->close();
        return $row['id_vanzator'];
    }

    public function getProductId($id_seller, $product_name){
        $stmt = self::$conn->prepare("SELECT id_produs FROM produse WHERE id_vanzator=? and nume=?;");
        $stmt->bind_param('is', $id_seller, $product_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        $result->close();
        return $row['id_produs'];
    }

    public function getProduct($id_produs){
        $stmt = self::$conn->prepare("SELECT * FROM produse WHERE id_produs=?;");
        $stmt->bind_param('i', $id_produs);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        $result->close();

        return $row;
    }

    public function getProducts(){
        $result_produse = self::$conn->query("SELECT * FROM produse;");

        return $result_produse;
    }

    public function getProductsFrom($id_vanzator){
        $stmt = self::$conn->prepare("SELECT * FROM produse WHERE id_vanzator=?;");
        $stmt->bind_param('i', $id_vanzator);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getShoppingListId($id_client, $vanzator){
        $stmt = self::$conn->prepare("SELECT * FROM plateste_pentru WHERE id_client=? and finalizare=0 and vanzator=?;");
        $stmt->bind_param('ii', $id_client, $vanzator);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($result->num_rows == 0){
            $result->close();
            return -1;
        }
        $row = $result->fetch_assoc();
        $result->close();

        return $row['id_lista_cumparaturi'];
    }

    public function getPurchasedQuantity($id_lista_cumparaturi, $id_produs){
        $stmt = self::$conn->prepare("SELECT * FROM cantitate_cumparata WHERE id_lista_cumparaturi=? and id_produs=?;");
        $stmt->bind_param('ii', $id_lista_cumparaturi, $id_produs);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($result->num_rows == 0){
            $result->close();
            return -1;
        }
        $row = $result->fetch_assoc();
        $result->close();

        return $row['cantitate'];
    }

    public function getLastShoppingListId(){
        $result = self::$conn->query("SELECT * FROM lista_cumparaturi ORDER BY id_lista_cumparaturi DESC;");
        $row = $result->fetch_assoc();
        $id_lista_cumparaturi = $row['id_lista_cumparaturi'];
        $result->close();

        return $id_lista_cumparaturi;
    }

    public function getShoppingList($id_lista_cumparaturi){
        $stmt = self::$conn->prepare("SELECT * FROM cantitate_cumparata WHERE id_lista_cumparaturi=?;");
        $stmt->bind_param('i', $id_lista_cumparaturi);
        $stmt->execute();
        $result_lista_cumparaturi = $stmt->get_result();
        $stmt->close();

        return $result_lista_cumparaturi;
    }

    public function getOwnedQuantity($id_produs){
        $stmt = self::$conn->prepare("SELECT * FROM detine WHERE id_produs=?;");
        $stmt->bind_param('i', $id_produs);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $result->close();

        return $row['cantitate'];
    }

    public function getUserId($email){
        $user_id = self::getClientId($email);
        if($user_id == -1)
            $user_id = self::getSellerId($email);

        return $user_id;
    }

    public function getSeller($id_vanzator){
        $stmt = self::$conn->prepare("SELECT * FROM vanzator WHERE id_vanzator=?");
        $stmt->bind_param('i', $id_vanzator);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        $result->close();

        return $row;
    }

    public function getCustomProducts($search){
        if($search == ""){
            return self::getProducts();
        }
        $search = "%$search%";
        $sql = "SELECT * FROM produse WHERE nume LIKE ? OR arome LIKE ?;";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param('ss', $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function kill(){
        self::$conn->close();
    }
}