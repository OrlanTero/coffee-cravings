<?php
include "../../database.php";
include "../../system.php";

$REPORTS = explode(",", $_POST["reports"]);
echo RemoveSalesReports($REPORTS, $database);