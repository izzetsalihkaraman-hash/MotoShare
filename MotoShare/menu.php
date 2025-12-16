<?php
// Oturum başlatılmamışsa başlat (Hata almamak için kontrol)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Dosya adını alıp aktif menüyü boyayalım
$aktif_sayfa = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">🏍️ MotoShare</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($aktif_sayfa == 'index.php') ? 'active' : ''; ?>" href="index.php">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($aktif_sayfa == 'rotalar.php') ? 'active' : ''; ?>" href="rotalar.php">Rotalar</a>
                </li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle btn btn-outline-secondary text-white px-3" href="#" role="button" data-bs-toggle="dropdown">
                            👤 <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="ekipman-ekle.php">+ Ekipman Ekle</a></li>
                            <li><a class="dropdown-item" href="yeni-rota.php">+ Rota Ekle</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Çıkış Yap</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-light btn-sm" href="login.php">Giriş Yap</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-warning btn-sm text-dark fw-bold" href="register.php">Kayıt Ol</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>