<?php
// SQLite database file path
$db_file = 'G:\Program Files\sqlite\ecommerce.db';

// Create database connection
$conn = new SQLite3($db_file);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}
?>