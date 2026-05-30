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
            padding: 40px 20px;
            font-weight:bold;
            background-color: #2c4a7cdb;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            border: 3px solid #808282b9;
            font-family: "Google Sans", sans-serif;  
             
        }
        .buton:hover{
            background-color: #155721ac;
            transform: translateY(-1.1px);
        }
        .ekran {
            background-color: #155721ac;
            margin: 0 auto;
            margin-top: 90px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
            padding: 10px;
        }
    </style>
</head>
<body style="background-image: url('resimler/kareli.png'); color: #ffffff;">

    <div class="baslik">
        <h1>ATLAS KARGO</h1>
    </div>
    <div style="background-color: #155721bb; width:100%; height: 20px; margin-top:10px"></div>

    <?php

    require_once 'baglanti.php';
    require_once 'erisim.php';
    $kargoerisim = new kargoErisim($db);

    $kargo_Bilgisi = null;
    $sorguu = false;

    if(isset($_POST['sorgula'])) {
        $takip_no = trim($_POST['takip_no']);
        if(!empty($takip_no)) {
            $kargo_Bilgisi = $kargoerisim->kargoTakip($takip_no);
            $sorguu = true;
        }
    }

    
    ?>
    
    <div class="ekran" style="width: 400px; margin: 50px auto;">
        <h2 style="color: #ffffffdb">Kargo Takip</h2>
        <p style="margin-top:10px;">12 haneli takip numarasını giriniz:</p>

        <form action="" method="POST">
            <div>
                <input type="text" name="takip_no" placeholder="Takip Numarası" maxLength="12" required value="<?= isset($_POST['takip_no']) ? htmlspecialchars($_POST['takip_no']) : '' ?>" style="width: 80%; height: 40px; border-radius: 5px; border: none; padding-left: 10px; font-size: 16px; text-align: center;">
            </div>
            <button type="submit" name="sorgula" style="margin-left:53px; margin-top:15px;">Sorgula</button>
        </form>
        <a href="Anasayfa.php" style ="margin-right:39px;"><button>Geri Dön </button>  </a>
    </div>    
        <?php if ($sorguu): ?>
            <div class="ekran" style="padding:30px; margin-top:20px; width: 55%; ">
                <?php if ($kargo_Bilgisi): ?>
                    <h3>Kargo Bilgileri:</h3>
                    <div style="background-color= #155721ac; padding:20px; color: black;">
                        <p><strong>Gönderen Müşteri:</strong> <?= htmlspecialchars($kargo_Bilgisi['alici_isim']) ?></p>
                        <p><strong>Alıcı Müşteri:</strong> <?= htmlspecialchars($kargo_Bilgisi['gonderen_isim']) ?></p>
                        
                        <br>
                        <p><strong>Kargo Ağırlığı:</strong> <?= $kargo_Bilgisi['kargo_agirlik'] ?> gr</p>
                        <p><strong>Kargo Ücreti:</strong> <?= $kargo_Bilgisi['kargo_ucreti'] ?> TL</p>
                        <br>
                        <p><strong>Gönderim Tarihi:</strong> <?= $kargo_Bilgisi['kargo_tarihi'] ?></p>

                        <div>
                            <p style="margin: 0; font-size: 16px;">
                               <strong>Kargo Durumu:</strong> 
                               
                                 <?= htmlspecialchars($kargo_Bilgisi['kargo_durum']) ?>
                            </p>
                        </div>
                    </div>
                    <?php else: ?>
                        <p>Geçersiz Takip Numarasi</p>
                        
                <?php endif; ?>    
            </div>
        <?php endif; ?>     


    
 


    
    
</body>
</html>