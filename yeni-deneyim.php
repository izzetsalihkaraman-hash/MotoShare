<?php include 'includes/header.php'; ?>

<h1 class="mb-4">Yeni Deneyim Yazısı Ekle</h1>

<div class="card">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Deneyim Başlığı</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Örn: Unutulmaz Karadeniz Turum" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Deneyim Detayları</label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Gezi notlarını, yaşadığın maceraları ve tavsiyelerini burada paylaş..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Deneyimle İlgili Bir Fotoğraf Yükle</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning btn-lg">Deneyimi Yayınla</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>