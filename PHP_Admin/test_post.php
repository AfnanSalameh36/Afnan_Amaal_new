<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode(["status" => "success", "message" => "تم استقبال طلب POST بنجاح."]);
} else {
    echo json_encode(["status" => "error", "message" => "طلب غير صالح."]);
}
?>
