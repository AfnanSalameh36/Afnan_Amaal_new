<?php

$host = "localhost";
$user = "root";
$password = ""; // بدون باسورد في XAMPP غالبًا
$database = "golden_restaurant"; // غيريها حسب اسم قاعدتك

$conn = new mysqli($host, $user, $password, $database);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

