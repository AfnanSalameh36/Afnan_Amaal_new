<?php
global $conn;
session_start();
include("../PHP_Project/db_connection.php");

$response = [];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // عدد الحجوزات اليوم
    $sql_today = "SELECT COUNT(*) AS count FROM reservations WHERE DATE(created_at) = CURDATE()";
    $result_today = $conn->query($sql_today);
    $data_today = $result_today->fetch_assoc();
    $response['reservations_today'] = $data_today['count'];

    // عدد الحجوزات خلال الأسبوع (من أول يوم في الأسبوع إلى اليوم)
    $sql_week = "SELECT COUNT(*) AS count FROM reservations WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
    $result_week = $conn->query($sql_week);
    $data_week = $result_week->fetch_assoc();
    $response['reservations_week'] = $data_week['count'];

    // عدد الزبائن (عدد الـ users الذين role = 'user')
    $sql_users = "SELECT COUNT(*) AS count FROM users WHERE role = 'user'";
    $result_users = $conn->query($sql_users);
    $data_users = $result_users->fetch_assoc();
    $response['users_count'] = $data_users['count'];

    // عدد الكوبونات المستعملة (used = 1)
    $sql_used_coupons = "SELECT COUNT(*) AS count FROM discount_coupons WHERE used = 1";
    $result_used = $conn->query($sql_used_coupons);
    $data_used = $result_used->fetch_assoc();
    $response['used_coupons'] = $data_used['count'];

    // عدد الكوبونات الجديدة (used = 0)
    $sql_new_coupons = "SELECT COUNT(*) AS count FROM discount_coupons WHERE used = 0";
    $result_new = $conn->query($sql_new_coupons);
    $data_new = $result_new->fetch_assoc();
    $response['new_coupons'] = $data_new['count'];



    // عدد المستخدمين خلال آخر 7 أيام
    $users_last_week = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $sql = "SELECT COUNT(*) AS count FROM users WHERE role = 'user' AND DATE(created_at) = '$date'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $users_last_week[$date] = (int)$row['count'];
    }
    $response['users_last_week'] = $users_last_week;

    echo json_encode($response);
    exit;
}
?>
