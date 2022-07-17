<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$filter = $_POST["filter"];
$PRODUCTS = GetProducts(["category" => $filter], $database);
echo CreateTable($PRODUCTTABLEHEADERTEXT, $PRODUCTTABLEBODYKEY, $PRODUCTS, "product_id");
