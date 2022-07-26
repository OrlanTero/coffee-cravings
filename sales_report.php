<?php

include "./system.php";
include "./database.php";
include  "./data.php";

$REPORT_ID = $_GET["report_id"];

if (!isset($REPORT_ID)) {
    header("Location: index.php");
}

$REPORT = GetSalesReportRecord($REPORT_ID, $database);
$ORDERS = GetSalesReportOrders($REPORT_ID, $database);
$POPULARS = GetSalesReportPopular($REPORT_ID, $database);
$ORDERIDS = array_column($ORDERS, "order_id");
$QUANTITIES = array_column($ORDERS, "order_quantity");
$POPULARIDS = array_column($POPULARS, "product_id");

$POPULARPRODUCTS = array_map(function ($id, $q, $db) {
    $product = GetProduct($id, $db);
    $product["quantities"] = $q;
    return $product;
}, $POPULARIDS, $QUANTITIES, array_fill(0, count($POPULARIDS), $database));

$ORDERS = array_map(function ($id, $db) {
    return GetOrder($id, $db);
}, $ORDERIDS, array_fill(0, count($ORDERIDS), $database));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" constent="width=device-width, initial-scale=1.0">
    <title>Coffee 'n Cravings</title>

    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="program-content">
        <div class="main-header">
            <div class="header-top">
                <div class="top-button">
                    <a href="./index.php" class="text-button">
                        <div class="icon">
                            <?php echo UseIcon("back") ?>
                        </div>
                        <div class="text">
                            <span>BACK</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="header-bot">
                <div class="header-left">
                    <span>Welcome to Coffee N' Cravings Management System!</span>
                    <p>Sales Report Created!</p>
                </div>
                <div class="header-right"></div>
            </div>
        </div>
        <div class="main-body">
            <div class="center-container">
                <div class="grid-table-container">
                    <div class="table-info-container start">
                        <div class="info-left">
                            <div class="title">
                                <h1>SALES REPORT FOR <?php echo $REPORT["from_date"] . " TO " . $REPORT["to_date"]?>
                                </h1>
                            </div>
                        </div>
                        <div class="info-right">
                            <h2>Total Sales: PHP <?php echo $REPORT["total_sales"] ?></h2>
                        </div>
                    </div>
                    <div class="flex-content">
                        <div class="table-content" style="width: 65%">
                            <?php echo CreateTable(["Date Made", "Order ID", "Final Amount"], ["date_made", "order_id", "final_amount"], $ORDERS, "order_id", -1, true, false) ?>
                        </div>

                        <div class="double-table">

                            <div class="top">
                                <div class="title">
                                    <div class="text">
                                        <h3>Top 10 Most Frequently Bought Item</h3>
                                        <p><?php echo $REPORT["date_made"] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="bot">
                                <?php echo CreateTable(["Item Name", "Purchase Quantity"], ["name", "quantities"], $POPULARPRODUCTS, "product_id", -1, true) ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="popup-container"></div>
    </div>

    <!-- <script src="./assets/js/salesreports.js" type="module"></script> -->
</body>

</html>