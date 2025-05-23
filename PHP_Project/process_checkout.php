<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user'])) {
    die(json_encode(["error" => "Please log in to place an order."]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = (int)$_SESSION['user']['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    if (empty($first_name) || empty($last_name) || empty($phone_number) || empty($address) || empty($city)) {
        die(json_encode(["error" => "All fields are required."]));
    }

    $sql = "INSERT INTO orders (user_id, first_name, last_name, phone_number, address, city) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $user_id, $first_name, $last_name, $phone_number, $address, $city);

    if ($stmt->execute()) {
        // مسح محتويات السلة
        $sql_clear_cart = "DELETE FROM cart_items WHERE user_id = ?";
        $stmt_clear = $conn->prepare($sql_clear_cart);
        $stmt_clear->bind_param("i", $user_id);
        $stmt_clear->execute();
        $stmt_clear->close();

        // إرجاع نجاح
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>