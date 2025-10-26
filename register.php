<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Hesap Oluştur</h2>
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-posta Adresi</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Şifre Tekrar</label>
                        <input type="password" class="form-control" id="password_confirm" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning">Kayıt Ol</button>
                    </div>
                     <p class="text-center mt-3">
                        Zaten bir hesabın var mı? <a href="login.php">Giriş Yap</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>