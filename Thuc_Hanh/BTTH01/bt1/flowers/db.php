<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // nếu XAMPP mặc định là trống
$dbname = 'flowers';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối DB: " . $e->getMessage());
}
?>
