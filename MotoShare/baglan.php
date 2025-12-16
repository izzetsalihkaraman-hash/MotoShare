<?php
// baglan.php - Veritabanı Bağlantı Dosyası
$host = "127.0.0.1";
$dbname = "motoshare_db";
$username = "root";
$password = "";
$port = 3307; // Senin özel portun

try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>