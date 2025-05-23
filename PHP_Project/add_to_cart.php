<?php
global $conn;
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(["num_cart" => 0, "in_cart" => "Please log in to add items to cart"]);
    exit;
}

$user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];

if (isset($_GET["id"])) {
    $product_id = (int)$_GET["id"];

    if ($product_id <= 0) {
        echo json_encode(["num_cart" => 0, "in_cart" => "Invalid product ID"]);
        exit;
    }

    // التحقق إذا المنتج موجود في سلة المستخدم
    $sql = "SELECT * FROM cart_items WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $product_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // جلب عدد العناصر في سلة المستخدم
    $total_cart = "SELECT * FROM cart_items WHERE user_id = ?";
    $total_stmt = $conn->prepare($total_cart);
    $total_stmt->bind_param("i", $user_id);
    $total_stmt->execute();
    $total_cart_result = $total_stmt->get_result();
    $cart_num = mysqli_num_rows($total_cart_result);

    if (mysqli_num_rows($result) > 0) {
        $in_cart = "already in cart";
        echo json_encode(["num_cart" => $cart_num, "in_cart" => $in_cart]);
    } else {
        // إدراج المنتج مع user_id
        $insert = "INSERT INTO cart_items (user_id, product_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert);
        $insert_stmt->bind_param("ii", $user_id, $product_id);
        if ($insert_stmt->execute()) {
            $in_cart = "added into cart";
            $cart_num++;
            echo json_encode(["num_cart" => $cart_num, "in_cart" => $in_cart]);
        } else {
            echo json_encode(["num_cart" => $cart_num, "in_cart" => "Error: Failed to add to cart"]);
        }
        $insert_stmt->close();
    }
    $stmt->close();
    $total_stmt->close();
} else {
    echo json_encode(["num_cart" => 0, "in_cart" => "No product ID provided"]);
}

$conn->close();
