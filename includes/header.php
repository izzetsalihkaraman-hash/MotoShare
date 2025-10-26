<?php 
// Veritabanı bağlantısı ve oturum için config dosyasını çağırır.
require_once 'config.php'; 
?>
<!DOCTYPE html>
<html lang="tr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoShare - Motosiklet Ekipman ve Deneyim Platformu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-body" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
        <i class="bi bi-bullseye"></i> MotoShare
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Ana Sayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reviews.php">Ekipman İncelemeleri</a>
        </li>
        <li class="nav-item">
  <a class="nav-link" href="deneyimler.php">Deneyim Yazıları</a>
</li>
 <li class="nav-item">
  <a class="nav-link" href="rotalar.php">Rotalar</a>
</li>
      </ul>
      <div class="d-flex">
          <?php if (is_logged_in()): // Kullanıcı giriş yapmışsa ?>
            <div class="dropdown">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://placehold.co/32x32/ffc107/000?text=<?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>" alt="Avatar" width="32" height="32" class="rounded-circle border border-2 border-warning">
              </a>
              <ul class="dropdown-menu dropdown-menu-end text-small">
                <li><h6 class="dropdown-header">Hoş geldin, <?= htmlspecialchars($_SESSION['username']) ?>!</h6></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="new-review.php"><i class="bi bi-plus-circle me-2"></i>Yeni İnceleme Ekle</a></li>
                <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-circle me-2"></i>Profilim</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li><a class="dropdown-item" href="admin/dashboard.php"><i class="bi bi-gear-fill me-2"></i>Yönetim Paneli</a></li>
                <?php endif; ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Çıkış Yap</a></li>
              </ul>
            </div>
          <?php else: // Kullanıcı giriş yapmamışsa ?>
            <a href="login.php" class="btn btn-outline-warning me-2">Giriş Yap</a>
            <a href="register.php" class="btn btn-warning">Kayıt Ol</a>
          <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<main class="container my-5">