<?php
class musteriErisim {
    private $baglanti;

    public function __construct($database_connection) {
        $this->baglanti = $database_connection;
    }
    
    public function musteriEkle($ad, $soyad, $tel, $adres) {
        $sorgu = $this->baglanti->prepare("CALL MusteriEkle(?, ?, ?, ?)");
        return $sorgu->execute([$ad, $soyad, $tel, $adres]);
    }

    public function musteriSil($id) {
        $sorgu = $this->baglanti->prepare("CALL kargotaban.MusteriSil(?)");
        $sorgu->execute([$id]);
        return $sorgu->rowCount();
    }
    public function musteriGuncelle($id, $ad, $soyad, $telefon, $adres) {
         $sorgu = $this->baglanti->prepare("CALL MusteriGuncelle(?, ?, ?, ?, ?)");
         return $sorgu->execute([$id, $ad, $soyad, $telefon, $adres]);
    }
    public function musteriListele() {
        $sorgu = $this->baglanti->prepare("SELECT * FROM musteriler ORDER BY musteri_id ASC");
        $sorgu->execute();
        return $sorgu->fetchAll(PDO::FETCH_ASSOC);
    }
}

class kargoErisim {
    private $baglanti;
    public function __construct($database_connection) {
        $this->baglanti = $database_connection;
    }
    public function ucretHesapla($agirlik) {
        
        $sorgu = $this->baglanti->prepare("SELECT ucretHesapla(?) AS ucret");
        $sorgu->execute([$agirlik]);
        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
        return $sonuc['ucret'];
    }

    public function kargoEkle($gndrn_id, $alc_id, $takip_no, $agirlik, $ucret, $tarih, $sube_id) {
          $sorgu = $this->baglanti->prepare("CALL KargoEkle(?, ?, ?, ?, ?, ?, ?)");
          return $sorgu->execute([$gndrn_id, $alc_id, $takip_no, $agirlik, $ucret, $tarih, $sube_id]);
    }

    public function kargoSil($id) {
        $sorgu = $this->baglanti->prepare("CALL kargotaban.KargoSil(?)");
        $sorgu->execute([$id]);
        return $sorgu->rowCount();
    }

    public function kargoGuncelle($kargo_id, $agirlik, $ucret, $durum) {
        $sorgu = $this->baglanti->prepare("CALL KargoGuncelle(?, ?, ?, ?)");
        return $sorgu->execute([$kargo_id, $agirlik, $ucret, $durum]);
    }
    
    public function kargoListele() {
    
        $sorgu = $this->baglanti->prepare("SELECT * FROM kargolar ORDER BY kargo_id DESC");
        $sorgu->execute();
        return $sorgu->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function kargoTakip($takip_no) {
        $sql = "SELECT 
                  k.kargo_id,
                  k.takip_no,
                  k.kargo_agirlik,
                  k.kargo_ucreti,
                  k.kargo_durum,
                  k.tarih AS kargo_tarihi,
                  CONCAT(m1.musteri_ad, ' ', m1.musteri_soyad) AS gonderen_isim,
                  CONCAT(m2.musteri_ad, ' ', m2.musteri_soyad) AS alici_isim
            FROM  kargolar k
            INNER JOIN musteriler m1 ON k.gonderen_id = m1.musteri_id
            INNER JOIN musteriler m2 ON k.alici_id = m2.musteri_id
            WHERE k.takip_no = ?";

        $sorgu = $this->baglanti->prepare($sql);
        $sorgu->execute([$takip_no]);
        return $sorgu->fetch(PDO::FETCH_ASSOC);    

    }   
}

class subeErisim {
    private $baglanti;

    public function __construct($database_connection) {
        $this->baglanti = $database_connection;
    }

    public function subeListele() {


        $sql = "SELECT
                  sube_id,
                  sube_adi,
                  sube_adres,
                  toplamKargo(sube_id) AS kargoSayisi
                FROM subeler
                ORDER BY sube_id ASC";
                
        $sorgu = $this->baglanti->prepare($sql);
        $sorgu->execute();
        return $sorgu->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function subeEkle($ad, $adres) {
        $sorgu = $this->baglanti->prepare("CALL SubeEkle(?, ?)");
        return $sorgu->execute([$ad, $adres]);
    }
    public function subeSil($id) {
        $sorgu = $this->baglanti->prepare("CALL SubeSil(?)");
        $sorgu->execute([$id]);
        return $sorgu->rowCount();
    }
    public function subeGuncelle($id, $ad, $adres) {
        $sorgu = $this->baglanti->prepare("CALL SubeGuncelle(?, ?, ?)");
        return $sorgu->execute([$id, $ad, $adres]);
    }

}


class personelErisim {
    private $baglanti;

    public function __construct($database_connection) {
        $this->baglanti = $database_connection;
    }

    public function personelListele() {
        $sql = "SELECT
                   p.personel_id,
                   p.personel_ad,
                   p.personel_soyad,
                   s.sube_adi
                FROM personeller p
                INNER JOIN subeler s ON p.sube_id = s.sube_id
                ORDER BY s.sube_adi DESC";


        $sorgu = $this->baglanti->prepare($sql);
        $sorgu->execute();
        return $sorgu->fetchAll(PDO::FETCH_ASSOC);
    }
    public function personelEkle($sube_id, $ad, $soyad) {
        $sorgu = $this->baglanti->prepare("CALL PersonelEkle(?, ?, ?)");
        return $sorgu->execute([$sube_id, $ad, $soyad]);
    }
    public function personelSil($id) {
        $sorgu = $this->baglanti->prepare("CALL PersonelSil(?)");
        $sorgu->execute([$id]);
        return $sorgu->rowCount();
    }

    public function personelGuncelle($id, $sube_id, $ad, $soyad) {
        $sorgu = $this->baglanti->prepare("CALL PersonelGuncelle(?, ?, ?, ?)");
        return $sorgu->execute([$id, $sube_id, $ad, $soyad]);
        return $sorgu->rowCount();
    }

}

?>