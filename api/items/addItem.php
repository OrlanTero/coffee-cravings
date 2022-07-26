<?php
include "../../database.php";
include "../../system.php";
include "../../data.php";

$ITEM = [
    "name" => $_POST["name"],
    "price" => $_POST["price"],
    "category" => $_POST["category"],
];

echo UploadImageAndCreateProduct($_FILES["image"], $ITEM, $database);