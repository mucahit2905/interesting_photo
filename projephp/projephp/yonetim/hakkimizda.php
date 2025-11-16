<?php
session_start();
include("ayar.php");

if (!isset($_SESSION["giris"]) || $_SESSION["giris"] != sha1(md5("var")) || !isset($_COOKIE["kullanici"])) {
    header("Location: cikis.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $icerik = $baglan->real_escape_string($_POST["icerik"]);
    $baglan->query("DELETE FROM hakkımızda");
    $sorgu = $baglan->query("INSERT INTO hakkımızda (icerik) VALUES ('$icerik')");

    if ($sorgu) {
        echo "<script>window.location.href='hakkimizda.php';</script>";
    } else {
        echo "<script>alert('HATA: KAYIT YAPILAMADI!'); window.location.href='hakkimizda.php';</script>";
    }
}

$sorgu = $baglan->query("SELECT * FROM hakkımızda");
$satir = $sorgu->fetch_object();
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Hakkımızda</title>
    <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 20px;
      }

      /* Menü kutusu */
      .nav-container {
        text-align: center;
        margin-bottom: 20px;
      }

      nav {
        display: flex;
        justify-content: center;
        gap: 15px;
        background: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      }

      nav a {
        text-decoration: none;
        color: #555;
        padding: 8px 16px;
        border-radius: 5px;
        font-weight: 600;
        border: 1.5px solid transparent;
        transition: all 0.3s ease;
      }

      nav a:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #0056b3;
      }

      /* Çıkış linki kırmızı */
      nav a[href="cikis.php"] {
        background-color: #dc3545;
        color: #fff;
        border-color: #b02a37;
      }

      nav a[href="cikis.php"]:hover {
        background-color: #a71d2a;
        border-color: #7a141d;
      }

      /* Form ve içerik */
      form {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 3px 12px rgba(0,0,0,0.1);
      }

      textarea {
        width: 100% !important;
        height: 200px !important;
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        resize: vertical;
        box-sizing: border-box;
      }

      input[type="submit"] {
        margin-top: 15px;
        background-color: #007bff;
        border: none;
        color: white;
        padding: 10px 22px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      input[type="submit"]:hover {
        background-color: #0056b3;
      }
    </style>
</head>
<body>
  <div class="nav-container">
    <nav>
      <a href="anasayfa.php">ANA SAYFA</a>
      <a href="resimler.php">RESİMLER</a>
      <a href="hakkimizda.php">HAKKIMIZDA</a>
      <a href="iletisim.php">İLETİŞİM</a>
      <a href="cikis.php" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?');">ÇIKIŞ</a>
    </nav>
  </div>

  <form action="" method="post">
    <b>İçerik:</b><br><br>
    <textarea name="icerik"><?php echo htmlspecialchars($satir->icerik ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>
    <input type="submit" value="Kaydet">
  </form>
</body>
</html>
