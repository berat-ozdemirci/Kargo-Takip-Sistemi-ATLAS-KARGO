
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
        .buton{
            display: inline-block;
            font-family: "Helvetica", sans-serif;
            padding: 30px 20px;
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
    <?php
    $id = isset($_GET["id"]) ? $_GET["id"] : '';
    if($id == 1) {
    ?>
    <ul style="display: flex; justify-content: center; gap: 15px; list-style-type: none; margin-top:20px;">
        <li><a href="Islemler.php" class="buton"><-- Geri Dön</a></li>
        <li><a href="Kargo_buton.php?id=1" class="buton">Kargo Ekle</a></li>
        <li><a href="Kargo_buton.php?id=2" class="buton">Kargo Sil</a></li>
        <li><a href="Kargo_buton.php?id=3" class="buton">Kargo Güncelle</a></li>
    </ul>
    <table style=" width:70%; border: 2px solid; color: black; margin-top:25px;margin: 20px auto; background-color: #297a2a6c; text-align: center;">
            <thead>
                <tr>
                   <th>Kargo ID</th>
                   <th>Alıcı ID</th>
                   <th>Gönderen ID</th>
                   <th>Takip No</th>
                   <th>Kargo Ağırlığı</th>
                   <th>Kargo Ücreti</th>
                   <th>Kargo Durumu</th>
                   <th>Tarih</th>
                </tr>
            </thead>
            <tbody style="background-color: #297a2a97;">
            <?php
            require_once 'baglanti.php';
            require_once 'erisim.php';
            $kargoerisim = new kargoErisim($db);
            
            $kargoListesi = $kargoerisim->kargoListele();
            foreach($kargoListesi as $k):
            ?>
             <tr>
                 <td><?= $k["kargo_id"] ?></td>
                 <td><?= $k["gonderen_id"] ?></td>
                 <td><?= $k["alici_id"] ?></td>
                 <td><?= htmlspecialchars($k["takip_no"]) ?></td>
                 <td><?= $k["kargo_agirlik"] ?> gr</td>
                 <td><?= $k["kargo_ucreti"] ?> TL</td>
                 <td><?= $k["kargo_durum"] ?></td>
                 <td><?= $k["tarih"] ?></td>
             </tr>
            <?php endforeach; ?> 
            </tbody>

    </table>
    <?php
    }
    if($id == 2) {
    ?>
    <ul style="display: flex; justify-content: center; gap: 4px; list-style-type: none; margin-top:20px;">
        <li><a href="Islemler.php" class="buton"><-- Geri Dön</a></li>
        <li><a href="Musteri_buton.php?id=1" class="buton">Müşteri Ekle</a></li>
        <li><a href="Musteri_buton.php?id=2" class="buton">Müşteri Sil</a></li>
        <li><a href="Musteri_buton.php?id=3" class="buton">Müşteri Güncelle</a></li>
    </ul>

    <table style=" width:70%; border: 2px solid; color: black; margin-top:25px;margin: 20px auto; background-color: #297a2a6c; text-align: center;">
            <thead>
                <tr>
                   <th>ID</th>
                   <th>Ad</th>
                   <th>Soyad</th>
                   <th>Telefon</th>
                   <th>Adres</th>
                </tr>
            </thead>
            <tbody style="background-color: #297a2a97;">
            <?php
            require_once 'baglanti.php';
            require_once 'erisim.php';
            $musterierisim = new musteriErisim($db);
            
            $musteriListesi = $musterierisim->musteriListele();
            foreach($musteriListesi as $k):
            ?>
             <tr>
                 <td><?= $k["musteri_id"]?></td>
                 <td><?= $k["musteri_ad"]?></td>
                 <td><?= $k["musteri_soyad"]?></td>
                 <td><?= $k["telefon"]?></td>
                 <td><?= $k["musteri_adres"]?></td>
             </tr>
            <?php endforeach; ?> 
            </tbody>

    </table>

    <?php    
    }
    if($id == 3) {
    ?>
    <ul style="display: flex; justify-content: center; gap: 15px; list-style-type: none; margin-top:20px;">
        <li><a href="Islemler.php" class="buton"><-- Geri Dön</a></li>
        <li><a href="Subeler_buton.php?id=1" class="buton">Şube Ekle</a></li>
        <li><a href="Subeler_buton.php?id=2" class="buton">Şube Sil</a></li>
        <li><a href="Subeler_buton.php?id=3" class="buton">Şube Güncelle</a></li>
    </ul>

    <table style=" width:70%; border: 2px solid; color: black; margin-top:25px;margin: 20px auto; background-color: #297a2a6c; text-align: center;">
            <thead>
                <tr>
                   <th>ID</th>
                   <th>Şube Adı</th>
                   <th>Adres</th>
                   <th> Şubedeki Kargo Sayısi</th>
                </tr>
            </thead>
            <tbody style="background-color: #297a2a97;">
            <?php
            require_once 'baglanti.php';
            require_once 'erisim.php';
            $suberisim = new subeErisim($db);
            
            $subeListesi = $suberisim->subeListele();
            foreach($subeListesi as $k):
            ?>
             <tr>
                 <td><?= $k["sube_id"] ?></td>
                 <td><?=$k["sube_adi"]?></td>
                 <td><?= $k["sube_adres"]?></td>
                 <td><?= $k["kargoSayisi"] ?></td>
             </tr>
            <?php endforeach; ?> 
            </tbody>
    </table>


    <?php   
    }
    if($id == 4) {
    ?>
    <ul style="display: flex; justify-content: center; gap: 15px; list-style-type: none; margin-top:20px;">
        <li><a href="Islemler.php" class="buton"><-- Geri Dön</a></li>
        <li><a href="Personeller_buton.php?id=1" class="buton">Personel Ekle</a></li>
        <li><a href="Personeller_buton.php?id=2" class="buton">Personel Sil</a></li>
        <li><a href="Personeller_buton.php?id=3" class="buton">Personel Güncelle</a></li>
    </ul>

    <table style=" width:70%; border: 2px solid; color: black; margin-top:25px;margin: 20px auto; background-color: #297a2a6c; text-align: center;">
            <thead>
                <tr>
                   <th>Personel ID</th>
                   <th>Çalıştığı Şube Adı</th>
                   <th>Personel Ad</th>
                   <th>Personel Soyad</th>
                   
                </tr>
            </thead>
            <tbody style="background-color: #297a2a97;">
            <?php
            require_once 'baglanti.php';
            require_once 'erisim.php';
            $personelerisim = new personelErisim($db);
            $personeller = $personelerisim->personelListele();
            
            foreach($personeller as $k):
            ?>
             <tr>
                 <td><?= $k["personel_id"]?></td>
                 <td><?= $k["sube_adi"]?></td>
                 <td><?= $k["personel_ad"]?></td>
                 <td><?= $k["personel_soyad"]?></td>
             </tr>
            <?php endforeach; ?> 
            </tbody>
    </table>





    <?php    
    }
    ?>

    
    
</body>
</html>