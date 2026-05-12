<?php
include "db.php";

$message = "";

if (isset($_POST['kaydet'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        $message = "Bu kullanıcı zaten var!";
    } else {

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($conn, $sql);

        header("Location: login.php");
        exit;
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5" style="max-width:400px;">

    <h3 class="text-center">📝 Kayıt Ol</h3>

    <?php if ($message != ""): ?>
        <div class="alert alert-warning"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="username" class="form-control mb-3" placeholder="Kullanıcı Adı">

        <input type="password" name="password" class="form-control mb-3" placeholder="Şifre">

        <button class="btn btn-success w-100" name="kaydet">Kayıt Ol</button>

    </form>

    <p class="text-center mt-3">
        Zaten hesabın var mı? <a href="login.php">Giriş Yap</a>
    </p>

</div>