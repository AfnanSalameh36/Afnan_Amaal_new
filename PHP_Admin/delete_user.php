<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'message' => 'لم يتم إرسال معرف المستخدم']);
        exit;
    }

    $id = (int) $_GET['id'];

    // أولاً نجيب إيميل المستخدم
    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'المستخدم غير موجود']);
        exit;
    }

    $email = $user['email'];

    // حذف الحجوزات المرتبطة بالإيميل
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE email = ?");
    $stmt->execute([$email]);

    // حذف الكوبونات المرتبطة بالإيميل
    $stmt = $pdo->prepare("DELETE FROM discount_coupons WHERE user_email = ?");
    $stmt->execute([$email]);

    // حذف المستخدم
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'تم حذف المستخدم وكل البيانات المرتبطة']);
    } else {
        echo json_encode(['success' => false, 'message' => 'فشل حذف المستخدم']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'خطأ في قاعدة البيانات']);
}
