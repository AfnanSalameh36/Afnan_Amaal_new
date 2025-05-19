<?php
global $conn;
include("../PHP_Project/db_connection.php");

$response = ['status' => '', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['login_name']) ? trim($_POST['login_name']) : '';
    $password = isset($_POST['login_password']) ? $_POST['login_password'] : '';

    if (empty($name) || empty($password)) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in all fields.';
        echo json_encode($response);
        exit;
    }

    $sql = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            $response['status'] = 'success';
            $response['message'] = 'Login successful.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Incorrect password.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User not found.';
    }

    echo json_encode($response);
    exit;
}
?>
