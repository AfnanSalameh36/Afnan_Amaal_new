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
        echo json_encode(["success" => false, "message" => "All fields are required!"]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amaalferas31@gmail.com'; // Restaurant email
        $mail->Password = 'lojrfjsdwbpezmsn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';

        $mail->setFrom('amaalferas31@gmail.com', 'Golden Restaurant');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Reservation Confirmation at Golden Restaurant';
        $mail->Body = "
            <html dir='ltr'>
            <body style='font-family: Arial, sans-serif;'>
                <h2 style='color: #c49871;'>Your reservation has been successfully confirmed!</h2>
                <p><strong>Date:</strong> $date</p>
                <p><strong>Time:</strong> $time</p>
                <p><strong>Number of Guests:</strong> $guests</p>
                <p><strong>Special Request:</strong> " . ($special_request ? htmlspecialchars($special_request) : "None") . "</p>
                <hr>
                <p>We look forward to welcoming you at our Golden Restaurant. Please arrive 10 minutes before the scheduled time.</p>
            </body>
            </html>
        ";

        $mail->send();
        echo json_encode(["success" => true, "message" => "Confirmation has been sent to your email!"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Failed to send: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request!"]);
}
