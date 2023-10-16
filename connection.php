<?php

// Database credentials
$db_host     = 'localhost';  // Database host
$db_user     = 'root';       // Database user
$db_password = '';           // Database password
$db_name     = 'mathricks';  // Database name

// Create a new mysqli connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Connection successful message (optional, for debugging)
// echo 'Connected successfully to the database';

?>
