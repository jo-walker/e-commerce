<?php

$servername = "localhost";
$username = "admin_a2";
$password = "CST8285_A2.";
$dbname = "e-commerce";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  error_log("Connection successful", 3, "logfile.log");
  ?>
  