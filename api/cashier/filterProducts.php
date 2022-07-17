<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$filter = $_POST["filter"];
$PRODUCTS = GetProducts($filter !== "ALL" ? ["category" => $filter] : null, $database);
echo CreateProductTableOfItems($PRODUCTS, $PRODUCTIMAGEPATHUPLOADS);
