<?php
include("yonetim/ayar.php")
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>İNTERESTİNG</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon"type="image/svg" href="img/favicon.svg">
  </head>
  <body>
    <div class="GENEL">
      <nav>
        <div>
          <h2>İNTERESTİNG<br />FOTOĞRAFÇLIK</h2>
          <a href="#Anasayfa"> <h3>ANA SAYFA</h3> </a>
          <a href="#Hakkımızda"> <h3>HAKKIMIZDA</h3> </a>
          <a href="#Hizmetlerimiz"> <h3>HİZMETLERİMİZ</h3> </a>
          <a href="#Galeri"> <h3>GALERİ</h3> </a>
          <a href="#İletişim"> <h3>İLETİŞİM</h3> </a>
        </div>
      </nav>

      <section>
        <h1 id="Anasayfa">Anasayfa</h1>
        <div class="Anasayfa-resimler">
          <div>
            <img src="img/anitkabir.jpg" alt="" />
          </div>

          <div>
            <img src="img/istanbul.jpg" alt="" />
          </div>

          <div>
            <img src="img/kerpe-1.jpg" alt="" />
          </div>

          <div>
            <img src="img/pamukkale-travertenleri.webp" alt="" />
          </div>
        </div>
      </section>
    </div>
   
    <div class="hakkımızda">
       <h1 id="Hakkımızda">Hakkımızda</h1>
      <div>
       <?php
      $sorgu = $baglan->query("select * from hakkımızda");
      $satir = $sorgu->fetch_object( );
      echo $satir->icerik;
       ?>
      </div>
    </div>
     
     <div class="section2">
       <h1 id="Hizmetlerimiz">Hizmetlerimiz</h1>
       <div class="Hizmetlerimiz">
      <div id="düğün">
        <img src="img/düğün.jpg" alt="" />
        <h2>Düğün Fotoğrafçılığı</h2>
      </div>

      <div id="Bebek">
        <img src="img/bebek fotoğraf.png" alt="">
        <h2>Bebek Fotoğrafçılığı</h2>
      </div>

       <div id="discekim">
         <img src="img/dış çekim.jpg" alt="">
         <h2>Dış Çekim Fotoğrafçılığı</h2>
        </div>
     
      </div>
     </div>
  <div class="section4">
    <h1 id="Galeri">Galeri</h1>
    <div class="galeri">
        <?php
        $sorgu = $baglan->query("SELECT * FROM anasayfa");
        while ($satir = $sorgu->fetch_object()) {
            $resim = $satir->resim; 
            echo "<a href='$resim' title='$satir->baslık'>
                    <img src='$resim' alt='$satir->baslık'>
                  </a>";

        }
        ?>
    </div>
</div>

      <
      
    </div>
   </div>
<?php

if (isset($_POST['gonder'])) {
    $adsoyad = $baglan->real_escape_string($_POST['adsoyad']);
    $telefon = $baglan->real_escape_string($_POST['telefon']);
    $eposta = $baglan->real_escape_string($_POST['eposta']);
    $ileti = $baglan->real_escape_string($_POST['ileti']);

    $sql = "INSERT INTO mesaj (adsoyad, telefon, eposta, ileti) VALUES ('$adsoyad', '$telefon', '$eposta', '$ileti')";

    if ($baglan->query($sql) === TRUE) {
        echo " <script> alert(style='color:green;'>Mesajınız başarıyla gönderildi. Teşekkürler!)</script>";
    } else {
        echo "<p style='color:red;'>Hata oluştu: " . $baglan->error . "</p>";
    }
}
?>

<div class="section3">
  <h1 id="İletişim">İletişim</h1>
  <div class="iletişim">
    <form action="" method="post" class="iletisim-form">
      <label>
        Ad Soyad<br>
        <input type="text" name="adsoyad" placeholder="Adınızı ve soyadınızı Giriniz" required>
      </label>
      <br><br>
      <label>
        Telefon<br>
        <input type="tel" name="telefon" placeholder="Telefon numaranızı giriniz" required>
      </label>
      <br><br>
      <label>
        E-posta<br>
        <input type="email" name="eposta" placeholder="E-posta adresinizi Giriniz" required>
      </label>
      <br><br>
      <label>
        Mesaj<br>
        <textarea name="ileti" placeholder="Mesajınızı giriniz" required></textarea>
      </label>
      <br><br>
      <button type="submit" name="gonder">Gönder</button>
    </form>
  </div>
</div>

    

  </body>
</html>
