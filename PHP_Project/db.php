<?php
// إعدادات قاعدة البيانات
$servername = "localhost";   // لو تشتغل على جهازك المحلي غالبًا localhost
$username = "root";          // اسم المستخدم الافتراضي في XAMPP
$password = "";              // كلمة السر عادة تكون فارغة في XAMPP
$dbname = "golden_restaurant";    // اسم قاعدة البيانات (تغيره حسب ما اخترت)

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من نجاح الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
