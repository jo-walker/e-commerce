<?php

$servername = "localhost";
$username = "admin_a2";
$password = "CST8285_A2.";

// Create database connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
  ?>
  