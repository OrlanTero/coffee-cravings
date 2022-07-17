<?php
include "../../database.php";
include "../../system.php";
include "../../data.php";

$SALESREPORT = GetSalesReports(null, $database);
echo CreateTable($SALESREPORTINFOHEADERTEXT, $SALESREPORTINFOKEY, $SALESREPORT, "report_id", 5);