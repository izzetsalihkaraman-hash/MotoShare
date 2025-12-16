<?php
session_start();
require_once 'baglan.php';

// URL'den tür ve id al
$tur = isset($_GET['tur']) ? $_GET['tur'] : '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Hangi tablodan çekeceğiz?
$tablo = "";
if ($tur == 'ekipman') $tablo = "ekipmanlar";
elseif ($tur == 'rota') $tablo = "rotalar";
elseif ($tur == 'deneyim') $tablo = "deneyimler";
else { header("Location: index.php"); exit; }

// 1. İÇERİĞİ ÇEK
$stmt = $db->prepare("SELECT t.*, u.username, u.profil_resmi FROM $tablo t JOIN users u ON t.ekleyen_id = u.id WHERE t.id = ?");
$stmt->execute([$id]);
$icerik = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$icerik) { die("İçerik bulunamadı."); }

// Profil resmi ayarı
$sahip_resim = (!empty($icerik['profil_resmi'])) ? $icerik['profil_resmi'] : "https://ui-avatars.com/api/?name=" . $icerik['username'] . "&background=ffc107&color=000";

// 2. YORUM EKLEME İŞLEMİ (GÜNCELLENDİ: PARENT_ID EKLENDİ)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['yorum_yap'])) {
    if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
    
    $yorum_metni = trim($_POST['yorum']);
    // Formdan gelen parent_id'yi al (Boşsa NULL olsun)
    $parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;

    if (!empty($yorum_metni)) {
        $ekle = $db->prepare("INSERT INTO yorumlar (tur, item_id, user_id, yorum, parent_id) VALUES (?, ?, ?, ?, ?)");
        $ekle->execute([$tur, $id, $_SESSION['user_id'], $yorum_metni, $parent_id]);
        header("Refresh:0"); 
    }
}

// 3. YORUMLARI ÇEK (GÜNCELLENDİ: parent_id ve deleted_at EKLENDİ)
$stmt2 = $db->prepare("
    SELECT y.*, u.username, u.profil_resmi 
    FROM yorumlar y 
    JOIN users u ON y.user_id = u.id 
    WHERE y.tur = ? AND y.item_id = ? 
    ORDER BY y.created_at ASC
");
// Not: Ağaç yapısı için ASC (eskiden yeniye) sıralamak daha mantıklıdır, son yorum en altta görünür.
$stmt2->execute([$tur, $id]);
$tum_yorumlar = $stmt2->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';

// --- ÖZEL FONKSİYON: YORUMLARI AĞAÇ GİBİ YAZDIRMA ---
function yorumlari_listele($yorumlar, $parent_id = null, $seviye = 0) {
    global $tur; // Dışarıdaki $tur değişkenini kullanabilmek için
    
    foreach ($yorumlar as $y) {
        if ($y['parent_id'] == $parent_id) {
            
            // SİLİNME KONTROLÜ (SOFT DELETE)
            $silinmis = !empty($y['deleted_at']);
            
            // Girinti ayarı (Cevapsa sağa kaydır)
            $margin_left = $seviye * 50; 
            
            // Eğer silinmişse bilgileri gizle
            $gorunen_isim = $silinmis ? "Silinmiş Kullanıcı" : htmlspecialchars($y['username']);
            $gorunen_yorum = $silinmis ? "<span class='text-secondary fst-italic'>Bu yorum yazarı tarafından silinmiştir.</span>" : nl2br(htmlspecialchars($y['yorum']));
            $profil_resmi = $silinmis ? "https://ui-avatars.com/api/?name=X&background=333&color=fff" : ((!empty($y['profil_resmi'])) ? $y['profil_resmi'] : "https://ui-avatars.com/api/?name=" . $y['username'] . "&background=adb5bd&color=212529");
            $text_color = $silinmis ? "text-secondary" : "text-warning";
            
            echo '<div class="card bg-dark border-secondary mb-2" style="margin-left: '.$margin_left.'px;">';
            echo '  <div class="card-body p-3">';
            echo '      <div class="d-flex justify-content-between align-items-start">';
            echo '          <div class="d-flex w-100">';
            echo '              <img src="'.$profil_resmi.'" class="rounded-circle me-3 border border-secondary" width="40" height="40" style="object-fit: cover;">';
            echo '              <div class="w-100">';
            
            // Üst Kısım: İsim ve Tarih
            echo '                  <div class="d-flex justify-content-between">';
            echo '                      <h6 class="'.$text_color.' fw-bold mb-1">@'.$gorunen_isim.'</h6>';
            echo '                      <small class="text-white-50" style="font-size: 0.7rem;">'.$y['created_at'].'</small>';
            echo '                  </div>';
            
            // Yorum Metni
            echo '                  <p class="text-white mb-2 small">'.$gorunen_yorum.'</p>';
            
            // Alt Butonlar (Yanıtla, Düzenle, Sil) - SİLİNMİŞSE GÖSTERME
            if (!$silinmis) {
                echo '              <div class="d-flex gap-3">';
                // Yanıtla Butonu
                if (isset($_SESSION['user_id'])) {
                    echo '          <a href="javascript:void(0)" onclick="cevapla('.$y['id'].', \''.$y['username'].'\')" class="text-decoration-none text-info small"><i class="bi bi-reply-fill"></i> Yanıtla</a>';
                }
                
                // Düzenle / Sil (Sadece sahibi veya admin)
                if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $y['user_id'] || (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'))) {
                   echo '           <a href="yorum-duzenle.php?id='.$y['id'].'" class="text-decoration-none text-white-50 small"><i class="bi bi-pencil"></i> Düzenle</a>';
                   echo '           <a href="sil.php?tur=yorum&id='.$y['id'].'" onclick="return confirm(\'Yorumunu silmek istediğine emin misin?\')" class="text-decoration-none text-danger small"><i class="bi bi-trash"></i> Sil</a>';
                }
                echo '              </div>';
            }

            echo '              </div>'; // w-100 bitiş
            echo '          </div>'; // d-flex bitiş
            echo '      </div>'; // justify bitiş
            echo '  </div>'; // card-body bitiş
            echo '</div>'; // card bitiş
            
            // Bu yorumun altına gelen yanıtları bulmak için fonksiyonu tekrar çağırıyoruz (Recursive)
            yorumlari_listele($yorumlar, $y['id'], $seviye + 1);
        }
    }
}
?>

<div class="container mt-5 mb-5">
    
    <div class="card shadow border-secondary bg-dark text-white mb-5">
        <?php if(!empty($icerik['resim_yolu'])): ?>
            <img src="<?php echo $icerik['resim_yolu']; ?>" class="card-img-top" style="max-height: 500px; object-fit: cover;">
        <?php endif; ?>
        
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
                <img src="<?php echo $sahip_resim; ?>" class="rounded-circle me-2" width="40" height="40">
                <div>
                    <h6 class="mb-0 text-warning fw-bold">@<?php echo htmlspecialchars($icerik['username']); ?></h6>
                    <small class="text-white-50"><?php echo $icerik['created_at']; ?></small>
                </div>
                
                <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $icerik['ekleyen_id']): ?>
                    <div class="ms-auto">
                        <a href="sil.php?tur=<?php echo $tur; ?>&id=<?php echo $id; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu içeriği silmek istediğine emin misin?');"><i class="bi bi-trash"></i> Sil</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <h2 class="card-title fw-bold mb-3"><?php echo htmlspecialchars($icerik['baslik']); ?></h2>
            
            <?php if(isset($icerik['zorluk_derecesi'])): ?>
                <span class="badge bg-success mb-3"><?php echo $icerik['zorluk_derecesi']; ?> Seviye</span>
            <?php endif; ?>
            
            <p class="card-text fs-5" style="white-space: pre-wrap;"><?php echo isset($icerik['aciklama']) ? htmlspecialchars($icerik['aciklama']) : htmlspecialchars($icerik['icerik']); ?></p>
        </div>
    </div>

    <h3 class="text-warning mb-4"><i class="bi bi-chat-left-text"></i> Yorumlar (<?php echo count($tum_yorumlar); ?>)</h3>

    <?php if(isset($_SESSION['user_id'])): ?>
        <div class="card bg-dark border-secondary mb-4" id="yorumFormuKarti">
            <div class="card-body">
                <form method="POST" id="yorumFormu">
                    <input type="hidden" name="parent_id" id="parent_id" value="">
                    
                    <div id="cevapBilgi" class="alert alert-secondary d-none p-2 mb-2 small">
                        <span id="cevaplananKisi" class="fw-bold"></span> kişisine yanıt veriyorsun. 
                        <button type="button" class="btn-close btn-close-white float-end" onclick="cevapIptal()"></button>
                    </div>

                    <div class="mb-3">
                        <textarea name="yorum" id="yorumAlani" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Fikrini paylaş..." required></textarea>
                    </div>
                    <button type="submit" name="yorum_yap" class="btn btn-warning fw-bold text-dark">Yorumu Gönder</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-dark border-secondary text-white-50">Yorum yapmak için <a href="login.php" class="text-warning">giriş yapmalısın</a>.</div>
    <?php endif; ?>

    <div class="yorumlar-alani">
        <?php 
            if(count($tum_yorumlar) > 0) {
                // Recursive fonksiyonu çağırıyoruz (Ana yorumlar parent_id = NULL veya 0 dır)
                yorumlari_listele($tum_yorumlar, null); 
            } else {
                echo '<p class="text-white-50">Henüz hiç yorum yapılmamış. İlk yorumu sen yap!</p>';
            }
        ?>
    </div>

</div>

<script>
function cevapla(id, username) {
    // 1. Formdaki gizli inputa ID'yi yaz
    document.getElementById('parent_id').value = id;
    
    // 2. Bilgi mesajını göster
    document.getElementById('cevapBilgi').classList.remove('d-none');
    document.getElementById('cevaplananKisi').innerText = '@' + username;
    
    // 3. Textarea'ya odaklan ve sayfayı forma kaydır
    document.getElementById('yorumAlani').focus();
    document.getElementById('yorumFormuKarti').scrollIntoView({behavior: 'smooth'});
}

function cevapIptal() {
    // İptal edilirse her şeyi sıfırla
    document.getElementById('parent_id').value = '';
    document.getElementById('cevapBilgi').classList.add('d-none');
}
</script>

<?php include 'includes/footer.php'; ?>