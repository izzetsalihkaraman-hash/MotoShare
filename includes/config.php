<?php
// Oturum başlatma (Giriş/Çıkış işlemleri için gerekli)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Veritabanı Bağlantı Bilgileri
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'motoshare_db'); 

// PDO ile Güvenli Veritabanı Bağlantısı
try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Güvenlik ve Yardımcı Fonksiyonlar
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>