<?php
global $conn;
session_start();
require 'db_connection.php';

// التحقق من تسجيل الدخول وجلب user_id
if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "error" => "Please log in to remove items"]);
    exit;
}

$user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];

// التحقق من وجود cart_id
if (!isset($_POST["cart_id"]) || !is_numeric($_POST["cart_id"])) {
    echo json_encode(["success" => false, "error" => "Invalid product ID"]);
    exit;
}

$product_id = (int)$_POST["cart_id"];

// استخدام Prepared Statement لحذف المنتج
$sql = "DELETE FROM cart_items WHERE product_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $product_id, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Removed from cart"]);
    } else {
        echo json_encode(["success" => false, "error" => "Product not found in cart"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Failed to remove product"]);
}

$stmt->close();
$conn->close();
?>
