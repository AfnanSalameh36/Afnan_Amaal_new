<?php
//session_start();
//
//if (!isset($_SESSION['user'])) {
//    // إذا المستخدم مش مسجل دخول، نوجهه للصفحة الرئيسية أو صفحة تسجيل الدخول
//    header("Location:../HTML_Project/login.html");
//    exit;
//}
//
//$email = $_SESSION['user']['email'];
//
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "golden_restaurant";
//
//$conn = new mysqli($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
//    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
//}
//
//$stmt = $conn->prepare("SELECT message, created_at FROM messages WHERE user_email = ? ORDER BY created_at DESC");
//$stmt->bind_param("s", $email);
//$stmt->execute();
//$result = $stmt->get_result();
//
//$messages = [];
//while ($row = $result->fetch_assoc()) {
//    $messages[] = $row;
//}
//
//$stmt->close();
//$conn->close();
//?>
<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="ar" dir="rtl">-->
<!--<head>-->
<!--    <meta charset="UTF-8" />-->
<!--    <title>صفحتي - الرسائل</title>-->
<!--    <style>-->
<!--        body {-->
<!--            font-family: Arial, sans-serif;-->
<!--            background-color: #f8f4f0;-->
<!--            padding: 20px;-->
<!--            direction: rtl;-->
<!--            text-align: right;-->
<!--        }-->
<!--        .message {-->
<!--            background: white;-->
<!--            padding: 15px;-->
<!--            margin-bottom: 15px;-->
<!--            border-radius: 8px;-->
<!--            box-shadow: 0 0 5px rgba(0,0,0,0.1);-->
<!--        }-->
<!--        .message p {-->
<!--            margin: 0 0 8px 0;-->
<!--            font-size: 16px;-->
<!--            color: #333;-->
<!--        }-->
<!--        .message small {-->
<!--            color: #888;-->
<!--            font-size: 13px;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<h1>رسائلك</h1>-->
<!---->
<?php //if (empty($messages)): ?>
<!--    <p>لا توجد رسائل حتى الآن.</p>-->
<?php //else: ?>
<!--    --><?php //foreach ($messages as $msg): ?>
<!--        <div class="message">-->
<!--            <p>--><?php //= htmlspecialchars($msg['message']) ?><!--</p>-->
<!--            <small>تاريخ الإرسال: --><?php //= htmlspecialchars($msg['created_at']) ?><!--</small>-->
<!--        </div>-->
<!--    --><?php //endforeach; ?>
<?php //endif; ?>
<!---->
<!--</body>-->
<!--</html>-->
