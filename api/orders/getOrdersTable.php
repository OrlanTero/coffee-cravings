<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$ORDERS = GetOrders(null, $database);
echo CreateTable($ORDERSSTABLEHEADERTEXT, $ORDERSSTABLEBODYKEY, $ORDERS, "order_id", 9, true);