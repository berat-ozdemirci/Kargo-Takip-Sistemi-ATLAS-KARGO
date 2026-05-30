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
    </style>
</head>
<body style="background-image: url('resimler/kareli.png'); color: #ffffff;">
    <div class="baslik">
        <h1>ATLAS KARGO</h1>
    </div>
    <div style="background-color: #155721bb; width:100%; height: 20px; margin-top:10px"></div>

    <ul style="display: flex; justify-content: center; gap: 15px; list-style-type: none; margin-top:20px;">
        <li><a href="Anasayfa.php" class="buton"><-- Geri Dön</a></li>
        <li><a href="Secenekler.php?id=1" class="buton">Kargo İşlemleri</a></li>
        <li><a href="Secenekler.php?id=2" class="buton">Müşteri İşlemleri</a></li>
        <li><a href="Secenekler.php?id=3" class="buton">Şube İşlemleri</a></li>
        <li><a href="Secenekler.php?id=4" class="buton">Personel İşlemleri</a></li>

        
    </ul>
    
</body>
</html>