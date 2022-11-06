<!DOCTYPE HTML>
<html lang="eng">
<head>
    <title>SHOPPING CART</title>
    <style>
        body {
            background: #e3e3e3;
            display: flex;
            align-content: center;
            justify-content: center;
            font-family: "Consolas", "Courier New", monospace;
            color: #2d4ae5;
        }

        .paper-slip {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            background: #FFF;
            width: 22rem;
            padding: 1rem 2rem;
            --mask: conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) 50%/30px 100%;
            -webkit-mask: var(--mask);
            mask: var(--mask);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .paper-slip div {
            width: 100%;
        }

        .receipt-title {
            text-align: center;
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 3px 0 0 currentColor;
        }

        .paper-slip .receipt-body p {
            margin: 0.25rem 0 0.3rem 0;
        }

        .receipt-header {
            text-align: center;
        }

        .receipt-body {
            text-align: left;
        }

        .receipt-body .extra {
            margin-left: 1rem;
        }

        .product-price {
            float: right;
        }

        .extra-bold {
            text-shadow: 2px 0 0 currentColor;
            font-weight: 800;
        }

        .receipt-footer {
            margin-bottom: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>
<body>
<?php
require "app/controllers/ShopController.php";
require "app/enums/ElectronicItemType.php";
require "app/models/ElectronicItem.php";
require "app/models/Television.php";
require "app/models/Console.php";
require "app/models/Microwave.php";
require "app/models/Controller.php";
require "app/models/RemoteController.php";
require "app/models/WiredController.php";

use Shop\Products\Console;
use Shop\Products\Microwave;
use Shop\Products\RemoteController;
use Shop\Products\Television;
use Shop\Products\WiredController;
use Shop\ShopController;

/**
 * =============================================
 * SHOPPING CART
 * =============================================
 */

// PlayStation 4
$consoleExtras = [
    new RemoteController("Sony Wireless Controller", "", 50.00),
    new RemoteController("Sony Wireless Controller", "", 50.00),
    new WiredController("Sony Controller", "", 20.00),
    new WiredController("Sony Controller", "", 20.00)
];
$playStation = new Console("PlayStation 4", "Playstation 4 with no accessories", 230, $consoleExtras);

// TV 1
$samsungTvExtras = [
    new RemoteController("Samsung Wireless Controller", "", 15.00),
    new RemoteController("Samsung Wireless Controller", "", 15.00),
];
$samsungTv = new Television("Samsung LCD TV 42 in", "Samsung LCD TV 42 inches, full HD, wall mount and smart gestures.", 699, $samsungTvExtras);

// TV2
$vintageTvExtras = [
    new RemoteController("Vintage remote controller", "", 15.00),
];
$vintageTv = new Television("Old 70's vintage CTR TV", "Old TV from the 50's in perfect working conditions.", 150, $vintageTvExtras);

// Microwave
$microwave = new Microwave("Mini microwave oven 400W", "Very practical and economic microwave oven.", 130);

// Checkout
$shoppingCart = new ShopController();
$shoppingCart->addItems([$playStation, $samsungTv, $vintageTv, $microwave]);
$receiptData = $shoppingCart->checkout();
?>
<section>
    <div class="paper-slip">
        <div class="receipt-header">
            <pre>
    __________
   /          /|
 /__________/  |
 |________ |   |
 /_____  /||   |
|".___."| ||   |
|_______|/ |   |
 || .___."||  /
 ||_______|| /
 |_________|/
            </pre>
            <h1 class="receipt-title">RECORDS ON TIME</h1>
            <p>=========================================</p>
            <p class="text-left extra-bold">POS INVOICE</p>
        </div>
        <div class="receipt-body">
            <?php
            foreach ($receiptData as $item) {
                echo "<p>◆ <b>{$item['name']} <span class='product-price'>$ {$item['price']}</span></b></p>";
                if (!empty($item['extras'])) {
                    foreach ($item['extras'] as $extra) {
                        echo "<p class='extra'><b>+</b> {$extra['name']} <span class='product-price'>$ {$extra['price']}</span></p>";
                    }
                    echo "<p><span class='product-price extra-bold'>Subtotal: $ {$item['subTotal']}</span></p><br>";
                }
                echo "<p>----------------------------------------</p>";
            }
            ?>
        </div>
        <div class="receipt-footer">
            <p><span class='product-price extra-bold'>TOTAL: $ <?php echo $shoppingCart->getTotal(); ?></span></p>
            <br>
            <br>
            <p class="text-center">Thanks for your purchase (*^_^*)</p>
        </div>
    </div>
</section>
</body>
</html>
