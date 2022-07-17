<?php
include  "../../database.php";
include  "../../system.php";

echo json_encode(CreateOrderItem($_POST["item"], $database));
