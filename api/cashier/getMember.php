<?php
include  "../../database.php";
include  "../../system.php";

$ID = $_POST["member"];
echo json_encode(GetMember($ID, $database));
