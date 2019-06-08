<?php
/**
 * Created by PhpStorm.
 * User: Gheoca Victor Manuel
 * Date: 5/3/2019
 * Time: 12:12 PM
 */

include_once('database\Database.php');
session_start();

$error = '';

if(isset($_POST['emailSeller']) && !empty(['emailSeller'])){
    $email = $_POST['emailSeller'];
    $cod = rand(100000, 999999);
    $password = md5($cod);

    $reader = new Reader();
    $check = $reader->getSellerId($email);

    if($check == -1){
        $check = $reader->getClientId($email);
        if($check == -1) {
            $creator = new Creator();
            $check = $creator->insertVanzator($email, $cod);

            if ($check) {
                $from = "juicyprojectb2@gmail.com";
                $subject = "Password";
                $message = "Buna ziua! \n Parola dumneavoastra este: " . $cod;
                $headers = "From: " . $from;
                mail($email, $subject, $message, $headers);
            } else {
                echo 'Database error!';
            }

            $creator->kill();
            $reader->kill();
            header('location:../frontend/index.php');
            die();
        } else {
            $error = 'This email is already in use!';
        }
    } else {
        $error = 'This email is already in use!';
    }
} else{
    $error = 'Please insert your email first!';
}