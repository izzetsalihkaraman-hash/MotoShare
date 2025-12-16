<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $fiyat = 0; 

    // GÜNCELLENDİ: Artık "Ekipman İncelemesi" yazacak
    $resim_yolu = "https://placehold.co/600x400/212529/ffc107?text=Ekipman+Incelemesi"; 

    if (!empty($_FILES["resim"]["name"])) {
        $hedef = "uploads/" . time() . "_" . basename($_FILES["resim"]["name"]);
        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef)) {
            $resim_yolu = $hedef; 
        }
    }

    try {
        $sql = "INSERT INTO ekipmanlar (baslik, aciklama, fiyat, resim_yolu, ekleyen_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$baslik, $aciklama, $fiyat, $resim_yolu, $_SESSION['user_id']]);
        header("Location: reviews.php"); 
        exit;
    } catch (PDOException $e) { $mesaj = '<div class="alert alert-danger">Hata: ' . $e->getMessage() . '</div>'; }
}

include 'includes/header.php';
?>
<style>
    .form-control { background-color: #2b3035; color: #fff; border: 1px solid #495057; }
    .form-control:focus { background-color: #2b3035; color: #fff; border-color: #ffc107; box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25); }
    .form-text { color: #adb5bd; }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-lg-8">
        <h2 class="text-center mb-4 text-warning">🛡️ Yeni Ekipman İncelemesi</h2>
        <?php echo $mesaj; ?>
        <div class="card shadow border-secondary" style="background-color: #212529;">
            <div class="card-body p-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-light">Ekipman Marka/Model:</label>
                        <input type="text" name="baslik" class="form-control" required placeholder="Örn: Shoei NXR 2 Kask">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-light">Kullanıcı Deneyimin:</label>
                        <textarea name="aciklama" class="form-control" rows="6" placeholder="Yorumların..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-light">Fotoğraf (İsteğe Bağlı):</label>
                        <input type="file" name="resim" class="form-control">
                        <div class="form-text">Fotoğraf yüklemezsen varsayılan görsel atanır.</div>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold">İncelemeyi Yayınla 🚀</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>