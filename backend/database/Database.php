<?php
include_once('Creator.php');
include_once('Reader.php');
include_once('Updater.php');
include_once('Deleter.php');

define('DB_HOST', 'localhost');
define('DB_NAME', 'juicy');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

class Database{
    private static $conn;

    private function _constructor(){}

    public static function getConnection (){
        if(!self::$conn){
            self::$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }
        return self::$conn;
    }

    public static function close(){
        return self::$conn ? self::$conn->close() : true;
    }

}