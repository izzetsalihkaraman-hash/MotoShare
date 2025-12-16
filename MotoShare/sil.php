<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$tur = isset($_GET['tur']) ? $_GET['tur'] : '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// --- YORUM SİLME İŞLEMİ (GÜNCELLENDİ: ARTIK GİZLİYORUZ) ---
if ($tur == 'yorum') {
    // 1. Yorumu bul ve sahibi kim bak
    $stmt = $db->prepare("SELECT user_id, item_id, tur FROM yorumlar WHERE id = ?");
    $stmt->execute([$id]);
    $yorum = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Sadece yorum sahibi veya Admin silebilir
    if ($yorum && ($yorum['user_id'] == $_SESSION['user_id'] || isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
        
        // --- DEĞİŞİKLİK BURADA BAŞLIYOR ---
        // Eskiden: DELETE FROM yorumlar... yapıyorduk.
        // Şimdi: UPDATE ile silinme tarihini ekliyoruz (Soft Delete).
        
        $sil = $db->prepare("UPDATE yorumlar SET deleted_at = NOW() WHERE id = ?");
        $sil->execute([$id]);
        
        // --- DEĞİŞİKLİK BURADA BİTİYOR ---

        // İşlem bitince geldiği detay sayfasına geri dönsün
        header("Location: detay.php?tur=" . $yorum['tur'] . "&id=" . $yorum['item_id']);
        exit;
    } else {
        die("Bu yorumu silme yetkiniz yok.");
    }
}

// --- DİĞER İÇERİKLERİ SİLME İŞLEMİ (Ekipman, Rota vs. - BURASI AYNI KALDI) ---
$tablo = "";
if ($tur == 'ekipman') { $tablo = "ekipmanlar"; $yonlendir = "reviews.php"; }
elseif ($tur == 'rota') { $tablo = "rotalar"; $yonlendir = "rotalar.php"; }
elseif ($tur == 'deneyim') { $tablo = "deneyimler"; $yonlendir = "deneyimler.php"; }
else { die("Geçersiz tür."); }

// Tablo adını doğrudan değişkenden almak riskli olabilir ama mevcut yapını bozmuyorum.
$stmt = $db->prepare("SELECT ekleyen_id FROM $tablo WHERE id = ?");
$stmt->execute([$id]);
$icerik = $stmt->fetch(PDO::FETCH_ASSOC);

if ($icerik && ($icerik['ekleyen_id'] == $_SESSION['user_id'] || isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
    $sil = $db->prepare("DELETE FROM $tablo WHERE id = ?");
    $sil->execute([$id]);
    header("Location: $yonlendir");
    exit;
} else {
    die("Bu içeriği silme yetkiniz yok.");
}
?>