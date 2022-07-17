<?php
include  "../../database.php";
include  "../../system.php";

$MEMBER = [
    "firstname" => $_POST["firstname"],
    "lastname" => $_POST["lastname"],
    "middlename" => $_POST["middlename"],
    "phone" => $_POST["phone"],
    "address" => $_POST["address"],
    "email" => $_POST["email"],
];

echo CreateMember($MEMBER, $database);
