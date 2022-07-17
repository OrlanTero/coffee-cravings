<?php
include  "../../database.php";
include  "../../system.php";

$MEMBER_ID = $_POST["member_id"];
$MEMBER = [
    "firstname" => $_POST["firstname"],
    "lastname" => $_POST["lastname"],
    "middlename" => $_POST["middlename"],
    "fullname" => $_POST["lastname"] . ", " . $_POST["firstname"] . " " . $_POST["middlename"],
    "phone" => $_POST["phone"],
    "address" => $_POST["address"],
    "email" => $_POST["email"],
];

echo EditMember($MEMBER_ID, $MEMBER, $database);
