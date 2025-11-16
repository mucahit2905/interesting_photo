<?php
$baglan = new mysqli("localhost", "zahid", "0612ars", "phpproje");
$baglan->set_charset("utf8");
if ($baglan->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglan->connect_error);
}
?>

