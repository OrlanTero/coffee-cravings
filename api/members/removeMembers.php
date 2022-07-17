<?php
include  "../../database.php";
include  "../../system.php";

$MEMBERS = explode(",", $_POST["members"]);

echo RemoveMembers($MEMBERS, $database);
