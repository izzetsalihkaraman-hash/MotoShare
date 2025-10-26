<?php include 'includes/header.php'; ?>

<div class="row mb-4">
    <div class="col">
        <h1 class="display-6">Tüm Deneyim Yazıları</h1>
        <p class="lead text-body-secondary">Uzun yol maceraları, gezi notları ve unutulmaz anılar bu başlık altında.</p>
    </div>
    <div class="col-auto">
        <a href="yeni-deneyim.php" class="btn btn-warning btn-lg"><i class="bi bi-plus-circle me-2"></i>Deneyim Ekle</a>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php for($i=1; $i<=6; $i++): // 6 örnek kart ?>
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="https://placehold.co/600x400/212579/FFF?text=Deneyim+<?= $i ?>" class="card-img-top" alt="Deneyim Resmi">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Deneyim Başlığı <?= $i ?>: Unutulmaz Bir Gezi</h5>
                <p class="card-text text-truncate">Bu alana deneyim yazısının ilk birkaç satırı gelecek. Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                    <small class="text-body-secondary">Yazar: @gezen_motorcu</small>
                    <a href="#" class="btn btn-sm btn-outline-warning">Devamını Oku</a>
                </div>
            </div>
        </div>
    </div>
    <?php endfor; ?>
</div>

<?php include 'includes/footer.php'; ?>