<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

// الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استلام البيانات من الفورم
$name = $_POST['signup_name'];
$email = $_POST['signup_email'];
$password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT); // تشفير الباسورد

// إدخال البيانات
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    header("Location: login.html"); // بعد التسجيل يرجع لصفحة الدخول
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
