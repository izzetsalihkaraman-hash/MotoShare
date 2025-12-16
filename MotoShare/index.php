<?php
session_start();
require_once 'baglan.php';

// 1. Son Eklenen Ekipmanları Çek
$stmt = $db->prepare("SELECT * FROM ekipmanlar ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$incelemeler = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 2. Son Eklenen Rotaları Çek
$stmt2 = $db->prepare("SELECT * FROM rotalar ORDER BY created_at DESC LIMIT 3");
$stmt2->execute();
$rotalar = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// 3. Son Eklenen Deneyimleri Çek
$stmt3 = $db->prepare("SELECT * FROM deneyimler ORDER BY created_at DESC LIMIT 3");
$stmt3->execute();
$deneyimler = $stmt3->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="p-5 mb-4 bg-body-tertiary rounded-3 text-center shadow-sm border border-secondary" style="background-color: #212529 !important;">
    <div class="container-fluid py-4">
        
        <?php if(isset($_SESSION['user_id'])): ?>
            <h1 class="display-5 fw-bold text-warning">Selam, <?php echo htmlspecialchars($_SESSION['username']); ?>! 🏍️</h1>
            <p class="fs-4 mb-4 text-light">Tecrübelerini paylaşmak için bir kategori seç:</p>
            
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="ekipman-ekle.php" class="btn btn-warning btn-lg px-4 fw-bold text-dark">
                    <i class="bi bi-helmet me-2"></i>Ekipman İncele
                </a>
                <a href="yeni-rota.php" class="btn btn-success btn-lg px-4 fw-bold">
                    <i class="bi bi-map-fill me-2"></i>Rota Öner
                </a>
                <a href="yeni-deneyim.php" class="btn btn-primary btn-lg px-4 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>Deneyim Yaz
                </a>
            </div>

        <?php else: ?>
            <h1 class="display-5 fw-bold text-light">Gerçek Sürücü Deneyimleri</h1>
            <p class="fs-4 text-white-50">Reklamlara değil, gerçek kullanıcı yorumlarına güven. Sen de katıl, rotanı ve ekipmanını paylaş.</p>
            
            <div class="mt-4">
                <a href="register.php" class="btn btn-warning btn-lg px-5 me-2 fw-bold text-dark">Kayıt Ol</a>
                <a href="login.php" class="btn btn-outline-light btn-lg px-5">Giriş Yap</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<div class="container pb-5">

    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
        <h2 class="fw-bold text-warning">🛡️ Son İncelemeler</h2>
        <a href="reviews.php" class="text-decoration-none text-muted">Tümünü Gör &rarr;</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php if (count($incelemeler) > 0): ?>
            <?php foreach ($incelemeler as $yazi): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-secondary" style="background-color: #2b3035;">
                    <img src="<?php echo !empty($yazi['resim_yolu']) ? $yazi['resim_yolu'] : 'https://placehold.co/600x400/212529/ffc107?text=Gorsel+Yok'; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column text-white">
                        <h5 class="card-title text-warning"><?php echo htmlspecialchars($yazi['baslik']); ?></h5>
                        <p class="card-text text-white-50 text-truncate"><?php echo substr($yazi['aciklama'], 0, 100); ?>...</p>
                        <div class="mt-auto">
                            <a href="detay.php?tur=ekipman&id=<?php echo $yazi['id']; ?>" class="btn btn-outline-warning w-100">İncelemeyi Oku</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"><div class="alert alert-dark text-center text-muted">Henüz inceleme yok.</div></div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-success">🗺️ Yeni Rotalar</h2>
        <a href="rotalar.php" class="text-decoration-none text-muted">Tümünü Gör &rarr;</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php if (count($rotalar) > 0): ?>
            <?php foreach ($rotalar as $rota): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-secondary" style="background-color: #2b3035;">
                    <img src="<?php echo !empty($rota['resim_yolu']) ? $rota['resim_yolu'] : 'https://placehold.co/600x400/212529/198754?text=Rota+Haritasi'; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column text-white">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0 text-truncate text-success"><?php echo htmlspecialchars($rota['baslik']); ?></h5>
                            <span class="badge bg-success"><?php echo $rota['zorluk_derecesi']; ?></span>
                        </div>
                        <p class="card-text text-white-50 text-truncate"><?php echo substr($rota['aciklama'], 0, 90); ?>...</p>
                        <div class="mt-auto">
                            <a href="detay.php?tur=rota&id=<?php echo $rota['id']; ?>" class="btn btn-outline-success w-100">Rotayı Gör</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"><div class="alert alert-dark text-center text-muted">Henüz rota yok.</div></div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary">✍️ Son Deneyim Yazıları</h2>
        <a href="deneyimler.php" class="text-decoration-none text-muted">Tümünü Gör &rarr;</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php if (count($deneyimler) > 0): ?>
            <?php foreach ($deneyimler as $d): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-secondary" style="background-color: #2b3035;">
                    <img src="<?php echo !empty($d['resim_yolu']) ? $d['resim_yolu'] : 'https://placehold.co/600x400/212529/0d6efd?text=Deneyim+Yazisi'; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column text-white">
                        <h5 class="card-title text-primary"><?php echo htmlspecialchars($d['baslik']); ?></h5>
                        <p class="card-text text-white-50 text-truncate"><?php echo substr($d['icerik'], 0, 100); ?>...</p>
                        <div class="mt-auto">
                            <a href="detay.php?tur=deneyim&id=<?php echo $d['id']; ?>" class="btn btn-outline-primary w-100">Okumaya Başla</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"><div class="alert alert-dark text-center text-muted">Henüz deneyim yazısı yok.</div></div>
        <?php endif; ?>
    </div>

</div>

<?php include 'includes/footer.php'; ?>