<?php
include  "../../database.php";
include  "../../system.php";

$PRODUCTS = GetProducts(null, $database);
$HEADER = ["Item ID", "Item Name", "Item Price", "Item Category", "Item Image"];
$BODYKEY = ["product_id", "name", "price", "category", "image"];
echo CreateTable($HEADER, $BODYKEY, $PRODUCTS, "product_id");
