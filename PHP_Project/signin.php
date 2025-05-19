<?php
global $conn;
session_start();
include("db_connection.php"); // يتصل بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['login_name']) ? $_POST['login_name'] : '';
    $password = isset($_POST['login_password']) ? $_POST['login_password'] : '';

    if (empty($name) || empty($password)) {
        echo "يرجى تعبئة جميع الحقول.";
        exit;
    }

    // استعلام للبحث عن المستخدم باسم أو إيميل
    $sql = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // تحقق من كلمة المرور
        if (password_verify($password, $user['password'])) {
            // تسجيل بيانات المستخدم في الجلسة
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            header("Location: ../HTML_Project/index.html"); // تحويل لصفحة داخل الموقع
            exit;
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "المستخدم غير موجود.";
    }
}
?>
