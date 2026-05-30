<?php

session_start();
require_once 'baglanti.php';
require_once 'erisim.php';

$musterierisim = new musteriErisim($db);
$kargoerisim = new kargoErisim($db);
$subeerisim = new subeErisim($db);
$personelerisim = new personelErisim($db);

if(isset($_POST['musteri_ekle'])) {
    $ad = trim($_POST['musteri_ad']);
    $soyad = trim($_POST['musteri_soyad']);
    $telefon = trim($_POST['telefon']);
    $adrs = trim($_POST['musteri_adres']);

    

    try {
        
        $islem = $musterierisim->musteriEkle($ad, $soyad, $telefon, $adrs);
        if($islem) {
            echo "KAYIT BAŞARILI";
            header("Refresh:2; url=Secenekler.php?id=2");
            
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
      }
}

elseif(isset($_POST['musteri_sil'])) {
    $sil_id = $_POST['silinen_id'];

    try {
        $islem = $musterierisim->musteriSil($sil_id);
        if($islem > 0) {
            echo "MÜŞTERİ SİLİNDİ";
            header("Refresh:2; url=Secenekler.php?id=2");
        } else {
            echo "BU ID İÇİN MÜŞTERİ BULUNAMADI";
            header("Refresh:2; url=Secenekler.php?id=2");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}

elseif(isset($_POST['musteri_guncelle'])) {
    $guncelle_id = $_POST['g_id'];
    $guncelAd = trim($_POST['yeni_ad']);
    $guncelSoyad = trim($_POST['yeni_soyad']);
    $guncelTel = trim($_POST['yeni_telefon']);
    $guncelAdrs = trim($_POST['yeni_adres']);

    try {
        $islem = $musterierisim->musteriGuncelle($guncelle_id, $guncelAd, $guncelSoyad, $guncelTel, $guncelAdrs);
        if($islem) {
            echo "MÜŞTERİ BİLGİLERİ GÜNCELLENDİ";
            header("Refresh:2; url=Secenekler.php?id=2");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}



elseif(isset($_POST['kargo_gonder'])) {
    $gonderen_id = trim($_POST['gonderen_id']);
    $alici_id = trim($_POST['alici_id']);
    $agirlik = trim($_POST['k_agirlik']);
    $trh = date("Y-m-d H:i:s");
    $subeID = trim($_POST['sube_id']);

    try {
        $ucret = $kargoerisim->ucretHesapla($agirlik);
        $takip_no = (string)rand(10000000, 99999999);
        $islem = $kargoerisim->kargoEkle($gonderen_id, $alici_id, $takip_no, $agirlik, $ucret, $trh, $subeID);

        if($islem) {
            echo "KARGO SİSTEME EKLENDI";
            header("Refresh:2; url=Secenekler.php?id=1");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}
elseif(isset($_POST['kargo_sil'])) {
    $sil_id = $_POST['silinen_kargo_id'];

    try {
        $islem = $kargoerisim->kargoSil($sil_id);
        if($islem > 0) {
            echo "KARGO SİLİNDİ";
            header("Refresh:2; url=Secenekler.php?id=1");
        } else {
            echo "BU ID İÇİN KARGO BULUNAMADI";
            header("Refresh:2; url=Secenekler.php?id=1");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}
elseif(isset($_POST['kargo_guncelle'])) {
    $kargo_id = $_POST['guncelleID'];
    $agirlik  = trim($_POST['yeni_agirlik']);
    $guncel_durum = $_POST['yeni_durum'];

    try {
        $yeni_ucret = $kargoerisim->ucretHesapla($agirlik);
        $islem = $kargoerisim->kargoGuncelle($kargo_id, $agirlik, $yeni_ucret, $guncel_durum);

        if($islem) {
            echo "KARGO BİLGİSİ GÜNCELLENDİ";
            header("Refresh:2; url=Secenekler.php?id=1");
        }

    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }

}




elseif(isset($_POST['sube_ekle'])) {
    $sube_ad = trim($_POST['sube_ad']);
    $sube_adres = trim($_POST['sube_adres']);

    try {
        $islem = $subeerisim->subeEkle($sube_ad, $sube_adres);
        if($islem) {
            echo "ŞUBE VERİ TABANINA EKLENDİ";
            header("Refresh:2; url=Secenekler.php?id=3"); 
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }  
}
elseif(isset($_POST['sube_sil'])) {
    $sube_id = $_POST['silinen_sube_id'];

    try {
        $silinen = $subeerisim->subeSil($sube_id);
        if($silinen > 0) {
            echo "ŞUBE BAŞARIYLA SİLİNDİ";
            header("Refresh:2; url=Secenekler.php?id=3");
        } else {
            echo "BU ID İÇİN BİR ŞUBE BULUNAMADI!";
            header("Refresh:2; url=Secenekler.php?id=3");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}
elseif(isset($_POST['sube_guncelle'])) {
    $sube_id    = $_POST['guncellenecek_id'];
    $yeni_ad    = trim($_POST['yeni_ad']);
    $yeni_adres = trim($_POST['yeni_adres']);

    try {
        $islem = $subeerisim->subeGuncelle($sube_id, $yeni_ad, $yeni_adres);
        if($islem) {
            echo "ŞUBE BİLGİLERİ GÜNCELLENDİ";
            header("Refresh:2; url=Secenekler.php?id=3");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}
elseif(isset($_POST['personel_ekle'])) {
    $sube_id        = $_POST['p_sube_id'];
    $personelAd    = trim($_POST['personel_ad']);
    $personelSoyad = trim($_POST['personel_soyad']);

    try {
        $islem = $personelerisim->personelEkle($sube_id, $personelAd, $personelSoyad);
        if($islem) {
            echo "PERSONEL SİSTEME EKLENDİ";
            header("Refresh:2; url=Secenekler.php?id=4"); 
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}
elseif(isset($_POST['personel_sil'])) {
    $silinecek_id = $_POST['silinen_personelID'];

    try {
        $silinen = $personelerisim->personelSil($silinecek_id);
        if($silinen > 0) {
            echo "PERSONEL SİSTEMDEN SİLİNDİ";
            header("Refresh:2; url=Secenekler.php?id=4");
        } else {
            echo "BU ID İÇİN PERSONEL BULUNAMADI";
            header("Refresh:2; url=Secenekler.php?id=4");
        }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}

elseif(isset($_POST['personel_guncelle'])) {
    $personel_id    = $_POST['g_personel_id'];
    $yeni_sube_id   = $_POST['p_sube_id'];
    $yeni_ad        = trim($_POST['yeni_p_ad']);
    $yeni_soyad     = trim($_POST['yeni_p_soyad']);

    try {
        $islem = $personelerisim->personelGuncelle($personel_id, $yeni_sube_id, $yeni_ad, $yeni_soyad);
        if($islem > 0) {
            echo "PERSONEL BİLGİLERİ GÜNCELLENDİ";
            header("Refresh:2; url=Secenekler.php?id=4");
            exit;
        } else {
            echo "BU ID İÇİN PERSONEL BULUNAMADI";
            header("Refresh:2; url=Secenekler.php?id=4");
            exit;
          }
    } catch(PDOException $e) {
        die("HATA: " . $e->getMessage());
    }
}




?>