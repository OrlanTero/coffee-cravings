<?php
include  "../../database.php";
include  "../../system.php";
include  "../../data.php";

$MEMBERS = GetMembers(null, $database);
echo CreateTable(
    $MEMBERSTABLEHEADERTEXT,
    $MEMBERSTABLEBODYKEY,
    $MEMBERS,
    "member_id",
    7
);
