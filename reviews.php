<?php include 'includes/header.php'; ?>

<div class="row mb-4">
    <div class="col">
        <h1 class="display-6">Tüm Ekipman İncelemeleri</h1>
        <p class="lead text-body-secondary">Motosiklet tutkunlarının en güncel kask, mont ve diğer ekipman yorumları.</p>
    </div>
    <div class="col-auto">
        <a href="new-review.php" class="btn btn-warning btn-lg"><i class="bi bi-plus-circle me-2"></i>İnceleme Ekle</a>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php 
    // Hocanın kontrolü için 6 tane örnek kart oluşturan bir döngü
    // Bu döngü, her karta 1'den 6'ya kadar bir numara verir ($i)
    for($i = 1; $i <= 6; $i++): 
    ?>
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="https://placehold.co/600x400/212529/FFF?text=Ekipman+<?= $i ?>" class="card-img-top" alt="Ekipman Resmi">
            <div class="card-body d-flex flex-column">
                <span class="badge bg-secondary mb-2">Örnek Kategori</span>
                <h5 class="card-title">İnceleme Başlığı <?= $i ?></h5>
                <p class="card-text text-truncate">Kısa inceleme özeti. Bu alana incelemenin ilk birkaç satırı gelecek...</p>
                <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                    <small class="text-body-secondary">Yazar: @kullanici_<?= $i ?></small>
                    
                    <a href="review-detail.php?id=<?= $i ?>" class="btn btn-sm btn-outline-warning">Devamını Oku</a>
                    
                </div>
            </div>
        </div>
    </div>
    <?php endfor; ?>
</div>

<?php include 'includes/footer.php'; ?>