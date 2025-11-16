<?php
include("ayar.php");

if (isset($_GET['sil'])) {
    $sil_id = intval($_GET['sil']);
    if ($sil_id > 0) {
        $sil_sorgu = $baglan->query("DELETE FROM mesaj WHERE id = $sil_id");
        if ($sil_sorgu) {
            header("Location: iletisim.php");
            exit;
        } else {
            echo "Silme işlemi başarısız: " . $baglan->error;
        }
    } else {
        echo "Geçersiz silme ID'si";
    }
}

$sql = "SELECT * FROM mesaj ORDER BY id DESC";
$result = $baglan->query($sql);

if (!$result) {
    die("Sorgu hatası: " . $baglan->error);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8" />
<title>İletişim Mesajları Yönetim Paneli</title>
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
  }
  .nav-container nav {
    display: flex;
    gap: 30px;
  }
  .nav-container nav a {
    text-decoration: none;
    font-weight: 600;
    color: #495057;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
    border: 2px solid transparent;
    text-transform: uppercase;
  }
  .nav-container nav a:hover {
    background-color: #0d6efd;
    color: white;
    border-color: #0a58ca;
  }
  .nav-container nav a[href="cikis.php"] {
    background-color: #dc3545;
    color: white;
    border-color: #b02a37;
  }
  .nav-container nav a[href="cikis.php"]:hover {
    background-color: #a71d2a;
    border-color: #6f1218;
  }


  table {
    width: 1500px;
    margin: 0 auto 40px auto;
    border-collapse: collapse;
    border-spacing: 12px 12px;
    background: transparent;
    border-radius:10px;
  }
  thead tr {
    background-color: #0d6efd;
    color: white;
    text-align: center;
  
  }
  thead th {
    padding: 14px 30px;
    font-weight: 700;
   
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
    padding: 15px 30px;
    text-align: center;
    vertical-align: middle;
    border: none;
  }
  a.delete-link {
    color: #dc3545;
    font-weight: 700;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  a.delete-link:hover {
    text-decoration: underline;
    color: #a71d2a;
  }

  @media (max-width: 640px) {
    .nav-container {
      flex-direction: column;
      padding: 20px;
    }
    .nav-container nav {
      flex-direction: column;
      gap: 15px;
      align-items: center;
    }
    table {
      width: 100%;
    }
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

<h1 style="text-align:center; margin-bottom: 30px;">İletişim Mesajları</h1>

<?php if ($result->num_rows > 0): ?>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Ad Soyad</th>
      <th>Telefon</th>
      <th>E-posta</th>
      <th >Mesaj</th>
      <th>Tarih</th>
      <th>Sil</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['id']) ?></td>
      <td><?= htmlspecialchars($row['adsoyad']) ?></td>
      <td><?= htmlspecialchars($row['telefon']) ?></td>
      <td><?= htmlspecialchars($row['eposta']) ?></td>
      <td><?= nl2br(htmlspecialchars($row['ileti'])) ?></td>
      <td><?= htmlspecialchars($row['tarih']) ?></td>
      <td>
        <a class="delete-link" href="?sil=<?= $row['id'] ?>" onclick="return confirm('Mesajı silmek istediğine emin misin?')">Sil</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php else: ?>
<p style="text-align:center;">Henüz mesaj yok.</p>
<?php endif; ?>

</body>
</html>
