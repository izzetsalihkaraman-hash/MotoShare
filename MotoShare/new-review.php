<?php include 'includes/header.php'; ?>

<h1 class="mb-4">Yeni Ekipman İncelemesi Ekle</h1>

<div class="card">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">İnceleme Başlığı</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Örn: Shoei NXR 2 Kask İncelemesi" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Ekipman Kategorisi</label>
                    <select class="form-select" id="category" name="category_id" required>
                        <option selected disabled value="">Lütfen bir kategori seçin...</option>
                        <option value="1">Kask</option>
                        <option value="2">Motosiklet Montu</option>
                        <option value="3">Eldiven</option>
                        <option value="4">Motosiklet Botu</option>
                        <option value="5">Interkom</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rating" class="form-label">Puanınız (1-5 Yıldız)</label>
                    <select class="form-select" id="rating" name="rating" required>
                        <option selected disabled value="">Puan verin...</option>
                        <option value="5">★★★★★ (Mükemmel)</option>
                        <option value="4">★★★★☆ (İyi)</option>
                        <option value="3">★★★☆☆ (Orta)</option>
                        <option value="2">★★☆☆☆ (Kötü)</option>
                        <option value="1">★☆☆☆☆ (Çok Kötü)</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Detaylı İncelemeniz</label>
                <textarea class="form-control" id="content" name="content" rows="8" placeholder="Ekipmanın artılarını, eksilerini ve genel deneyimlerinizi burada paylaşın..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ekipman Fotoğrafı Yükle</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning btn-lg">İncelemeyi Yayınla</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>