<?php

$conn = mysqli_connect("localhost", "root", "", "tahmin_oyunu");

if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}

?>