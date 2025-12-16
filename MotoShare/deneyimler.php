<?php
session_start();
require_once 'baglan.php';

$stmt = $db->prepare("SELECT * FROM deneyimler ORDER BY created_at DESC");
$stmt->execute();
$deneyimler = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-primary fw-bold">✍️ Sürücü Deneyimleri</h1>
            <p class="text-white-50">Uzun yol maceraları, gezi notları ve anılar.</p>
        </div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="yeni-deneyim.php" class="btn btn-primary fw-bold">
                <i class="bi bi-plus-lg"></i> Deneyim Yaz
            </a>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($deneyimler as $d): ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-secondary" style="background-color: #2b3035;">
                <img src="<?php echo !empty($d['resim_yolu']) ? $d['resim_yolu'] : 'https://placehold.co/600x400/212529/0d6efd?text=Deneyim+Yazisi'; ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary fw-bold"><?php echo htmlspecialchars($d['baslik']); ?></h5>
                    <p class="card-text text-white-50">
                        <?php echo substr(htmlspecialchars($d['icerik']), 0, 100) . '...'; ?>
                    </p>
                    <div class="mt-auto">
                        <a href="detay.php?tur=deneyim&id=<?php echo $d['id']; ?>" class="btn btn-outline-primary w-100 fw-bold">Okumaya Başla</a>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-secondary text-white-50 small">
                    <i class="bi bi-clock"></i> <?php echo $d['created_at']; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if (count($deneyimler) == 0): ?>
            <div class="col-12"><div class="alert alert-dark border-secondary text-white text-center">Henüz deneyim yazısı paylaşılmamış.</div></div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>