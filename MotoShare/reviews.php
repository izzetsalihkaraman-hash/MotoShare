<?php
session_start();
require_once 'baglan.php';

$stmt = $db->prepare("SELECT * FROM ekipmanlar ORDER BY created_at DESC");
$stmt->execute();
$ekipmanlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-warning fw-bold">🛡️ Tüm Ekipman İncelemeleri</h1>
            <p class="text-white-50">Kask, mont, eldiven... Sürücülerin gerçek yorumları.</p>
        </div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="ekipman-ekle.php" class="btn btn-warning fw-bold text-dark">
                <i class="bi bi-plus-lg"></i> İnceleme Ekle
            </a>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($ekipmanlar as $ekipman): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-secondary" style="background-color: #2b3035;">
                <img src="<?php echo !empty($ekipman['resim_yolu']) ? $ekipman['resim_yolu'] : 'https://placehold.co/600x400/212529/ffc107?text=Ekipman+Incelemesi'; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-warning fw-bold"><?php echo htmlspecialchars($ekipman['baslik']); ?></h5>
                    <p class="card-text text-white-50">
                        <?php echo substr(htmlspecialchars($ekipman['aciklama']), 0, 100) . '...'; ?>
                    </p>
                    <div class="mt-auto">
                        <a href="detay.php?tur=ekipman&id=<?php echo $ekipman['id']; ?>" class="btn btn-outline-warning w-100 fw-bold">İncelemeyi Oku</a>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-secondary text-white-50 small">
                    <i class="bi bi-clock"></i> <?php echo $ekipman['created_at']; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (count($ekipmanlar) == 0): ?>
            <div class="col-12"><div class="alert alert-dark border-secondary text-white text-center">Henüz içerik yok.</div></div>
        <?php endif; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>