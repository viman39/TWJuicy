<?php
/**
 * Created by PhpStorm.
 * User: Gheoca Victor Manuel
 * Date: 5/1/2019
 * Time: 9:12 AM
 */

include_once('database\Database.php');
session_start();

$errors = array(
  'email' => '',
  'password' => ''
);

if(isset($_POST['email']) && !empty($_POST['email'])){
    if(isset($_POST['passd']) && !empty($_POST['passd'])){
        $email = $_POST['email'];
        $password = $_POST['passd'];
        $password = md5($password);
        $clienti = "clienti";

        $reader = new Reader();
        $result = $reader->clientExists($email, $password);

        if($result == true){
            $_SESSION['login'] = true;
            $_SESSION['username'] = $email;
            $_SESSION['seller'] = false;
            $reader->kill();
            header("Location: ../backend/catalogGenerator.php");
            die();
        } else{
            $result = $reader->sellerExists($email, $password);

            if($result == true){
                $_SESSION['login'] = true;
                $_SESSION['username'] = $email;
                $_SESSION['seller'] = true;
                $reader->kill();
                header("Location: ../backend/productsManager.php");
                die();
            }
        }

        $reader->kill();
        session_destroy();
        header("Location: ../frontend/index.php");
        die();
    } else{
        $errors['passd'] = 'Please insert your password!';
    }
} else{
    $errors['email'] = 'Please insert your email!';
}
?>
