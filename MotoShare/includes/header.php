<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoShare - Motosiklet Tutkunları</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #212529;
            color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            background-color: #1a1d20 !important;
        }
        .dropdown-menu-dark {
            background-color: #343a40;
            border: 1px solid #495057;
        }
        a { text-decoration: none; }
        footer { margin-top: auto; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-secondary sticky-top">
  <div class="container"> 
    
    <a class="navbar-brand fw-bold text-warning" href="index.php">
        <i class="bi bi-speedometer2"></i> MotoShare
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Ana Sayfa</a></li>
        <li class="nav-item"><a class="nav-link" href="reviews.php">İncelemeler</a></li>
        <li class="nav-item"><a class="nav-link" href="rotalar.php">Rotalar</a></li>
        <li class="nav-item"><a class="nav-link" href="deneyimler.php">Deneyimler</a></li>
      </ul>
      
      <ul class="navbar-nav">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    <span class="fw-bold text-warning">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow">
                    <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-circle me-2"></i>Profilim</a></li>
                    <li><hr class="dropdown-divider border-secondary"></li>
                    <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Çıkış Yap</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Giriş Yap</a></li>
            <li class="nav-item"><a class="btn btn-warning btn-sm text-dark ms-2 fw-bold px-3" href="register.php">Kayıt Ol</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>