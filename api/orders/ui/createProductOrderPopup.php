<?php

require __DIR__ . "../../../../database.php";
include "../../../system.php";
include "../../../data.php";

$ORDER_ID = $_POST["order"];
$ORDER = GetOrder($ORDER_ID, $database);
$PRODUCTS = GetProductOrders(["order_id" => $ORDER_ID], $database);
$MAPPED = array_map(function ($prod, $db) {
    $prod["name"] = GetProduct($prod["product_id"], $db)["name"];
    return $prod;
}, $PRODUCTS, array_fill(0, count($PRODUCTS), $database));
?>

<div class="popup-container-parent">
    <div class="popup-background"></div>
    <div class="popup-content">
        <div class="popup-long-container">
            <div class="popup-close-button">
                <div class="icon">
                    <?php echo UseIcon("close") ?>
                </div>
            </div>
            <div class="popup-header"></div>
            <div class="popup-body">
                <div class="center-container">
                    <div class="grid-table-container">
                        <div class="table-info-container">
                            <div class="info-left">
                                <div class="headline">
                                    <div class="sub-title">
                                        <h3>ORDER ID: <?php echo $ORDER["order_id"] ?></h3>
                                        <h3>ORDER PRE ID: <?php echo $ORDER["pre_order_id"] ?></h3>
                                    </div>
                                    <div class="title">
                                        <h1>ORDER DETAILS</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="info-right">
                            </div>
                        </div>
                        <div class="table-content">
                            <?php echo CreateTable(
                                ["Item ID", "Product ID", "Purchase Quantity", "Price", "Subtotal"],
                                ["product_order_id", "name", "quantity", "price", "total"],
                                $MAPPED,
                                "order_id",
                                -1,
                                true
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>