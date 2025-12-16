<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$tur = isset($_GET['tur']) ? $_GET['tur'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$mesaj = "";

// Tablo Seçimi
$tablo = "";
$icerik_sutunu = "aciklama"; 
if ($tur == 'ekipman') { $tablo = "ekipmanlar"; }
elseif ($tur == 'rota') { $tablo = "rotalar"; }
elseif ($tur == 'deneyim') { $tablo = "deneyimler"; $icerik_sutunu = "icerik"; }
else { die("Geçersiz tür."); }

// Veriyi Çek
$stmt = $db->prepare("SELECT * FROM $tablo WHERE id = ?");
$stmt->execute([$id]);
$veri = $stmt->fetch(PDO::FETCH_ASSOC);

// Yetki Kontrolü
if (!$veri || ($veri['ekleyen_id'] != $_SESSION['user_id'] && $_SESSION['role'] != 'admin')) {
    die('<div class="alert alert-danger m-5">Yetkisiz işlem!</div>');
}

// Güncelleme İşlemi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $zorluk = isset($_POST['zorluk']) ? $_POST['zorluk'] : null;

    $resim_yolu = $veri['resim_yolu']; 
    if (!empty($_FILES["resim"]["name"])) {
        $hedef = "uploads/" . time() . "_" . basename($_FILES["resim"]["name"]);
        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef)) {
            $resim_yolu = $hedef;
        }
    }

    try {
        if ($tur == 'rota') {
            $sql = "UPDATE rotalar SET baslik=?, aciklama=?, zorluk_derecesi=?, resim_yolu=? WHERE id=?";
            $params = [$baslik, $icerik, $zorluk, $resim_yolu, $id];
        } elseif ($tur == 'deneyim') {
            $sql = "UPDATE deneyimler SET baslik=?, icerik=?, resim_yolu=? WHERE id=?";
            $params = [$baslik, $icerik, $resim_yolu, $id];
        } else { 
            $sql = "UPDATE ekipmanlar SET baslik=?, aciklama=?, resim_yolu=? WHERE id=?";
            $params = [$baslik, $icerik, $resim_yolu, $id];
        }

        $guncelle = $db->prepare($sql);
        $guncelle->execute($params);
        header("Location: detay.php?tur=$tur&id=$id");
        exit;

    } catch (PDOException $e) { $mesaj = "Hata: " . $e->getMessage(); }
}

include 'includes/header.php';
?>

<style>
    /* Form elemanlarını karanlık yap */
    .form-control, .form-select {
        background-color: #2b3035;
        color: #fff;
        border: 1px solid #495057;
    }
    .form-control:focus, .form-select:focus {
        background-color: #2b3035;
        color: #fff;
        border-color: #ffc107; /* Sarı kenarlık */
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
    .card {
        background-color: #212529; /* Koyu gri kart */
        color: white;
        border: 1px solid #343a40;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <h2 class="text-center mb-4 text-warning">✏️ İçeriği Düzenle</h2>

            <div class="card shadow">
                <div class="card-body p-4">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label class="fw-bold text-light">Başlık</label>
                            <input type="text" name="baslik" class="form-control" value="<?php echo htmlspecialchars($veri['baslik']); ?>" required>
                        </div>

                        <?php if ($tur == 'rota'): ?>
                        <div class="mb-3">
                            <label class="fw-bold text-light">Zorluk</label>
                            <select name="zorluk" class="form-select">
                                <option value="Kolay" <?php if($veri['zorluk_derecesi']=='Kolay') echo 'selected'; ?>>🟢 Kolay</option>
                                <option value="Orta" <?php if($veri['zorluk_derecesi']=='Orta') echo 'selected'; ?>>🟡 Orta</option>
                                <option value="Zor" <?php if($veri['zorluk_derecesi']=='Zor') echo 'selected'; ?>>🔴 Zor</option>
                            </select>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="fw-bold text-light">İçerik</label>
                            <textarea name="icerik" class="form-control" rows="8" required><?php echo htmlspecialchars($veri[$icerik_sutunu]); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-light">Fotoğraf (İsteğe Bağlı)</label>
                            <input type="file" name="resim" class="form-control">
                            <div class="form-text text-white-50">Resmi değiştirmek istemiyorsan boş bırak.</div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold">Kaydet ve Güncelle</button>
                            <a href="detay.php?tur=<?php echo $tur; ?>&id=<?php echo $id; ?>" class="btn btn-outline-secondary">İptal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>