<?php
include "../../database.php";
include "../../system.php";

$from = $_POST["fromDate"];
$to = $_POST["toDate"];

echo CreateSalesReport($from, $to, $database);