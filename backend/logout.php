<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/5/2019
 * Time: 4:58 PM
 */

session_start();
session_destroy();
header('Location: ../frontend/index.php');
die();