<?php
include  "../../database.php";
include  "../../system.php";


$ITEMS = explode(",", $_POST["items"]);
echo RemoveItems($ITEMS, $database);
