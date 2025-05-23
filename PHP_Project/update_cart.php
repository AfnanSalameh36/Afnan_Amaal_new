<?php
global $conn;
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "error" => "Please log in to update cart"]);
    exit;
}

$user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];

if (!isset($_POST["product_id"]) || !is_numeric($_POST["product_id"]) || !isset($_POST["quantity"]) || !is_numeric($_POST["quantity"])) {
    echo json_encode(["success" => false, "error" => "Invalid product ID or quantity"]);
    exit;
}

$product_id = (int)$_POST["product_id"];
$quantity = (int)$_POST["quantity"];

$sql = "UPDATE cart_items SET quantity = ? WHERE product_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $quantity, $product_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Quantity updated"]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to update quantity"]);
}

$stmt->close();
$conn->close();
?>
