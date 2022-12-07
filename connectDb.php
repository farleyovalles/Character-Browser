<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost"; // default server name
$username = "FO"; // user name that you created
$password = "1234"; // password that you created
$dbname = "OverwatchDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


?>
