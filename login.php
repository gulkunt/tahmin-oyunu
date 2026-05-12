<?php
include "db.php";
session_start();

$error = "";

if (isset($_POST['giris'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");
            exit;

        } else {
            $error = "Şifre yanlış!";
        }

    } else {
        $error = "Kullanıcı bulunamadı!";
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5" style="max-width:400px;">

    <h3 class="text-center">🎮 Giriş Yap</h3>

    <?php if ($error != ""): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="username" class="form-control mb-3" placeholder="Kullanıcı Adı">

        <input type="password" name="password" class="form-control mb-3" placeholder="Şifre">

        <button class="btn btn-primary w-100" name="giris">Giriş Yap</button>

    </form>

    <p class="text-center mt-3">
        Hesabın yok mu? <a href="register.php">Kayıt Ol</a>
    </p>

</div>