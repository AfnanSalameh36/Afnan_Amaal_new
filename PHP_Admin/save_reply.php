<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'فشل الاتصال بقاعدة البيانات: ' . $e->getMessage()]);
    exit;
}

if (isset($_POST['message_id'], $_POST['email'], $_POST['reply_text'])) {
    $message_id = intval($_POST['message_id']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $reply_text = trim($_POST['reply_text']);

    if (!$email) {
        echo json_encode(['status' => 'error', 'message' => 'البريد الإلكتروني غير صالح']);
        exit;
    }

    if (empty($reply_text)) {
        echo json_encode(['status' => 'error', 'message' => 'الرد لا يمكن أن يكون فارغًا']);
        exit;
    }

    try {
        // تأكد أن الرسالة موجودة (اختياري)
        $checkStmt = $pdo->prepare("SELECT id FROM contact_messages WHERE id = :id");
        $checkStmt->execute([':id' => $message_id]);
        if ($checkStmt->rowCount() === 0) {
            echo json_encode(['status' => 'error', 'message' => 'الرسالة غير موجودة']);
            exit;
        }

        // إدخال الرد
        $stmt = $pdo->prepare("INSERT INTO admin_replies (email, reply_text, message_id) VALUES (:email, :reply_text, :message_id)");
        $stmt->execute([
            ':email' => $email,
            ':reply_text' => $reply_text,
            ':message_id' => $message_id
        ]);

        echo json_encode(['status' => 'success', 'message' => 'تم إرسال الرد بنجاح']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'حدث خطأ أثناء حفظ الرد: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'طلب غير صالح.']);
}
?>
