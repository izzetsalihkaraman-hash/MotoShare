<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php include 'includes/header.php'; ?>

<h1 class="mb-4">Yeni Rota Paylaş</h1>

<div class="card">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Rota Adı</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Örn: Fethiye - Kaş Sahil Yolu" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="distance" class="form-label">Toplam Mesafe (KM)</label>
                    <input type="number" class="form-control" id="distance" name="distance" placeholder="Örn: 150" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="difficulty" class="form-label">Zorluk Seviyesi</label>
                    <select class="form-select" id="difficulty" name="difficulty" required>
                        <option selected disabled value="">Seviye seçin...</option>
                        <option value="Kolay">Kolay (Manzara)</option>
                        <option value="Orta">Orta (Keyifli Virajlar)</option>
                        <option value="Zor">Zor (Teknik)</option>
                        <option value="Profesyonel">Profesyonel (İleri Seviye)</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Rota Detayları ve Tavsiyeler</label>
                <textarea class="form-control" id="content" name="content" rows="8" placeholder="Mola verilecek güzel yerler, dikkat edilmesi gereken virajlar, yol durumu gibi bilgileri burada paylaşabilirsin..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Rotadan Bir Fotoğraf Yükle</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning btn-lg">Rotayı Paylaş</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>