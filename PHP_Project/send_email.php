<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $special_request = isset($_POST['special_request']) ? $_POST['special_request'] : '';

    if (empty($email) || empty($date) || empty($time) || empty($guests)) {
        echo json_encode(["success" => false, "message" => "جميع الحقول مطلوبة!"]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amaalferas31@gmail.com'; // إيميل المطعم
        $mail->Password = 'lojrfjsdwbpezmsn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';

        $mail->setFrom('amaalferas31@gmail.com', 'Golden Restaurant');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'تأكيد حجزك في Golden Restaurant';
        $mail->Body = "
            <html dir='rtl'>
            <body style='font-family: Arial, sans-serif;'>
                <h2 style='color: #c49871;'>تم تأكيد حجزك بنجاح!</h2>
                <p><strong>التاريخ:</strong> $date</p>
                <p><strong>الوقت:</strong> $time</p>
                <p><strong>عدد الضيوف:</strong> $guests</p>
                <p><strong>الطلب الخاص:</strong> " . ($special_request ? htmlspecialchars($special_request) : "لا يوجد") . "</p>
                <hr>
                <p>نرحب بك في مطعمنا الذهبي، يرجى الحضور قبل 10 دقائق من الوقت المحدد.</p>
            </body>
            </html>
        ";

        $mail->send();
        echo json_encode(["success" => true, "message" => "تم إرسال التأكيد إلى بريدك!"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "فشل في الإرسال: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "طلب غير صالح!"]);
}
