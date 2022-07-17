<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$search = $_POST["search"];
$filter = empty($_POST["filter"]) ?  null : ["category" => $_POST["filter"]];
$PRODUCTS = SearchProducts($search, $filter, $database);
echo CreateTable($PRODUCTTABLEHEADERTEXT, $PRODUCTTABLEBODYKEY, $PRODUCTS, "product_id");
