<?php
session_start();
header('Content-Type: application/json');

// مسح الإشعارات فقط للمستخدم الحالي
if (isset($_SESSION['notifications'])) {
    unset($_SESSION['notifications']);
}

echo json_encode(["status" => "cleared"]);
?>
