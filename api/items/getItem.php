<?php
include  "../../database.php";
include  "../../system.php";

echo json_encode(GetProduct($_POST["item"], $database));
