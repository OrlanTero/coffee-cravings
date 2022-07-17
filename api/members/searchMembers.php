<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$search = $_POST["search"];
$MEMBERS = SearchMembers($search, null, $database);

echo CreateTable(
    $MEMBERSTABLEHEADERTEXT,
    $MEMBERSTABLEBODYKEY,
    $MEMBERS,
    "member_id",
    7
);
