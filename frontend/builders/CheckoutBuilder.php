<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/10/2019
 * Time: 5:10 PM
 */

class CheckoutBuilder{
    public static $head = 0;
    public static $tail = 0;

    public function __construct(){
        if( self::$head == 0 ){
            self::buildHead();
            self::$head = 1;
            return true;
        }
        return false;
    }

    private function buildHead(){
        ?>
        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
            <link rel="stylesheet" type="text/css" href="../css/checkout.css">
            <title>Checkout</title>
        </head>
        <body style="background-image: linear-gradient(-45deg, yellow, lightyellow)">

        <form action="../backend/finishOrder.php" method="post" name="checkout">
            <div class="row">
<?php
    }

    public function buildPersonalInformation(){
        ?>
                <div class="column">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" required><br/>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required><br/>
                    <label for="fullAddress">Full Address</label>
                    <input type="text" id="fullAddress" name="fullAddress" required><br/>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required><br/>

                    <div class="row">
                        <div class="column">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" required>
                        </div>
                        <div class="column">
                            <label for="zipCode">Zip code</label>
                            <input type="text" id="zipCode" name="zipCode" required>
                        </div>
                    </div>
                </div>
<?php
    }

    public function buildCardInformation(){
        ?>
                <div class="column">
                    <label for="fullNameOnCard">Full name on card</label>
                    <input type="text" id="fullNameOnCard" name="fullNameOnCard" required><br/>
                    <label for="creditCardNumber">Credit card Number</label>
                    <input type="text" id="creditCardNumber" name="creditCardNumber" required><br/>
                    <label for="expMonth">Exp Month</label>
                    <input type="text" min="01" max="12" id="expMonth" name="expMonth" required><br/>
                    <label for="expYear">Exp Year</label>
                    <input type="text" id="expYear" name="expYear" required><br/>
                </div>
<?php
    }

    public function startBuildTotal(){
        ?>
            </div>
            <div class="shoppingList">
                <table style="width = 100%">
                    <tr>
                        <th>Nume produs</th>
                        <th>Cantitate cumparata</th>
                        <th>Pret</th>
                        <th>Total</th>
                    </tr>
<?php
    }

    public function addItemTotal($nume, $cantitate, $pret){
        ?>
                    <tr>
                        <td><?php echo $nume ?></td>
                        <td><?php echo $cantitate ?></td>
                        <td><?php echo $pret ?></td>
                        <td><?php echo $pret*$cantitate ?></td>
                    </tr>
<?php
    }

    public function endBuildTotal($total){
        ?>
                </table>
            <h3>Total: <?php echo $total ?></h3>
            </div>
            <div class="checkoutBtnDiv"><input class="checkoutBtn" type="submit" value="Finish Order"/></div>
<?php
    }

    public function buildTail(){
        ?>
        </form>
        </body>
<?php
    }
}