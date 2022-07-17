<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$PRODUCT_ID = $_POST["product_id"];
$ITEM = [
    "name" => $_POST["name"],
    "price" => $_POST["price"],
    "category" => $_POST["category"],
];


if (!empty($_FILES["image"]["name"])) {
    echo UploadImageAndEditProduct($PRODUCT_ID, $_FILES["image"], $ITEM, $database);
} else {
    echo EditItem($PRODUCT_ID, $ITEM, $database);
}
