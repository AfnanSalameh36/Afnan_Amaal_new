<?php
session_start();
header('Content-Type: application/json');

// تأكد المستخدم مسجل دخول
if (!isset($_SESSION['user']['email'])) {
    echo json_encode([]);
    exit;
}

$userEmail = $_SESSION['user']['email'];

// الاتصال بقاعدة البيانات
$pdo = new PDO("mysql:host=localhost;dbname=golden_restaurant;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// جلب الرسائل والردود المرتبطة ببريد المستخدم
$sql = "
    SELECT 
        cm.id AS message_id,
        cm.message,
        cm.created_at AS message_created,
        ar.reply_text,
        ar.created_at AS reply_created
    FROM contact_messages cm
    LEFT JOIN admin_replies ar ON cm.id = ar.message_id
    WHERE cm.email = :email
    ORDER BY cm.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $userEmail]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
?>
