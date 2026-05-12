<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$words = [

    "php",
    "mysql",
    "html",
    "css",
    "javascript",
    "python",
    "java",
    "linux",
    "kodlama",
    "algoritma",
    "internet",
    "veritabani",
    "yazilim",
    "bilgisayar",
    "guvenlik",
    "sunucu",
    "bootstrap",
    "programlama",
    "oyun",
    "teknoloji"

];
if (!isset($_SESSION['word'])) {
    $_SESSION['word'] = $words[array_rand($words)];
}

$message = "";

if (isset($_POST['guess'])) {

    $guess = strtolower($_POST['guess']);

    if ($guess == $_SESSION['word']) {

        $message = "🎉 Doğru!";

        mysqli_query($conn,
        "UPDATE users 
        SET kelime_skor = kelime_skor + 10 
        WHERE id=$user_id"
        );

        unset($_SESSION['word']);

    } else {
        $message = "❌ Yanlış!";
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Kelime Oyunu</title>

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
            🧠 Kelime Tahmin Oyunu
        </h2>

        <p class="text-center">
            Gizli kelimeyi tahmin et.
        </p>

        <?php if($message != ""): ?>

            <div class="alert alert-info mt-3">
                <?php echo $message; ?>
            </div>

        <?php endif; ?>

        <form method="POST" class="mt-3">

            <input 
                type="text"
                name="guess"
                class="form-control"
                placeholder="Kelime gir..."
                required
            >

            <button class="btn btn-success w-100 mt-3">
                Tahmin Et
            </button>

        </form>

        <form method="POST">

            <button 
                type="submit"
                name="reset"
                class="btn btn-warning w-100 mt-3"
            >
                🔄 Yeni Kelime
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