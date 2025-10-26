<?php include 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <img src="https://placehold.co/150x150/ffc107/000?text=USER" class="rounded-circle mb-3 border border-3 border-warning" alt="Profil Fotoğrafı">
                <h3 class="card-title">@kullanici_adi</h3>
                <p class="text-body-secondary">kullanici@email.com</p>
                <p class="text-body-secondary">Üyelik Tarihi: 26 Ekim 2025</p>
                <hr>
                <div class="d-grid gap-2">
                     <a href="#" class="btn btn-outline-warning">Profili Düzenle</a>
                     <a href="#" class="btn btn-outline-secondary">Şifre Değiştir</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <h2 class="mb-4">Paylaştığım İncelemeler</h2>
        <div class="list-group">
            <a href="review-detail.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Shoei NXR 2 Kask İncelemesi</h5>
                    <small>Yayınlanma Tarihi: 25 Ekim 2025</small>
                </div>
                <span class="badge bg-warning rounded-pill">★★★★★</span>
            </a>
            <a href="review-detail.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Dainese Racing 4 Deri Mont</h5>
                    <small>Yayınlanma Tarihi: 20 Ekim 2025</small>
                </div>
                <span class="badge bg-warning rounded-pill">★★★★☆</span>
            </a>
            <a href="review-detail.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Five RFX1 Eldiven Testi</h5>
                    <small>Yayınlanma Tarihi: 15 Ekim 2025</small>
                </div>
                <span class="badge bg-warning rounded-pill">★★★☆☆</span>
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>