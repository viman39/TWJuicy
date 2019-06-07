<?php
/**
 * Created by PhpStorm.
 * User: Gheoca Victor Manuel
 * Date: 5/3/2019
 * Time: 9:43 AM
 */

include_once('database\Database.php');
session_start();

$errors = array(
    'name' => '',
    'flavor' => '',
    'price' => '',
    'path' => '',
    'quantity' => ''
);

if($_SESSION['login'] == true and $_SESSION['seller'] == true) {
    if (isset($_POST['productName']) && !empty($_POST['productName'])) {
        if (isset($_POST['flavours']) && !empty($_POST['flavours'])) {
            if (isset($_POST['price']) && !empty($_POST['price'])) {
                if(isset($_POST['quantity']) && !empty($_POST['quantity'])){
                    if (isset($_POST['submit'])) {
                        $productName = $_POST['productName'];
                        $flavours = $_POST['flavours'];
                        $price = $_POST['price'];
                        $file = $_FILES['file'];
                        $quantity = $_POST['quantity'];

                        $fileName = $file['name'];

                        $fileTokens = explode('.', $fileName);
                        $fileExtension = strtolower(end($fileTokens));

                        $allowed = array('jpeg', 'png', 'jpg');

                        if (in_array($fileExtension, $allowed)) {
                            if ($file['error'] === 0) {
                                if ($file['size'] < 1000000) {
                                    $email = $_SESSION['username'];

                                    $newFileName = $email . '_' . $productName . "." . $fileExtension;
                                    $fileDestination = 'products/' . $newFileName;

                                    move_uploaded_file($file['tmp_name'], $fileDestination);

                                    $reader = new Reader();
                                    $id_seller = $reader->getSellerId($email);

                                    $creator = new Creator();
                                    $sour = isset($_POST['sour']) ? 1 : 0;
                                    $check = $creator->insertProduct($id_seller, $productName, $price, $sour, $flavours, $newFileName);

                                    if (!$check) {
                                        echo 'Database error!';
                                    }

                                    $id_product = $reader->getProductId($id_seller, $productName);

                                    $check = $creator->insertDetine($id_seller, $id_product, $quantity);

                                    if (!$check) {
                                        echo 'Database error!';
                                    }

                                    $creator->kill();
                                    $reader->kill();
                                    header("Location: ../frontend/index.php");
                                    die();
                                } else {
                                    $errors['path'] = 'Your photo is too big!';
                                }
                            } else {
                                $errors['path'] = 'There was an error uploading your file!';
                            }
                        } else {
                            $errors['path'] = 'The file should have png, jpg or jpeg extension!';
                        }
                    } else {
                        $errors['path'] = 'Please select a representative photo!';
                    }
                } else{
                    $errors['quantity'] = 'You need at least 50 pieces to sell!';
                }
            } else {
                $errors['price'] = 'Please select a price!';
            }
        } else {
            $errors['flavor'] = 'Please select some flavours!';
        }
    } else {
        $errors['name'] = 'Please select a name!';
    }
} else{
    header("Location: ../frontend/index.php");
}
