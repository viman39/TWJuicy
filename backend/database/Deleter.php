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

}