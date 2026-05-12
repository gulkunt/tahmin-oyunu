<?php
session_start();
include "db.php";

$sql = "SELECT username, sayi_skor, kelime_skor 
        FROM users 
        ORDER BY (sayi_skor + kelime_skor) DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .leader-card{
            max-width:800px;
            margin:auto;
            margin-top:60px;
            border:none;
            border-radius:20px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

    </style>
</head>
<body>

<div class="container">

    <div class="card leader-card p-4">

        <h1 class="text-center mb-4">
            🏆 Leaderboard
        </h1>

        <table class="table table-bordered table-hover text-center">

            <tr class="table-dark">
                <th>Kullanıcı</th>
                <th>Sayı Oyunu</th>
                <th>Kelime Oyunu</th>
                <th>Toplam</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?php echo $row['username']; ?>
                </td>

                <td>
                    <?php echo $row['sayi_skor']; ?>
                </td>

                <td>
                    <?php echo $row['kelime_skor']; ?>
                </td>

                <td>
                    <?php echo $row['sayi_skor'] + $row['kelime_skor']; ?>
                </td>

            </tr>

            <?php } ?>

        </table>

        <a href="index.php"
           class="btn btn-dark">
           🏠 Ana Sayfa
        </a>

    </div>

</div>

</body>
</html>