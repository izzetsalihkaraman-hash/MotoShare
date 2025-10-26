<?php include 'includes/header.php'; ?>

<div class="row mb-4">
    <div class="col">
        <h1 class="display-6">Tüm Paylaşılan Rotalar</h1>
        <p class="lead text-body-secondary">Türkiye'nin dört bir yanından, sürücüler tarafından test edilmiş en güzel motosiklet rotaları.</p>
    </div>
    <div class="col-auto">
        <a href="yeni-rota.php" class="btn btn-warning btn-lg"><i class="bi bi-plus-circle me-2"></i>Rota Ekle</a>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php for($i=1; $i<=6; $i++): // 6 örnek kart ?>
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="https://placehold.co/600x400/217929/FFF?text=Rota+<?= $i ?>" class="card-img-top" alt="Rota Resmi">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Rota Başlığı <?= $i ?>: Ege Sahil Turu</h5>
                <p class="card-text text-truncate">Bu alana rotanın kısa bir özeti gelecek. Kaç km olduğu, viraj durumu, mola yerleri gibi bilgiler...</p>
                <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                    <small class="text-body-secondary">Paylaşan: @viraj_krali</small>
                    <a href="#" class="btn btn-sm btn-outline-warning">Detayları Gör</a>
                </div>
            </div>
        </div>
    </div>
    <?php endfor; ?>
</div>

<?php include 'includes/footer.php'; ?>