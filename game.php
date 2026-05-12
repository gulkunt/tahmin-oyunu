<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Oyun başlat
if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = rand(1, 100);
}

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 100;
}

$message = "";

if (isset($_POST['guess'])) {

    $guess = $_POST['guess'];
    $number = $_SESSION['number'];

    // Doğru tahmin
    if ($guess == $number) {

        $message = "🎉 Tebrikler! Doğru tahmin.";

        $score = $_SESSION['score'];

        mysqli_query($conn,
        "UPDATE users 
        SET sayi_skor = sayi_skor + $score
        WHERE id=$user_id"
        );

        // Yeni oyun
        $_SESSION['number'] = rand(1,100);
        $_SESSION['score'] = 100;

    } else {

        $_SESSION['score'] -= 10;

        if ($guess < $number) {
            $message = "📈 Daha büyük sayı dene!";
        } else {
            $message = "📉 Daha küçük sayı dene!";
        }

        // Kaybetme
        if ($_SESSION['score'] <= 0) {

            $message = "😢 Kaybettin! Yeni oyun başladı.";

            $_SESSION['number'] = rand(1,100);
            $_SESSION['score'] = 100;
        }
    }
}

// Oyun sıfırla
if (isset($_POST['reset'])) {

    $_SESSION['number'] = rand(1,100);
    $_SESSION['score'] = 100;

    $message = "🔄 Oyun sıfırlandı!";
}
?>


<html >
<head>
    <meta charset="UTF-8">
    <title>Sayı Tahmin Oyunu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .game-card{
            max-width:500px;
            margin:auto;
            margin-top:70px;
            border:none;
            border-radius:20px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

    </style>
</head>
<body>

<div class="container">

    <div class="card game-card p-4">

        <h2 class="text-center mb-4">
            🎯 Sayı Tahmin Oyunu
        </h2>

        <p class="text-center">
            1 ile 100 arasında sayı tahmin et.
        </p>

        <h4 class="text-center text-primary">
            Skor: <?php echo $_SESSION['score']; ?>
        </h4>

        <?php if($message != ""): ?>

            <div class="alert alert-info mt-3">
                <?php echo $message; ?>
            </div>

        <?php endif; ?>

        <form method="POST" class="mt-3">

            <input 
                type="number" 
                name="guess"
                class="form-control"
                placeholder="Tahmin gir..."
                required
            >

            <button class="btn btn-primary w-100 mt-3">
                Tahmin Et
            </button>

        </form>

        <form method="POST">

            <button 
                type="submit"
                name="reset"
                class="btn btn-warning w-100 mt-3"
            >
                🔄 Oyunu Sıfırla
            </button>

        </form>

        <a href="index.php"
           class="btn btn-dark w-100 mt-3">
           🏠 Ana Sayfa
        </a>

    </div>

</div>

</body>
</html>