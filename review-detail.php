<?php include 'includes/header.php'; ?>

<?php
// --- FRONT-END İÇİN SAHTE VERİTABANI ---
// Sanki veritabanından geliyormuş gibi sahte veriler hazırlıyoruz.
$ornek_incelemeler = [
    1 => [
        'baslik' => 'Shoei NXR 2 Kask İncelemesi',
        'yazar' => '@motorcu_kardes',
        'tarih' => '25 Ekim 2025',
        'puan' => 5,
        'gorsel' => 'https://placehold.co/900x500/212529/FFF?text=Shoei+NXR+2',
        'icerik' => 'Uzun yol ve şehir içi kullanımda NXR 2\'nin artılarını ve eksilerini detaylıca inceledim. Rüzgar sesi, konfor ve güvenlik konularında sınıfının en iyilerinden. Özellikle havalandırması yaz aylarında büyük bir ferahlık sağlıyor. Tek eksiği fiyatının biraz yüksek olması diyebilirim.'
    ],
    2 => [
        'baslik' => 'Dainese Racing 4 Deri Mont',
        'yazar' => '@hizli_gonzales',
        'tarih' => '22 Ekim 2025',
        'puan' => 4,
        'gorsel' => 'https://placehold.co/900x500/212529/FFF?text=Dainese+Racing+4',
        'icerik' => 'Pist kullanımı ve sportif sürüşler için tasarlanmış bu mont, günlük kullanımda da oldukça başarılı. Malzeme kalitesi ve koruma seviyesi üst düzey. Ancak yaz sıcaklarında biraz terletebiliyor. Bahar ayları için mükemmel bir seçim.'
    ],
    3 => [
        'baslik' => 'Five RFX1 Eldiven Testi',
        'yazar' => '@viraj_ustasi',
        'tarih' => '20 Ekim 2025',
        'puan' => 5,
        'gorsel' => 'https://placehold.co/900x500/212529/FFF?text=Five+RFX1',
        'icerik' => 'Güvenlikte zirveyi hedefleyen RFX1, uzun süreli kullanımlarda bile konforundan ödün vermiyor. Elinize tam oturuyor ve hissiyatı kaybetmiyorsunuz. Profesyonel ve amatör tüm sürücülere tavsiye ederim. Verdiğiniz paranın hakkını sonuna kadar veriyor.'
    ],
    // Diğer kartlar için de buraya veri eklenebilir.
];

// Adres çubuğundan gelen ID'yi alıyoruz. Eğer ID yoksa veya geçersizse, varsayılan olarak 1'i kullan.
$id = isset($_GET['id']) && array_key_exists($_GET['id'], $ornek_incelemeler) ? $_GET['id'] : 1;

// Doğru incelemeyi sahte veritabanından seçiyoruz.
$inceleme = $ornek_incelemeler[$id];

// Puanı yıldızlara çevirelim.
$yildizlar = str_repeat('★', $inceleme['puan']) . str_repeat('☆', 5 - $inceleme['puan']);

?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <h1 class="display-5"><?= htmlspecialchars($inceleme['baslik']) ?></h1>
        
        <div class="d-flex align-items-center my-3 text-body-secondary">
             <img src="https://placehold.co/40x40/ffc107/000?text=<?= strtoupper(substr($inceleme['yazar'], 1, 1)) ?>" class="rounded-circle me-2" alt="Avatar">
             <span><strong><?= htmlspecialchars($inceleme['yazar']) ?></strong> tarafından, <?= $inceleme['tarih'] ?> tarihinde yayınlandı.</span>
        </div>

        <div class="mb-3 fs-4 text-warning">
            <?= $yildizlar ?>
        </div>

        <img src="<?= htmlspecialchars($inceleme['gorsel']) ?>" class="img-fluid rounded mb-4" alt="Ekipman Görseli">

        <article class="lead">
            <p><?= nl2br(htmlspecialchars($inceleme['icerik'])) ?></p>
        </article>
        
        <hr class="my-5">
        <h3 class="mb-4">Yorumlar (2)</h3>
        </div>
</div>

<?php include 'includes/footer.php'; ?>