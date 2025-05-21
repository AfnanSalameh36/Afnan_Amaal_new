<?php

session_start();


if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "message" => "Please log in to complete your reservation"]);
    exit;
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['user']['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = intval($_POST['guests']);
    $special_request = isset($_POST['special_request']) ? $_POST['special_request'] : '';

    if (empty($email) || empty($date) || empty($time) || empty($guests)) {
        echo json_encode(["success" => false, "message" => "All fields are required!"]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email format!"]);
        exit;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        echo json_encode(["success" => false, "message" => "Invalid date format. Please select a valid date."]);
        exit;
    }

    if (!preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $time)) {
        echo json_encode(["success" => false, "message" => "Invalid time format. Please select a valid time."]);
        exit;
    }

    if (strlen($time) == 5) {
        $time .= ":00";
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "golden_restaurant";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
        exit;
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE date = ? AND time = ?");
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count >= 6) {
        echo json_encode(["success" => false, "message" => "This date and time is fully booked. Please choose another."]);
        $conn->close();
        exit;
    }

    $user_name = $_SESSION['user']['name'];

    $stmt = $conn->prepare("INSERT INTO reservations (email, date, time, guests, special_request, name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $email, $date, $time, $guests, $special_request, $user_name);

    if (!$stmt->execute()) {
        echo json_encode(["success" => false, "message" => "Failed to save reservation: " . $stmt->error]);
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amaalferas31@gmail.com';
        $mail->Password = 'eeiqndpbqrgsoauy';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';

        $mail->setFrom('amaalferas31@gmail.com', 'Golden Restaurant');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Reservation Confirmation at Golden Restaurant';
        $mail->Body = "
<html dir='ltr'>
  <body style='font-family: Arial, sans-serif; background-color: #f8f4f0; padding: 30px;'>
    <div style='max-width: 600px; margin: auto; background-color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;'>
      <h2 style='color: #CB9953; text-align: center;'>🍽️ Golden Restaurant - Reservation Confirmed!</h2>
      <p style='font-size: 16px; color: #333;'><strong>Date:</strong> $date</p>
      <p style='font-size: 16px; color: #333;'><strong>Time:</strong> $time</p>
      <p style='font-size: 16px; color: #333;'><strong>Guests:</strong> $guests</p>
      <p style='font-size: 16px; color: #333;'><strong>Special Request:</strong> " . ($special_request ? htmlspecialchars($special_request) : "None") . "</p>
      <hr style='margin: 20px 0; border: none; border-top: 1px solid #eee;'>
      <p style='font-size: 15px; color: #666;'>Thank you for choosing Golden Restaurant. We look forward to serving you!<br>🕰️ Please arrive at least 10 minutes earlier.</p>
      <p style='font-size: 14px; text-align: center; color: #aaa;'>This is an automated message. Please do not reply.</p>
    </div>
  </body>
</html>
";

        $mail->send();
        echo json_encode(["success" => true, "message" => "Confirmation has been sent to your email!"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Failed to send confirmation email: {$mail->ErrorInfo}"]);
    }

    $conn->close();

} else {
    echo json_encode(["success" => false, "message" => "Invalid request!"]);
}
?>
