<?php
session_start(); // Oturumu başlat
require_once 'baglan.php';

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kullanıcı var mı ve şifre doğru mu kontrol et
        if ($user && password_verify($password, $user['password'])) {
            // Oturum Değişkenlerini Ata
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // admin, editor veya user

            header("Location: index.php"); // Ana sayfaya gönder
            exit;
        } else {
            $mesaj = '<div class="alert alert-danger">E-posta veya şifre hatalı!</div>';
        }
    } catch (PDOException $e) {
        $mesaj = "Hata: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap - MotoShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-3">Giriş Yap 🔑</h3>
        <?php echo $mesaj; ?>
        <form method="POST">
            <div class="mb-3">
                <label>E-Posta</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Giriş Yap</button>
        </form>
        <div class="text-center mt-3">
            <a href="register.php">Hesabın yok mu? Kayıt Ol</a> | <a href="index.php">Ana Sayfa</a>
        </div>
    </div>
</body>
</html>