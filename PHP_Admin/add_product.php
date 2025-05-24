<?php
$host = "localhost";
$db = "golden_restaurant";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات من الفورم
$name = $_POST['productName'];
$price = $_POST['productPrice'];
$category = $_POST['productCategory'];
$discount = $_POST['productDiscount'];
$popularity = $_POST['productPopularity'];

// التعامل مع الصورة
$imageName = basename($_FILES['productImage']['name']);
$imageTmp = $_FILES['productImage']['tmp_name'];
$targetDir = "../HTML_Project/image2/";
$targetFile = $targetDir . $imageName;
// Upload the image once
if (move_uploaded_file($imageTmp, $targetFile)) {
    echo "✔️ Image uploaded successfully!";

    // Insert product data into the 'products' table
    $stmt = $conn->prepare("INSERT INTO products (name, price, image_url, category, discount, popularity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssii", $name, $price, $imageName, $category, $discount, $popularity);

    if ($stmt->execute()) {
        echo "✅ Product added successfully!";
    } else {
        echo "❌ Error adding product: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "❌ Failed to upload image.";
}

$conn->close();
?>
