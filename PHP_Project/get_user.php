<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(["status" => "not_logged_in"]);
    exit;
}

echo json_encode([
    "status" => "ok",
    "name" => $_SESSION['user']['name'],
    "email" => $_SESSION['user']['email']
]);
