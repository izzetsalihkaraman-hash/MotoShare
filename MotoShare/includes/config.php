<?php
// Oturum başlatma (Giriş/Çıkış işlemleri için gerekli)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Veritabanı Bağlantı Bilgileri
define('DB_HOST', '127.0.0.1'); // localhost yerine 127.0.0.1 kullanıyoruz
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'motoshare_db');
define('DB_PORT', '3307'); // Port numaranı buraya ekledim

// PDO ile Güvenli Veritabanı Bağlantısı
try {
    // Aşağıdaki satıra ";port=" . DB_PORT eklemesi yapıldı
    $db = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    // Hata mesajını daha detaylı görmek için eklendi
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Güvenlik ve Yardımcı Fonksiyonlar
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>