<?php
session_start();
$conn = new mysqli("localhost", "root", "", "golden_restaurant");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['login_name'];
$password = $_POST['login_password'];

// استعلام للبحث عن المستخدم بالاسم
$sql = "SELECT * FROM users WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // تحقق من كلمة المرور
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        header("Location: ../HTML_Project/index.html");
        exit;
    } else {
        echo "كلمة المرور غير صحيحة.";
    }
} else {
    echo "المستخدم غير موجود.";
}
?>
