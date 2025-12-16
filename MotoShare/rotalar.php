<?php
session_start();
require_once 'baglan.php';

$stmt = $db->prepare("SELECT * FROM rotalar ORDER BY created_at DESC");
$stmt->execute();
$rotalar = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-success fw-bold">🗺️ Tüm Rotalar</h1>
            <p class="text-white-50">Yeni yerler keşfetmeye hazır mısın?</p>
        </div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="yeni-rota.php" class="btn btn-success fw-bold">
                <i class="bi bi-plus-lg"></i> Rota Öner
            </a>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($rotalar as $rota): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-secondary" style="background-color: #2b3035;">
                <img src="<?php echo !empty($rota['resim_yolu']) ? $rota['resim_yolu'] : 'https://placehold.co/600x400/212529/198754?text=Rota+Paylasimi'; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title text-success fw-bold mb-0"><?php echo htmlspecialchars($rota['baslik']); ?></h5>
                        <span class="badge bg-success small"><?php echo $rota['zorluk_derecesi']; ?></span>
                    </div>
                    <p class="card-text text-white-50">
                        <?php echo substr(htmlspecialchars($rota['aciklama']), 0, 100) . '...'; ?>
                    </p>
                    <div class="mt-auto">
                        <a href="detay.php?tur=rota&id=<?php echo $rota['id']; ?>" class="btn btn-outline-success w-100 fw-bold">Rotayı Gör</a>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-secondary text-white-50 small">
                    <i class="bi bi-clock"></i> <?php echo $rota['created_at']; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (count($rotalar) == 0): ?>
            <div class="col-12"><div class="alert alert-dark border-secondary text-white text-center">Henüz rota yok.</div></div>
        <?php endif; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>