<?php
/**
 * Created by PhpStorm.
 * User: Gheoca Victor Manuel
 * Date: 5/7/2019
 * Time: 12:55 PM
 */

include_once('database\Database.php');
session_start();

$errors = array(
    'loggedin' => ''
);

if($_SESSION['login'] == true){
    if(isset($_GET['id_produs']) && !empty($_GET['id_produs'])){
        $id_produs = $_GET['id_produs'];

        $email = $_SESSION['username'];

        $reader = new Reader();
        $creator = new Creator();

        if($_SESSION['seller'] == false){
        $id_client = $reader->getClientId($email);
        } else{
            $id_client = $reader->getSellerId($email);
        }

        $id_lista_cumparaturi = $reader->getShoppingListId($id_client);

        if($id_lista_cumparaturi == -1) {
            $id_lista_cumparaturi = $creator->insertShoppingList($id_client);
        }

        if($id_lista_cumparaturi == -1){
            echo "A aparut o problema!";
        }

        $cantitate = $reader->getPurchasedQuantity($id_lista_cumparaturi, $id_produs);

        if($cantitate == -1) {
            $check = $creator->insertNewItem($id_lista_cumparaturi, $id_produs);
        } else{
            $updater = new Updater();
            $check = $updater->incrementPurchasedQuantity($id_lista_cumparaturi, $id_produs);
            $updater->kill();
        }

        $reader->kill();
        $creator->kill();
        header("Location: ../backend/catalogGenerator.php");
        die();
    } else{
        header("Location: ../frontend/index.php");
        die();
    }
} else{
    $errors['loggedin'] = 'You should login first!';
}
