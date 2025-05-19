global$conn; global$conn; // signup.php
<?php
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "📥 POST Received<br>";

    $name = $_POST['signup_name'];
    $email = $_POST['signup_email'];
    $password = $_POST['signup_password'];

    // تحقق من وجود الإيميل
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
        $_SESSION['user'] = $name;
        echo "✅ تم التسجيل بنجاح!";
        header("Location: ../HTML_Project/index.html");
        exit;
    } else {
        echo "❌ خطأ أثناء الحفظ.";
    }
}
?>
