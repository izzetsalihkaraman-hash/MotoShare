<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    
    // GÜNCELLENDİ: Kısa ve Güvenli Link
    $resim_yolu = "https://placehold.co/600x400/212529/0d6efd?text=Deneyim+Yazisi"; 

    if (!empty($_FILES["resim"]["name"])) {
        $hedef = "uploads/" . time() . "_" . basename($_FILES["resim"]["name"]);
        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef)) {
            $resim_yolu = $hedef;
        }
    }
    
    try {
        $stmt = $db->prepare("INSERT INTO deneyimler (baslik, icerik, resim_yolu, ekleyen_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$baslik, $icerik, $resim_yolu, $_SESSION['user_id']]);
        header("Location: deneyimler.php"); 
        exit;
    } catch (PDOException $e) { $mesaj = "Hata: " . $e->getMessage(); }
}

include 'includes/header.php';
?>

<style>
    .form-control { background-color: #2b3035; color: #fff; border: 1px solid #495057; }
    .form-control:focus { background-color: #2b3035; color: #fff; border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-lg-8">
        <h2 class="text-center mb-4 text-primary">✍️ Deneyimini Paylaş</h2>
        <?php echo $mesaj; ?>
        <div class="card shadow border-secondary" style="background-color: #212529;">
            <div class="card-body p-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="fw-bold text-light">Başlık</label>
                        <input type="text" name="baslik" class="form-control" placeholder="Örn: İlk Kampım" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-light">Hikayen</label>
                        <textarea name="icerik" class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-light">Fotoğraf (İsteğe Bağlı)</label>
                        <input type="file" name="resim" class="form-control">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">Yayınla 📝</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>