<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['login_name'];
$password_input = $_POST['login_password'];

// جلب المستخدم حسب الاسم
$stmt = $conn->prepare("SELECT id, password FROM users WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password_input, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $name;

        header("Location: home.php"); // بعد الدخول يروح على الصفحة الرئيسية
        exit;
    } else {
        echo "Wrong password!";
    }
} else {
    echo "User not found!";
}

$stmt->close();
$conn->close();
?>
