<?php
session_start();
require_once 'baglan.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$mesaj = "";

// --- 1. RESİM SİLME İŞLEMİ (YENİ) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resim_sil'])) {
    // Veritabanındaki resim yolunu NULL yapıyoruz (Dosyayı sunucudan silmesek de olur, veritabanından silmek yeterli)
    $sil = $db->prepare("UPDATE users SET profil_resmi = NULL WHERE id = ?");
    $sil->execute([$user_id]);
    header("Refresh:0"); // Sayfayı yenile
}

// --- 2. RESİM YÜKLEME İŞLEMİ ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profil_resmi"])) {
    $hedef = "uploads/" . time() . "_profil_" . basename($_FILES["profil_resmi"]["name"]);
    if (move_uploaded_file($_FILES["profil_resmi"]["tmp_name"], $hedef)) {
        $db->prepare("UPDATE users SET profil_resmi = ? WHERE id = ?")->execute([$hedef, $user_id]);
        header("Refresh:0");
    }
}

// --- 3. E-POSTA GÜNCELLEME İŞLEMİ ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['yeni_email'])) {
    $yeni_email = $_POST['yeni_email'];
    if (!empty($yeni_email)) {
        try {
            $guncelle = $db->prepare("UPDATE users SET email = ? WHERE id = ?");
            $guncelle->execute([$yeni_email, $user_id]);
            $mesaj = '<div class="alert alert-success">E-posta adresi güncellendi! ✅</div>';
        } catch (PDOException $e) {
            $mesaj = '<div class="alert alert-danger">Bu e-posta kullanımda.</div>';
        }
    }
}

// Kullanıcı Bilgilerini Çek
$kullaniciSor = $db->prepare("SELECT email, created_at, profil_resmi FROM users WHERE id = ?");
$kullaniciSor->execute([$user_id]);
$kullanici = $kullaniciSor->fetch(PDO::FETCH_ASSOC);

$email = isset($kullanici['email']) ? $kullanici['email'] : ''; 
$kayit_tarihi = isset($kullanici['created_at']) ? date("d.m.Y", strtotime($kullanici['created_at'])) : '2025';

// Profil Resmi Kontrolü (Silme butonu için kontrol edeceğiz)
$ozel_resim_var_mi = (!empty($kullanici['profil_resmi']) && file_exists($kullanici['profil_resmi']));
$profil_resmi = $ozel_resim_var_mi ? $kullanici['profil_resmi'] : "https://ui-avatars.com/api/?name=$username&background=ffc107&color=000&size=128&bold=true";

// İstatistikler
$sorgu1 = $db->prepare("SELECT COUNT(*) FROM ekipmanlar WHERE ekleyen_id = ?"); $sorgu1->execute([$user_id]); $sayi_ekipman = $sorgu1->fetchColumn();
$sorgu2 = $db->prepare("SELECT COUNT(*) FROM rotalar WHERE ekleyen_id = ?"); $sorgu2->execute([$user_id]); $sayi_rota = $sorgu2->fetchColumn();
$sorgu3 = $db->prepare("SELECT COUNT(*) FROM deneyimler WHERE ekleyen_id = ?"); $sorgu3->execute([$user_id]); $sayi_deneyim = $sorgu3->fetchColumn();

// Paylaşımlar
$sql = "
    (SELECT id, baslik, created_at, 'ekipman' as tur FROM ekipmanlar WHERE ekleyen_id = ?)
    UNION ALL
    (SELECT id, baslik, created_at, 'rota' as tur FROM rotalar WHERE ekleyen_id = ?)
    UNION ALL
    (SELECT id, baslik, created_at, 'deneyim' as tur FROM deneyimler WHERE ekleyen_id = ?)
    ORDER BY created_at DESC
";
$stmt = $db->prepare($sql);
$stmt->execute([$user_id, $user_id, $user_id]);
$paylasimlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-secondary bg-dark text-white text-center p-4">
                
                <div class="mb-3 position-relative d-inline-block">
                    <img src="<?php echo $profil_resmi; ?>" class="rounded-circle border border-3 border-warning p-1" style="width: 128px; height: 128px; object-fit: cover;">
                    
                    <button class="btn btn-sm btn-warning position-absolute bottom-0 end-0 rounded-circle shadow" onclick="document.getElementById('resimInput').click();" title="Resmi Değiştir" style="transform: translate(10%, -10%);">
                        <i class="bi bi-camera-fill"></i>
                    </button>

                    <?php if ($ozel_resim_var_mi): ?>
                        <form method="POST" onsubmit="return confirm('Profil fotoğrafını silmek istediğine emin misin?');" style="display:inline;">
                            <input type="hidden" name="resim_sil" value="1">
                            <button type="submit" class="btn btn-sm btn-danger position-absolute bottom-0 start-0 rounded-circle shadow" title="Resmi Sil" style="transform: translate(-10%, -10%);">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <form method="POST" enctype="multipart/form-data" id="resimForm">
                    <input type="file" name="profil_resmi" id="resimInput" style="display: none;" onchange="document.getElementById('resimForm').submit();">
                </form>

                <?php echo $mesaj; ?>

                <h3 class="text-warning fw-bold mt-2">@<?php echo htmlspecialchars($username); ?></h3>
                <p class="text-white-50 mb-1"><?php echo htmlspecialchars($email); ?></p>
                <p class="small text-light mb-3"><i class="bi bi-calendar-check"></i> Üyelik: <b><?php echo $kayit_tarihi; ?></b></p>
                
                <button type="button" class="btn btn-sm btn-outline-light mb-3" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="bi bi-pencil-square"></i> Bilgileri Düzenle
                </button>
                
                <div class="d-grid gap-2 border-top border-secondary pt-3">
                    <a href="logout.php" class="btn btn-outline-danger fw-bold"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a>
                </div>
            </div>

            <div class="card mt-3 shadow border-secondary bg-dark text-white">
                <div class="card-header border-secondary fw-bold">📊 İstatistiklerim</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between">
                        <span>🛡️ İncelemeler</span> <span class="badge bg-warning text-dark"><?php echo $sayi_ekipman; ?></span>
                    </li>
                    <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between">
                        <span>🗺️ Rotalar</span> <span class="badge bg-success"><?php echo $sayi_rota; ?></span>
                    </li>
                    <li class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between">
                        <span>✍️ Deneyimler</span> <span class="badge bg-primary"><?php echo $sayi_deneyim; ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8">
            <h3 class="text-warning mb-4 pb-2 border-bottom border-secondary">Son Paylaşımlarım</h3>
            <?php if (count($paylasimlar) > 0): ?>
                <div class="list-group shadow">
                    <?php foreach ($paylasimlar as $p): ?>
                        <?php $ikon = ($p['tur'] == 'ekipman') ? "🛡️" : (($p['tur'] == 'rota') ? "🗺️" : "✍️"); ?>
                        <a href="detay.php?tur=<?php echo $p['tur']; ?>&id=<?php echo $p['id']; ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary d-flex justify-content-between align-items-center p-3 mb-2 rounded border">
                            <div>
                                <h5 class="mb-1 text-warning fw-bold"><?php echo $ikon . ' ' . htmlspecialchars($p['baslik']); ?></h5>
                                <small class="text-white-50"><?php echo $p['created_at']; ?></small>
                            </div>
                            <span class="btn btn-sm btn-outline-light">Görüntüle &rarr;</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-dark text-center py-5 border-secondary"><h4 class="text-white">Henüz paylaşım yok.</h4></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white border-secondary">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-warning">✏️ Profil Bilgilerini Güncelle</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Kullanıcı Adı (Değiştirilemez)</label>
                <input type="text" class="form-control bg-secondary text-white border-0" value="<?php echo $username; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Yeni E-posta Adresi</label>
                <input type="email" name="yeni_email" class="form-control bg-dark text-white border-secondary" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-warning fw-bold">Kaydet ve Güncelle</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>