<?php
require_once 'baglan.php';

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Şifreyi güvenli hale getir (Hashleme - Ödevde puan getirir)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // E-posta kontrolü (Aynı maille iki kere kayıt olunamaz)
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $mesaj = '<div class="alert alert-warning">Bu e-posta adresi zaten kayıtlı!</div>';
        } else {
            // Kayıt İşlemi
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')";
            $stmt = $db->prepare($sql);
            
            if ($stmt->execute([$username, $email, $hashed_password])) {
                $mesaj = '<div class="alert alert-success">Kayıt Başarılı! Giriş sayfasına yönlendiriliyorsunuz...</div>';
                header("refresh:2;url=login.php"); // 2 saniye sonra giriş sayfasına atar
            }
        }
    } catch (PDOException $e) {
        $mesaj = '<div class="alert alert-danger">Hata: ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol - MotoShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-3">Kayıt Ol 📝</h3>
        <?php echo $mesaj; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Kullanıcı Adı</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>E-Posta</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Zaten hesabın var mı? Giriş Yap</a>
        </div>
    </div>
</body>
</html>