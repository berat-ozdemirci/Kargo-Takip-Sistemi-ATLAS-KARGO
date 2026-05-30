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
        <li><a href="Kargo_buton.php?id=1" class="buton">Kargo Ekle</a></li>
        <li><a href="Kargo_buton.php?id=2" class="buton">Kargo Sil</a></li>
        <li><a href="Kargo_buton.php?id=3" class="buton">Kargo Güncelle</a></li>
    </ul>
    
    <?php
    $id = isset($_GET["id"]) ? $_GET["id"] : '';
    if($id == 1) {
    ?>
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h3>Kargo Gönderim</h3>
        <form action="islem.php" method="POST">
            <div>
                <select name="alici_id" required style="width: 72%; height: 40px; margin-top: 5px;">
                    <option value="">Alıcı Seçin</option>
                    <?php
                    require_once 'baglanti.php';
                    require_once 'erisim.php';
                    $musterierisim = new musteriErisim($db);
                    $musteriListesi = $musterierisim->musteriListele();
                    foreach($musteriListesi as $m):
                    ?>
                    <option value="<?= $m['musteri_id'] ?>">
                        <?= $m['musteri_id'] ?> - <?= htmlspecialchars($m['musteri_ad']) ?> <?= htmlspecialchars($m['musteri_soyad']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

        
            <div>
                <select name="gonderen_id" required style="width:72%; height:40px; margin-top:10px;">
                    <option value="">Gönderen Seçiniz</option>
                    <?php
                    require_once 'baglanti.php';
                    require_once 'erisim.php';
                    $musterierisim = new musteriErisim($db);
                    $musteriListesi = $musterierisim->musteriListele();
                    foreach($musteriListesi as $m):
                    ?>
                    <option value="<?= $m['musteri_id'] ?>">
                        <?= $m['musteri_id'] ?> - <?= htmlspecialchars($m['musteri_ad']) ?> <?= htmlspecialchars($m['musteri_soyad']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            
            <div><input type="number" name="k_agirlik" placeholder="Kargo Ağırlığı (Gr. Cinsinden)" style="width: 70%; height: 40px; margin-top:5px; border-radius:5px;"></div>
            <div>
                <select name="sube_id" required style="width: 72%; height: 40px; margin-top: 10px;">
                    <option value="">Şube Seciniz</option>
                    <?php
                    require_once 'baglanti.php';
                    require_once 'erisim.php';
                    $subeerisim = new subeErisim($db);
                    $subeListesi = $subeerisim->subeListele();
                    foreach($subeListesi as $sube):
                    ?>
                      <option value="<?= $sube['sube_id'] ?>">
                        <?= htmlspecialchars($sube['sube_id']) ?> *** <?= htmlspecialchars($sube['sube_adi']) ?>
                      </option>
                    <?php endforeach; ?>      
                </select>
            </div>
            <button type="submit" name="kargo_gonder">Gönder</button>
        </form>
        <a href="Secenekler.php?id=1" style="margin-top:10px;" ><button>Listeye Dön</button></a>
       </div>
    <?php 
    }

    if($id == 2) {
    ?>
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h2 style="margin-bottom:7px;">Kargo Sil</h2>
        <p style="color: #821818; font-weight:bold; font-size:17px;">Silinek kargo için ID giriniz.</p>

       <form action="islem.php" method="POST">
             <input type="number" name="silinen_kargo_id" placeholder="Silinecek Kargo ID" required>
             <button type="submit" name="kargo_sil">Kargoyu Sil</button>
       </form>
        <a href="Secenekler.php?id=1" style="margin-top:10px;" ><button>Listeye Dön</button></a>
    </div>
    <?php
    }

    if($id == 3) {
    ?>
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h2  style="margin-bottom:7px;">Kargo Güncelle</h2>
        <p style="color: #ffffff; font-weight:bold; font-size:17px;">Güncellenecek kargo için ID giriniz.</p>

        <form action="islem.php" method="POST">
            <div><input type="number" name="guncelleID" placeholder="ID" required style="width: 70%; height: 40px; margin-top:10px; border-radius:5px;"></div>
            <div><input type="text" name="yeni_agirlik" placeholder="Yeni Ağırlık" required style="width: 70%; height: 40px; margin-top:10px; border-radius:5px;"></div>
            <select name="yeni_durum" style="width: 72%; height: 40px; margin-top:10px; border-radius:7px;">
                <option value="Hazırlanıyor">Hazırlanıyor</option>
                <option value="Yolda">Yolda</option>
                <option value="Dağıtımda">Dağıtımda</option>
        <option value="Teslim Edildi">Teslim Edildi</option>
            </select>
            <br>
            <button type="submit" name="kargo_guncelle" style="margin-top:10px;">Güncelle</button>
        </form>
        <a href="Secenekler.php?id=1" style="margin-top:10px;" ><button>Listeye Dön</button></a>
    </div>
    <?php
    }
    ?>
    
    
</body>
</html>