<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// AJAX request handling
require_once '..\..\..\database\connection.php';
require_once '..\..\..\database\queries.php';
if (isset($_GET['action']) && $_GET['action'] == 'fetchDetails' && isset($_GET['productID'])) {
    header('Content-Type: application/json');
    $productID = intval($_GET['productID']);
    echo json_encode(getProductDetails($productID)); // getProductDetails should return the JSON structure you need
    exit;
}
?>