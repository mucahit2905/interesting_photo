<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Ana Sayfa</title>
    <style>
        /* Reset */
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: #f5f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            width: 1000px;
            height:500px;
            text-align: center;
        }
        h1 {
            margin-bottom: 30px;
            color: #444;
            font-weight: 700;
        }
        nav {
            display: flex;
            flex-direction:column;
            justify-content: space-between;
            gap: 15px; 
        }
        nav a {
            flex: 1;
            padding: 12px 0;
            text-decoration: none;
            color: #555;
            border-radius: 6px;
            border: 2px solid transparent;
            font-weight: 600;
            transition: all 0.3s ease;
            background-color: #e9ecef;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            text-align: center;
            user-select: none;
        }
        nav a:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #0056b3;
            box-shadow: 0 4px 12px rgba(0,123,255,0.4);
        }
        nav a.logout {
            background-color: #dc3545;
            color: #fff;
            border-color: #b02a37;
            box-shadow: 0 2px 6px rgba(220,53,69,0.5);
        }
        nav a.logout:hover {
            background-color: #a71d2a;
            border-color: #7a141d;
            box-shadow: 0 4px 12px rgba(167,29,42,0.7);
        }
        @media (max-width: 500px) {
            .container {
                width: 90%;
                padding: 20px;
            }
            nav {
                flex-direction: column;
                gap: 10px;
            }
            nav a {
                flex: none;
                width: 100%;
                padding: 12px 0;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Yönetim Paneli</h1>
        <nav>
            <a href="anasayfa.php">Ana Sayfa</a>
            <a href="resimler.php">Resimler</a>
            <a href="iletisim.php">İletişim</a>
            <a href="hakkimizda.php">Hakkımızda</a>
            <a href="cikis.php" class="logout" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?');">Çıkış</a>
        </nav>
    </div>
</body>
</html>
