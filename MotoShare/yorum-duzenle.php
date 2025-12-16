<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$yorum_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Yorumu Çek
$stmt = $db->prepare("SELECT * FROM yorumlar WHERE id = ?");
$stmt->execute([$yorum_id]);
$yorum = $stmt->fetch(PDO::FETCH_ASSOC);

// Güvenlik: Yorum var mı ve sahibi sen misin?
if (!$yorum || $yorum['user_id'] != $_SESSION['user_id']) {
    die("Bu işlem için yetkiniz yok.");
}

// Form Gönderildiyse Güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yeni_yorum = trim($_POST['yorum']);
    if (!empty($yeni_yorum)) {
        $guncelle = $db->prepare("UPDATE yorumlar SET yorum = ? WHERE id = ?");
        $guncelle->execute([$yeni_yorum, $yorum_id]);
        
        // Detay sayfasına geri dön
        header("Location: detay.php?tur=" . $yorum['tur'] . "&id=" . $yorum['item_id']);
        exit;
    }
}

include 'includes/header.php';
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-secondary bg-dark text-white">
                <div class="card-header border-secondary">
                    <h4 class="mb-0 text-warning">✏️ Yorumu Düzenle</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label text-white-50">Yorumunuz:</label>
                            <textarea name="yorum" class="form-control bg-dark text-white border-secondary" rows="5" required><?php echo htmlspecialchars($yorum['yorum']); ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="detay.php?tur=<?php echo $yorum['tur']; ?>&id=<?php echo $yorum['item_id']; ?>" class="btn btn-outline-light">İptal</a>
                            <button type="submit" class="btn btn-warning fw-bold text-dark">Değişiklikleri Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>