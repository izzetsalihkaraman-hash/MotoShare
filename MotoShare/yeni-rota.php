<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $zorluk = $_POST['zorluk'];

    // GÜNCELLENDİ: "Rota Paylaşımı"
    $resim_yolu = "https://placehold.co/600x400/212529/198754?text=Rota+Paylasimi"; 

    if (!empty($_FILES["resim"]["name"])) {
        $hedef = "uploads/" . time() . "_" . basename($_FILES["resim"]["name"]);
        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef)) {
            $resim_yolu = $hedef;
        }
    }

    try {
        $stmt = $db->prepare("INSERT INTO rotalar (baslik, aciklama, zorluk_derecesi, resim_yolu, ekleyen_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$baslik, $aciklama, $zorluk, $resim_yolu, $_SESSION['user_id']]);
        header("Location: rotalar.php");
        exit;
    } catch (PDOException $e) { $mesaj = "Hata: " . $e->getMessage(); }
}

include 'includes/header.php';
?>
<style>
    .form-control, .form-select { background-color: #2b3035; color: #fff; border: 1px solid #495057; }
    .form-control:focus, .form-select:focus { background-color: #2b3035; color: #fff; border-color: #198754; box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25); }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-lg-8">
        <h2 class="text-center mb-4 text-success">🗺️ Yeni Rota Öner</h2>
        <?php echo $mesaj; ?>
        <div class="card shadow border-secondary" style="background-color: #212529;">
            <div class="card-body p-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="fw-bold text-light">Rota Başlığı</label>
                        <input type="text" name="baslik" class="form-control" placeholder="Örn: Tekirdağ Virajları" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-light">Zorluk Derecesi</label>
                        <select name="zorluk" class="form-select">
                            <option value="Kolay">🟢 Kolay</option>
                            <option value="Orta">🟡 Orta</option>
                            <option value="Zor">🔴 Zor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-light">Rota Detayları</label>
                        <textarea name="aciklama" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-light">Fotoğraf (İsteğe Bağlı)</label>
                        <input type="file" name="resim" class="form-control">
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg fw-bold">Rotayı Paylaş 🏁</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>