<?php
session_start();

global $conn;
include("db_connection.php");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['signup_name']) ? trim($_POST['signup_name']) : '';
    $email = isset($_POST['signup_email']) ? trim($_POST['signup_email']) : '';
    $password = isset($_POST['signup_password']) ? $_POST['signup_password'] : '';

    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Please fill in all fields.'
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid email format.'
        ]);
        exit;
    }

    if (strlen($name) < 4) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Name must be at least 4 characters.'
        ]);
        exit;
    }

    if (strlen($password) < 4) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Password must be at least 4 characters.'
        ]);
        exit;
    }

    // ✅ تحقق من وجود نفس الاسم مسبقاً
    $stmt = $conn->prepare("SELECT id FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $checkName = $stmt->get_result();

    if ($checkName->num_rows > 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username is already taken.'
        ]);
        exit;
    }

    // ✅ تحقق من وجود نفس الإيميل مسبقاً
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $checkEmail = $stmt->get_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email is already registered.'
        ]);
        exit;
    }

    // تشفير الباسورد
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال المستخدم
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['user'] = [
            'id' => $stmt->insert_id,
            'name' => $name,
            'email' => $email
        ];

        echo json_encode([
            'status' => 'success',
            'message' => 'Account created successfully!'
        ]);
        exit;
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Something went wrong during registration.'
        ]);
        exit;
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}
?>
