<?php
// Database connection parameters
$username = 'system'; // Replace with your Oracle username
$password = 'admin123'; // Replace with your Oracle password
$host = 'localhost'; // Replace with your Oracle host (e.g., localhost)
$port = '1521'; // Replace with your Oracle port (e.g., 1521)
$service_name = 'xe'; // Replace with your Oracle service name

// Database connection string
$dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVICE_NAME=$service_name)))";

// Attempt to establish a connection to the Oracle database
try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Terminate script execution if connection fails
}
?>