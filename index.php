<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<html >
<head>
    <meta charset="UTF-8">
    <title>Oyun Platformu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .card{
            border:none;
            border-radius:20px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .game-btn{
            width:100%;
            margin-top:10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="card p-4">

        <h1 class="text-center mb-4">🎮 Oyun Platformu</h1>

        <h4>Hoş geldin, 
            <span class="text-primary">
                <?php echo $_SESSION['username']; ?>
            </span>
        </h4>

        <hr>

        <h3>🏆 Skorların</h3>

        <table class="table table-bordered text-center mt-3">

            <tr class="table-dark">
                <th>Sayı Tahmin</th>
                <th>Kelime Oyunu</th>
            </tr>

            <tr>
                <td><?php echo $user['sayi_skor'] ?? 0; ?></td>
                <td><?php echo $user['kelime_skor'] ?? 0; ?></td>
            </tr>

        </table>

        <hr>

        <h3>🎮 Oyunlar</h3>

        <a href="game.php" class="btn btn-primary game-btn">
            🎯 Sayı Tahmin Oyunu
        </a>

        <a href="wordgame.php" class="btn btn-success game-btn">
            🧠 Kelime Tahmin Oyunu
        </a>
		<a href="leaderboard.php" class="btn btn-warning game-btn">
    🏆 Leaderboard
</a>

        <a href="logout.php" class="btn btn-danger game-btn">
            🚪 Çıkış Yap
        </a>

    </div>

</div>

</body>
</html>