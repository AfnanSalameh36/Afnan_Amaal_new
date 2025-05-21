<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_restaurant";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);

    if (
        !$input ||
        !isset($input['id'], $input['email'], $input['name'], $input['date'], $input['time'], $input['guests'], $input['special_request'])
    ) {
        echo json_encode(['success' => false, 'message' => 'بيانات غير مكتملة']);
        exit;
    }

    $id = (int) $input['id'];
    $email = trim($input['email']);
    $name = trim($input['name']);
    $date = $input['date'];
    $time = $input['time'];
    $guests = (int) $input['guests'];
    $special_request = trim($input['special_request']);

    $stmt = $pdo->prepare("UPDATE reservations SET email = ?, name = ?, date = ?, time = ?, guests = ?, special_request = ? WHERE id = ?");
    $stmt->execute([$email, $name, $date, $time, $guests, $special_request, $id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        // حتى لو لم يتغير شيء، نعتبر العملية ناجحة
        echo json_encode(['success' => true, 'message' => 'لم يتم تعديل البيانات لأنها نفسها']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'خطأ في قاعدة البيانات']);
}
?>
