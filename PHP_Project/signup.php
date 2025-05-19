<?php
global $conn;
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['signup_name']) ? $_POST['signup_name'] : '';
    $email = isset($_POST['signup_email']) ? $_POST['signup_email'] : '';
    $password = isset($_POST['signup_password']) ? $_POST['signup_password'] : '';

    if (empty($name) || empty($email) || empty($password)) {
        echo "يرجى تعبئة جميع الحقول.";
        exit;
    }

    // تحقق من وجود الإيميل مسبقاً
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "❌ البريد موجود مسبقًا.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        $newUserId = $stmt->insert_id;

        $_SESSION['user'] = [
            'id' => $newUserId,
            'name' => $name,
            'email' => $email
        ];

        header("Location: ../HTML_Project/index.html");
        exit;
    } else {
        echo "❌ خطأ أثناء الحفظ.";
    }
}
?>
