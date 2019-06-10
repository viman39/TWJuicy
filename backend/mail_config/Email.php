<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/10/2019
 * Time: 7:00 PM
 */

class Email{
    private static $from = "juicyprojectb2@gmail.com";
    private static $subject;
    private static $message;
    private static $headers;

    public function addNewSeller($email, $cod){
        self::setSubject("Prola de vanzator la Juicy");
        self::setMessage($cod);
        self::setHeaders();
        self::sent($email);
        self::delete();
    }

    public function newItemSold($email, $quantity, $product){
        self::setSubject("Ai vandut un nou produs!");
        self::setMessage("Felicitari ai vandut $quantity unitati din produsul $product!");
        self::setHeaders();
        self::sent($email);
        self::delete();
    }

    public function purchaseConfirmation($email, $message){
        self::setSubject("Confirmarea comanda!");
        self::setMessage($message);
        self::setHeaders();
        self::sent($email);
        self::delete();
    }

    private function setSubject($subject){
        self::$subject = $subject;
    }

    private function setMessage($text){
        if(strlen($text) == 6){
            self::$message = "Buna ziua! \n Parola dumneavoastra este: " . $text;
        } else{
            self::$message = $text;
        }
    }

    private function setHeaders(){
        self::$headers = "From: ".self::$from;
    }

    private function sent($email){
        mail($email, self::$subject, self::$message, self::$headers);
    }

    private function delete(){
        self::$subject = "";
        self::$message = "";
        self::$headers = "";
    }
}