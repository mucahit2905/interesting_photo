<?php
session_start();
include("ayar.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kullanici = $baglan->real_escape_string($_POST["kullanici"]);
    $sifre = $baglan->real_escape_string($_POST["sifre"]);

    $sorgu = $baglan->prepare("SELECT * FROM kullanici WHERE kullanici=? AND sifre=?");
    $sorgu->bind_param("ss", $kullanici, $sifre);
    $sorgu->execute();
    $sonuc = $sorgu->get_result();

    if ($sonuc->num_rows > 0) {
        setcookie("kullanici", $kullanici, time() + 3600, "/");
        $_SESSION["giris"] = sha1(md5("var"));
        echo "<script>window.location.href='anasayfa.php';</script>";
    } else {
        echo "<script>alert('HATALI KULLANICI BİLGİSİ!'); window.location.href='index.php';</script>";
    }
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Giriş</title>
    <style>
       
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }

    
        form {
            width: 450px;
            background: white;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        form b {
            font-weight: 700;
            font-size: 22px;
        }

        form input[type="text"],
        form input[type="password"] {
            padding: 18px 22px;
            font-size: 20px;
            border: 1.8px solid #ced4da;
            border-radius: 12px;
            transition: border-color 0.3s ease;
        }
        form input[type="text"]:focus,
        form input[type="password"]:focus {
            border-color: #0d6efd;
            outline: none;
        }

        form input[type="submit"] {
            background-color: #0d6efd;
            border: none;
            color: white;
            font-weight: 700;
            font-size: 24px;
            padding: 18px 0;
            border-radius: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #084298;
        }
    </style>
</head>
<body>

  <form action="" method="post" autocomplete="off">
      <b>Kullanıcı Adı :</b>
      <input type="text" name="kullanici" required>
      
      <b>Parola :</b>
      <input type="password" name="sifre" required>
      
      <input type="submit" value="Giriş Yap">
  </form>

</body>
</html>
