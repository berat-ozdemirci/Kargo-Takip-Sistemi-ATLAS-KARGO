
create database kargotaban;
use kargotaban;

create table musteriler (
musteri_id     int           not null   auto_increment,
musteri_ad     varchar(64)   not null,
musteri_soyad  varchar(64)   not null,
telefon        varchar(11)   not null   unique,
musteri_adres  varchar(255)  not null,
primary key(musteri_id)
);

create table subeler (
sube_id       int               not null    auto_increment,
sube_adi      varchar(64)       not null,
sube_adres    varchar(250)      not null,
primary key(sube_id)
);

create table personeller (
personel_id      int           not null     auto_increment,
sube_id          int           not null,
personel_ad      varchar(64)   not null,
personel_soyad   varchar(64)   not null,
primary key(personel_id),
foreign key(sube_id)  references subeler(sube_id)
          on delete cascade on update cascade
);

create table kargolar ( 
kargo_id        int           not null     auto_increment,
alici_id        int           not null,
gonderen_id     int           not null,
takip_no        char(12)      not null    unique,
kargo_agirlik   float         not null,
kargo_ucreti    float         not null,
kargo_durum     varchar(30)   not null check(kargo_durum in ('Hazırlanıyor', 'Yolda', 'Dağıtımda', 'Teslim Edildi')) default 'Hazırlanıyor',
tarih           datetime      not null,
sube_id         int           not null,
primary key(kargo_id),
foreign key(alici_id)  references musteriler(musteri_id)
     on delete cascade on update cascade,
foreign key(gonderen_id)  references musteriler(musteri_id)
     on delete cascade on update cascade,
foreign key(sube_id)  references subeler(sube_id)   
); 


DELIMITER $$
create procedure Musteri()
begin
   select
       musteri_id      as ID,
       musteri_ad      as Adı,
       musteri_soyad   as Soyadı,
       telefon         as Telefon,
       musteri_adres   as Adres
    from musteriler;
end $$
DELIMITER ;

DELIMITER $$
create procedure MusteriEkle(
   ad       varchar(64),
   soyad    varchar(64),
   tel      varchar(11),
   adres    varchar(255)
)
begin
   insert into musteriler
   values(null, ad, soyad, tel, adres);
end $$
DELIMITER ;

DELIMITER $$
create procedure MusteriGuncelle(
      id      int,
      ad      varchar(64),
      soyad   varchar(64),
      tel     varchar(11),
      adres   varchar(255)
)
begin
     update musteriler
     set
         musteri_ad = ad,
         musteri_soyad = soyad,
         telefon = tel,
         musteri_adres = adres
	 where
         musteri_id = id;
end $$
 DELIMITER ;
 
 DELIMITER $$
 create procedure MusteriSil(
      in  m_id    int
 )
begin
      delete from musteriler
      where musteri_id = m_id;
end $$
DELIMITER ;

DELIMITER $$
create procedure MusteriGonderenler(
      id    int
)
begin
     select * from kargolar
     where gonderen_id = id;
end $$
DELIMITER ; 

DELIMITER $$
create procedure MusteriAlıcılar(
      id     int
)
begin
      select * from kargolar
      where alici_id = id;
end $$
DELIMITER ;
 


DELIMITER $$
create procedure SubelerHepsi()
begin
   select
       sube_id      as  ID,
       sube_adi     as  Şube_Adı,
       sube_adres   as  Adres
   from subeler;
end $$
DELIMITER;

DELIMITER $$
create procedure SubeEkle (
       subeAd     varchar(64),
       adres      varchar(250)
)
begin
     insert into subeler
     values (null, subeAd, adres);
end $$
DELIMITER ;

DELIMITER $$
create procedure SubeGuncelle(
        id          int,
        subeAdi     varchar(64),
        adres       varchar(250)
)
begin
      update subeler
      set
         sube_adi = subeAdi,
         sube_adres = adres
      where
         sube_id = id;
end $$
DELIMITER ;

DELIMITER $$
create procedure SubeSil (
    s_id   int
)
begin
      delete from subeler
      where sube_id = s_id;
end $$
DELIMITER ;

DELIMITER $$
create procedure PersonellerHepsi()
begin
      select
          personel_id     as ID,
          sube_id         as Şube_ID,
          personel_ad     as Ad,
          personel_soyad  as Soyad
      from personeller;
end $$
DELIMITER ;

DELIMITER $$
create procedure PersonelEkle(
		 subeID    int,
         ad        varchar(64),
         soyad     varchar(64)
)
begin
      insert into personeller
      value(null, subeID, ad, soyad);
end $$
DELIMITER ;

DELIMITER $$
create procedure PersonelSil(
         p_id    int
)
begin
       delete from personeller
       where personel_id = p_id;
end $$
DELIMITER ;

DELIMITER $$
create procedure PersonelGuncelle (
		   id        int,
           subeID    int,
           ad        varchar(64),
           soyad     varchar(64)
)
begin
      update personeller
      set
          sube_id         = SubeID,
          personel_ad     = ad,
          personel_soyad  = soyad
      where
          personel_id = id;
end $$
DELIMITER ;


DELIMITER $$
create procedure KargolarHepsi ()
begin
    select
        kargo_id      as ID,
        alıcı_id      as A_ID,
        gonderen_id   as G_ID,
        takip_no      as Takip_No,
        kargo_ucreti  as K_Ucreti,
        tarih         as Tarih
    from kargolar;
end $$
DELIMITER ;



DELIMITER $$

create procedure KargoEkle(
     a_id           int,
     g_id           int,
     takip_no       char(12),
     krg_agirlik    float,
     ucret          float,
     tarih          datetime,
     subeID         int
)
begin
     insert into kargolar
     values (null, a_id, g_id, takip_no, krg_agirlik, ucret, 'Hazırlanıyor', tarih, subeID);
end $$
DELIMITER ;

DELIMITER $$
create procedure KargoSil (
      k_id     int
)
begin
       delete from kargolar
       where kargo_id = k_id;
end $$
DELIMITER ;  

DELIMITER $$
create procedure KargoGuncelle (
	   in id            int,
	   in krg_agirlik   float,
       in ucret         float,
       in drm           varchar(30)
)
begin
      update kargolar
      set
          kargo_agirlik  = krg_agirlik,
          kargo_ucreti   = ucret,
          kargo_durum    = drm
	  where
          kargo_id = id;
end $$
DELIMITER ;





-- Kargonun ağırlığına göre toplam kargo ücretini hesapla.
DELIMITER //
create function ucretHesapla(agirlik float)
returns float                     
deterministic
begin
      declare toplam_ucret float;
      declare gram_basi_ucret float;
      declare tabanFiyat float;
      
      set gram_basi_ucret = 0.25;
      set tabanFiyat = 50;
      
      SET toplam_ucret = tabanFiyat + (agirlik * gram_basi_ucret);
      return toplam_ucret;
end //
DELIMITER ;

-- ID' ye göre şubelerdeki toplam kargo sayısını hesapla.
DELIMITER //
create function toplamKargo(alınanSube_ID int)
returns int
deterministic
reads sql data
begin
      declare kargo_adeti int;
      
      select count(distinct kargo_id) into kargo_adeti
      from kargolar
      where sube_id = alınanSube_ID;
      
      return kargo_adeti;
end //
DELIMITER ;   

      

          
          
     
         
          










          
          
          