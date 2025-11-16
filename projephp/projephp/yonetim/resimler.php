<?php
session_start();
include("ayar.php");

if (!isset($_SESSION["giris"]) || $_SESSION["giris"] != sha1(md5("var")) || !isset($_COOKIE["kullanici"])) {
    header("Location: cikis.php");
    exit;
}

if (isset($_GET["islem"]) && $_GET["islem"] == "sil") {
    $id = (int)$_GET["id"];
    $baglan->query("DELETE FROM anasayfa WHERE id='$id'");
    echo "<script>window.location.href='resimler.php';</script>";
    exit;
}

if (isset($_GET["islem"]) && $_GET["islem"] == "ekle") {
    $baslık = $_POST["baslık"];
    $resim = "img/" . $_FILES["resim"]["name"];
    move_uploaded_file($_FILES["resim"]["tmp_name"], $resim);
    $baglan->query("INSERT INTO anasayfa (baslık, resim) VALUES ('$baslık', '$resim')");
    echo "<script>window.location.href='resimler.php';</script>";
    exit;
}
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Resimler</title>
    <style>
     
      * {
        box-sizing: border-box;
      }
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 30px 15px;
        color: #212529;
      }

    
      .nav-container {
        max-width: 900px;
        margin: 0 auto 30px auto;
        background: #fff;
        padding: 15px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        justify-content: center;
        gap: 30px;
      }
      .nav-container a {
        text-decoration: none;
        font-weight: 600;
        color: #495057;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease, color 0.3s ease;
        border: 2px solid transparent;
      }
      .nav-container a:hover {
        background-color: #0d6efd;
        color: white;
        border-color: #0a58ca;
      }
      .nav-container a[href="cikis.php"] {
        background-color: #dc3545;
        color: white;
        border-color: #b02a37;
      }
      .nav-container a[href="cikis.php"]:hover {
        background-color: #a71d2a;
        border-color: #6f1218;
      }

      table {
        max-width: 900px;
        margin: 0 auto 40px auto;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        background: transparent;
        
      }
      thead tr {
        background-color: #0d6efd;
        color: white;
        text-align: center;
        border-radius: 12px;
      }
      thead th {
        padding: 14px 20px;
        font-weight: 700;
        border-radius: 10px;
      }
      tbody tr {
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        transition: background-color 0.25s ease;
        border-radius: 10px;
      }
      tbody tr:hover {
        background-color: #e7f1ff;
      }
      tbody td {
        padding: 15px 20px;
        text-align: center;
        vertical-align: middle;
        border: none;
      }
      td img {
        max-height: 60px;
        border-radius: 8px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.1);
      }
      a.sil-link {
        color: #dc3545;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.3s ease;
      }
      a.sil-link:hover {
        text-decoration: underline;
        color: #a71d2a;
      }

    
      form {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 30px 35px;
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
      form label {
        font-weight: 700;
        color: #212529;
      }
      form input[type="text"],
      form input[type="file"] {
        padding: 14px 18px;
        font-size: 16px;
        border: 1.5px solid #ced4da;
        border-radius: 10px;
        transition: border-color 0.3s ease;
      }
      form input[type="text"]:focus,
      form input[type="file"]:focus {
        border-color: #0d6efd;
        outline: none;
      }
      form input[type="submit"] {
        background-color: #0d6efd;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 18px;
        padding: 15px 0;
        border-radius: 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      form input[type="submit"]:hover {
        background-color: #084298;
      }

      
      @media (max-width: 640px) {
        .nav-container {
          flex-direction: column;
          gap: 15px;
          padding: 20px;
        }
        table, form {
          width: 100%;
        }
      }
    </style>
</head>
<body>
  <nav class="nav-container">
    <a href="anasayfa.php">ANA SAYFA</a>
    <a href="resimler.php">RESİMLER</a>
    <a href="hakkimizda.php">HAKKIMIZDA</a>
    <a href="iletisim.php">İLETİŞİM</a>
    <a href="cikis.php" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?');">ÇIKIŞ</a>
  </nav>

  <table>
    <thead>
      <tr>
        <th>S. No</th>
        <th>Resim</th>
        <th>Sil</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sirano = 0;
    $sorgu = $baglan->query("SELECT * FROM anasayfa");
    while ($satir = $sorgu->fetch_object()) {
        $sirano++;
        echo "<tr>
            <td>$sirano</td>
            <td>" . htmlspecialchars($satir->baslık, ENT_QUOTES, 'UTF-8') . "</td>
            <td><img src='" . htmlspecialchars($satir->resim, ENT_QUOTES, 'UTF-8') . "' alt='Resim'></td>
            <td><a href='resimler.php?islem=sil&id=$satir->id' class='sil-link' onclick=\"return confirm('Bu kaydı silmek istediğinize emin misiniz?');\">Sil</a></td>
        </tr>";
    }
    ?>
    </tbody>
  </table>

  <form action="resimler.php?islem=ekle" enctype="multipart/form-data" method="post">
    <label for="resim">Resim :</label>
    <input type="file" id="resim" name="resim" required accept="image/*">

    <input type="submit" value="Kaydet">
  </form>
</body>
</html>
