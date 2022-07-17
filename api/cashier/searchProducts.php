<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$search = $_POST["search"];
$category = $_POST["category"];
$PRODUCTS = SearchProducts($search, $category === "ALL" ? null : ["category" => $category], $database);
echo CreateProductTableOfItems($PRODUCTS, $PRODUCTIMAGEPATHUPLOADS);
