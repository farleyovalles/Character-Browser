<?php
// CSci 130 - Web Programming

// Initialize the database

$servername = "localhost"; // default server name
$username = "FO"; // user name that you created
$password = "1234"; // password that you created
$dbname = "OverwatchDB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";

// Creation of the database
$sql = "CREATE DATABASE ". $dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database ". $dbname ." created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}

// close the connection
$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully <br>";

// Create Table
$sql = "CREATE TABLE Characters (
pkey INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name  VARCHAR(30) NOT NULL,
gender  VARCHAR(6) NOT NULL,
releaseYear INT(4) NOT NULL,
hitscan TINYINT NOT NULL,
role VARCHAR(7) NOT NULL,
image VARCHAR(50) NOT NULL
)";


if ($conn->query($sql) === TRUE) {
    echo "Table Characters created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

// close the connection
$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully <br>";

$filename = ("data.json");

$json_data = file_get_contents($filename);
$characters = json_decode($json_data, true);

foreach($characters as $row) {
  
    // Database query to insert data 
    // into database Make Multiple 
    // Insert Query 
    $sql = 
    "INSERT INTO `Characters`( `name`, `gender`, `releaseYear`, `hitscan`, `role`, `image`) VALUES 
    ('".$row["name"]."', '".$row["gender"]."', '".$row["releaseYear"]."', '".$row["hitscan"]."', '".$row["role"]."',
    '".$row["imageLink"]."'); "; 

    
    if ($conn->multi_query($sql) === TRUE) {  // notice the difference MULTI query
        echo "New record created successfully. <br>";
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
     }
}

?>