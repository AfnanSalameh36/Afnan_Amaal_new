<?php
include '../PHP_Project/db_connection.php'; // عدل المسار حسب مشروعك

header('Content-Type: application/json');

if (isset($_POST['productId'])) {
    $productId = intval($_POST['productId']);

    // حذف الصورة أولاً من السيرفر لو عندك صورة محفوظة
    $sqlImg = "SELECT image_url FROM products WHERE product_id = $productId";
    $resImg = $conn->query($sqlImg);
    if ($resImg->num_rows > 0) {
        $rowImg = $resImg->fetch_assoc();
        $imagePath = "../images2/" . $rowImg['image_url'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // حذف الصورة من السيرفر
        }
    }

    // حذف السجل من قاعدة البيانات
    $sql = "DELETE FROM products WHERE product_id = $productId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Product ID not provided']);
}
?>
