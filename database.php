<?php

$DATABASE_HOST = "localhost";

$DATABASE_NAME = "coffee-cravings";

$DATABASE_USER = "root";

$DATABASE_PASSWORD = "";

$database = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASSWORD);