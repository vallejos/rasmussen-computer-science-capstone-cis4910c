<?php

$dbHost = "valeljos-db.mysql.database.azure.com";
$dbUsername = "vallejos@valeljos-db";
$dbPassword = "Admin123123123";
$dbSchema = "timetracker";

// Create connection
$dbc = new mysqli($dbHost, $dbUsername, $dbPassword, $dbSchema);

// Check connection
if ($dbc->connect_error) {
    die("Database Connection failed: " . $dbc->connect_error);
}
