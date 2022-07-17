<?php
include "../../database.php";
include "../../system.php";
include "../../data.php";

$search = $_POST["search"];
$SALESREPORT = SearchSalesReports($search, null, $database);
echo CreateTable($SALESREPORTINFOHEADERTEXT, $SALESREPORTINFOKEY, $SALESREPORT, "report_id", 5);