<?php
global $conn;
include("db_connection.php");
session_start();

$code = isset($_GET['coupon']) ? $_GET['coupon'] : null;
$email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : null;

if ($code && $email) {
    $stmt = $conn->prepare("SELECT * FROM discount_coupons WHERE code = ? AND user_email = ? AND used = 0");
    $stmt->bind_param("ss", $code, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // تأكد من وجود العمود
        if(isset($row['discount_percent'])){
            $discount_percent = $row['discount_percent'];
        } else {
            $discount_percent = 0; // قيمة افتراضية إذا لم تكن موجودة
        }

        $update = $conn->prepare("UPDATE discount_coupons SET used = 1 WHERE id = ?");
        $update->bind_param("i", $row['id']);
        $update->execute();

        echo "تم استخدام الكوبون بنجاح. خصم: " . $discount_percent . "٪";
    } else {
        echo "كود الخصم غير صالح أو تم استخدامه سابقًا.";
    }
} else {
    echo "لم يتم استلام الكود أو البريد الإلكتروني.";
}
?>
