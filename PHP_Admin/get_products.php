<?php
global $conn;
include '../PHP_Project/db_connection.php'; // عدل المسار حسب مشروعك
header('Content-Type: application/json');

$sql = "SELECT * FROM products ORDER BY product_id DESC";
$result = $conn->query($sql);

$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
