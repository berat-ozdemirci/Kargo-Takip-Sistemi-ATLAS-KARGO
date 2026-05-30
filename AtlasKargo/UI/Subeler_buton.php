<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style>
        * {
            margin: 0;
            padding 0;
        }
        .baslik{
            padding:8px;
            height: 250px;
            width: 99%;
            display: flex;
            align-items: center;
            background-image: url('resimler/yesil.png');
            background-size: cover;   
        }
        .ekran {
            background-color: #155721ac;
            margin: 0 auto;
            margin-top: 90px;
            border-radius: 5px;
            padding: 30px;
            text-align: center;" 
        }
        .buton{
            display: inline-block;
            font-family: "Helvetica", sans-serif;
            padding: 20px 20px;
            font-weight:bold;
            background-color: #2c4a7cdb;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            border: 3px solid #808282b9;
            font-family: "Google Sans", sans-serif;  
             
        }
        .buton:hover{
            background-color: #571515ac;
            transform: translateY(-1.1px);
        }
        
    </style>
</head>
<body style="background-image: url('resimler/kareli.png'); color: #ffffff;">
    <div class="baslik">
        <h1>ATLAS KARGO</h1>
    </div>
    <div style="background-color: #155721bb; width:100%; height: 20px; margin-top:10px"></div>
    <ul style="display: flex; justify-content: center; gap: 15px; list-style-type: none; margin-top:20px;">
        <li><a href="Islemler.php" class="buton"><-- Geri Dön</a></li>
        <li><a href="Subeler_buton.php?id=1" class="buton">Şube Ekle</a></li>
        <li><a href="Subeler_buton.php?id=2" class="buton">Şube Sil</a></li>
        <li><a href="Subeler_buton.php?id=3" class="buton">Şube Güncelle</a></li>
    </ul>
    <?php
    $id = isset($_GET["id"]) ? $_GET["id"] : '';
    if($id == 1) {
    ?>
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h2 style="color: #ffffffdb">Şube Ekle</h2>
        <form action="islem.php" method="POST">
            <div><input type="text" name="sube_ad" placeholder= "Şube Adı" required style="width: 70%; height: 40px; margin-top:10px; border-radius:5px;"></div>
            <div><textarea type="text" name="sube_adres" placeholder= "Adres" required style="width: 75%; height: 80px; margin-top:10px; border-radius:5px;"></textarea></div>
            <button type="submit" name="sube_ekle">Ekle</button>
        </form>
        <a href="Secenekler.php?id=3" style="margin-top:10px;" ><button>Listeye Dön</button></a>
    </div> 
    <?php    
    }
    if($id == 2) {
    ?>
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h2 style="margin-bottom:7px;">Şube Sil</h2>
        <p style="color: #821818; font-weight:bold; font-size:17px;">Silinecek şube için ID giriniz.</p>

        <form action="islem.php" method="POST">
            <div><input type="text" name="silinen_sube_id" placeholder= "ID"required style="width: 70%; height: 40px; margin-top:10px; border-radius:5px;"></div>
            <button type="submit" name="sube_sil">Şubeyi Sil</button>
        </form>
        <a href="Secenekler.php?id=3" style="margin-top:10px;" ><button>Listeye Dön</button></a>
    </div>
    <?php
    }
    if($id == 3) {
    ?>
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h2  style="margin-bottom:7px;">Şube Güncelle</h2>
        <p style="color: #ffffff; font-weight:bold; font-size:17px;">Güncellenecek şube için ID giriniz.</p>

        <form action="islem.php" method="POST">
            <div><input type="number" name="guncellenecek_id" placeholder="ID"  style="width: 70%; height: 40px; margin-top:10px; border-radius:5px;"></div>
            <div><input type="text" name="yeni_ad" placeholder="Yeni Ad"  style="width: 70%; height: 40px; margin-top:10px; border-radius:5px;"></div>
            <div><input type="text" name="yeni_adres" placeholder="Yeni Adres"  style="width: 75%; height: 80px; margin-top:10px; border-radius:5px;"></div>
            <button type="submit" name="sube_guncelle" style="margin-top:10px;">Güncelle</button>
        </form>
        <a href="Secenekler.php?id=3" style="margin-top:10px;" ><button>Listeye Dön</button></a>
    </div>
    <?php    
    }
    ?>
</body>
</html>