<?php 
require 'baglan.php';
require '../fonksiyonlar.php';

if (!isset($_POST['oturumacma'])) {
	oturumkontrol("../login.php");
}


if (isset($_POST['ayarkaydet'])) {
	$sorgu=$db->prepare("UPDATE ayarlar SET 
		site_baslik=:site_baslik,
		site_aciklama=:site_aciklama,
		site_link=:site_link,
		site_sahip_mail=:site_sahip_mail,
		site_mail_host=:site_mail_host,
		site_mail_mail=:site_mail_mail,
		site_mail_port=:site_mail_port,
		site_mail_sifre=:site_mail_sifre WHERE id=1
		");

	$sonuc=$sorgu->execute(array(
		'site_baslik' => $_POST['site_baslik'],
		'site_aciklama' => $_POST['site_aciklama'],
		'site_link' => $_POST['site_link'],
		'site_sahip_mail' => $_POST['site_sahip_mail'],
		'site_mail_host' => $_POST['site_mail_host'],
		'site_mail_mail' => $_POST['site_mail_mail'],
		'site_mail_port' => $_POST['site_mail_port'],
		'site_mail_sifre' => $_POST['site_mail_sifre']
	));

	if ($_FILES['site_logo']['error']=="0") {
		$gecici_isim=$_FILES['site_logo']['tmp_name'];
		$dosya_ismi=rand(100000,999999).$_FILES['site_logo']['name'];
		move_uploaded_file($gecici_isim,"../dosyalar/$dosya_ismi");

		$sorgu=$db->prepare("UPDATE ayarlar SET 
			site_logo=:site_logo WHERE id=1
			");

		$sonuc=$sorgu->execute(array(
			'site_logo' => $dosya_ismi,

		));
	}

	if ($sonuc) {
		header("location:../ayarlar.php?durum=ok");
	} else {
		header("location:../ayarlar.php?durum=no");
	}
	exit;
}


/********************************************************/

if (isset($_POST['oturumacma'])) {
	$sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:kul_mail AND kul_sifre=:kul_sifre");
	$sorgu->execute(array(
		'kul_mail' => $_POST['kul_mail'],
		'kul_sifre' => md5($_POST['kul_sifre'])
	));
	$sonuc=$sorgu->rowcount();
	$kullanici=$sorgu->fetch(PDO::FETCH_ASSOC);

	if ($sonuc==0) {
		header("location:../index.php?durum=no");
	} else {
		$_SESSION['kul_isim'] = $kullanici['kul_isim'];
		$_SESSION['kul_mail'] = $kullanici['kul_mail'];
		$_SESSION['kul_id'] = $kullanici['kul_id'];
		$_SESSION['kul_yetki'] = $kullanici['kul_yetki'];
		header("location:../index.php?durum=ok");
	}
	exit;
}


/********************************************************/

if (isset($_POST['profilkaydet'])) {
	$sorgu=$db->prepare("UPDATE kullanicilar SET 
		kul_isim=:kul_isim,
		kul_mail=:kul_mail,
		kul_telefon=:kul_telefon WHERE kul_id=:kul_id
		");

	$sonuc=$sorgu->execute(array(
		'kul_isim' => $_POST['kul_isim'],
		'kul_mail' => $_POST['kul_mail'],
		'kul_telefon' => $_POST['kul_telefon'],
		'kul_id' => $_SESSION['kul_id']
	));

	if (strlen($_POST['kul_sifre'])>0) {
		$sorgu=$db->prepare("UPDATE kullanicilar SET 
			kul_sifre=:kul_sifre WHERE kul_id=:kul_id
			");

		$sonuc=$sorgu->execute(array(
			'kul_sifre' => md5($_POST['kul_sifre']),
			'kul_id' => $_SESSION['kul_id']
		));
	}

	if ($sonuc) {
		header("location:../profil.php?durum=ok");
	} else {
		header("location:../profil.php?durum=no");
	}

}


/********************************************************/


if (isset($_POST['musteriekle'])) {
	$sorgu=$db->prepare("INSERT INTO musteri SET 
		musteri_isim=:musteri_isim,
		musteri_mail=:musteri_mail,
		musteri_telefon=:musteri_telefon,
		musteri_website=:musteri_website,
		musteri_ulke=:musteri_ulke,
		musteri_sehir=:musteri_sehir,
		musteri_adres=:musteri_adres,
		musteri_meslek=:musteri_meslek,
		musteri_detay=:musteri_detay
		");

	$sonuc=$sorgu->execute(array(
		'musteri_isim' => $_POST['musteri_isim'],
		'musteri_mail' => $_POST['musteri_mail'],
		'musteri_telefon' => $_POST['musteri_telefon'],
		'musteri_website' => $_POST['musteri_website'],
		'musteri_ulke' => $_POST['musteri_ulke'],
		'musteri_sehir' => $_POST['musteri_sehir'],
		'musteri_adres' => $_POST['musteri_adres'],
		'musteri_meslek' => $_POST['musteri_meslek'],
		'musteri_detay' => $_POST['musteri_detay']
	));


	if ($sonuc) {
		header("location:../musteriler.php?durum=ok");
	} else {
		header("location:../musteriler.php?durum=no");
	}

	exit;
}

/********************************************************/


if (isset($_POST['musteriduzenle'])) {
	$sorgu=$db->prepare("UPDATE musteri SET 
		musteri_isim=:musteri_isim,
		musteri_mail=:musteri_mail,
		musteri_telefon=:musteri_telefon,
		musteri_website=:musteri_website,
		musteri_ulke=:musteri_ulke,
		musteri_sehir=:musteri_sehir,
		musteri_adres=:musteri_adres,
		musteri_meslek=:musteri_meslek,
		musteri_detay=:musteri_detay WHERE musteri_id=:musteri_id
		");

	$sonuc=$sorgu->execute(array(
		'musteri_isim' => $_POST['musteri_isim'],
		'musteri_mail' => $_POST['musteri_mail'],
		'musteri_telefon' => $_POST['musteri_telefon'],
		'musteri_website' => $_POST['musteri_website'],
		'musteri_ulke' => $_POST['musteri_ulke'],
		'musteri_sehir' => $_POST['musteri_sehir'],
		'musteri_adres' => $_POST['musteri_adres'],
		'musteri_meslek' => $_POST['musteri_meslek'],
		'musteri_detay' => $_POST['musteri_detay'],
		'musteri_id' => $_POST['musteri_id']
	));


	if ($sonuc) {
		header("location:../musteriler.php?durum=ok");
	} else {
		header("location:../musteriler.php?durum=no");
	}

	exit;
}

/********************************************************/

if (isset($_POST['musterisilme'])) {
	$sorgu=$db->prepare("DELETE FROM musteri WHERE musteri_id=:musteri_id");
	$sonuc=$sorgu->execute(array(
		'musteri_id' => $_POST['musteri_id']
	));

	if ($sonuc) {
		header("location:../musteriler.php?durum=ok");
	} else {
		header("location:../musteriler.php?durum=no");
	}

	exit;
}


/********************************************************/


if (isset($_POST['musteriyukle'])) {	
	echo "<pre>";
	$gecici_isim=$_FILES['musteri_excel']['tmp_name'];
	$dosya_ismi=$_FILES['musteri_excel']["name"];
	$isim=rand(100000,999999).time()."musteritablosu.xlsx";
	$sonuc=move_uploaded_file($gecici_isim,"../gecici/$isim");
	if ($sonuc) {
		require_once 'excel.php';
		if ($xlsx=SimpleXLSX::parse("../gecici/$isim")) {
			$header_values=$rows=[];
			foreach ($xlsx->rows() as $k => $v) {
				if ($k===0) {
					$header_values=$v;
				}
				$rows[]=array_combine($header_values,$v);
			}

			unset($rows[0]);

			foreach ($rows as $key => $bilgiler) {

				$sorgu=$db->prepare("INSERT INTO musteri SET 
					musteri_isim=:musteri_isim,
					musteri_mail=:musteri_mail,
					musteri_telefon=:musteri_telefon,
					musteri_website=:musteri_website,
					musteri_ulke=:musteri_ulke,
					musteri_sehir=:musteri_sehir,
					musteri_adres=:musteri_adres,
					musteri_meslek=:musteri_meslek
					");

				$sonuc=$sorgu->execute(array(
					'musteri_isim' => $bilgiler['musteri_isim'],
					'musteri_mail' => $bilgiler['musteri_mail'],
					'musteri_telefon' => $bilgiler['musteri_telefon'],
					'musteri_website' => $bilgiler['musteri_website'],
					'musteri_ulke' => $bilgiler['musteri_ulke'],
					'musteri_sehir' => $bilgiler['musteri_sehir'],
					'musteri_adres' => $bilgiler['musteri_adres'],
					'musteri_meslek' => $bilgiler['musteri_meslek']
				));

				if (!$sonuc) {
					$bilgiler['musteri_isim']." isimli Müşteri Eklenemedi";
				}
				
			}
			unlink("../gecici/$isim");
			header("location:../musteriler.php?durum=ok");
		}
	}
	
}

/********************************************************/


if (isset($_POST['telefon-aktar'])) {
	require_once 'excel-export.php';

	$sorgu=$db->prepare("SELECT musteri_telefon FROM musteri");
	$sorgu->execute();
	$liste=$sorgu->fetchAll(PDO::FETCH_ASSOC);

	$xls = new Excel_XML('UTF-8');
	$xls->addArray($liste);
	$xls->generateXML('Telefonlar');
	exit;

}


/********************************************************/

if (isset($_POST['mail-aktar'])) {
	require_once 'excel-export.php';

	$sorgu=$db->prepare("SELECT musteri_mail FROM musteri");
	$sorgu->execute();
	$liste=$sorgu->fetchAll(PDO::FETCH_ASSOC);

	$xls = new Excel_XML('UTF-8');
	$xls->addArray($liste);
	$xls->generateXML('Mailler');
	exit;

}


/********************************************************/

if (isset($_POST['isim-mail-telefon-aktar'])) {
	require_once 'excel-export.php';

	$sorgu=$db->prepare("SELECT musteri_mail,musteri_telefon,musteri_isim FROM musteri");
	$sorgu->execute();
	$liste=$sorgu->fetchAll(PDO::FETCH_ASSOC);

	$xls = new Excel_XML('UTF-8');
	$xls->addArray($liste);
	$xls->generateXML('ISIM-MAIL-TELEFON');
	exit;

}



/********************************************************/


if (isset($_POST['kulekle'])) {
	$sorgu=$db->prepare("INSERT INTO kullanicilar SET 
		kul_isim=:kul_isim,
		kul_mail=:kul_mail,
		kul_telefon=:kul_telefon,
		kul_sifre=:kul_sifre
		");

	$sonuc=$sorgu->execute(array(
		'kul_isim' => $_POST['kul_isim'],
		'kul_mail' => $_POST['kul_mail'],
		'kul_telefon' => $_POST['kul_telefon'],
		'kul_sifre' => md5($_POST['kul_sifre'])
	));

	if ($sonuc) {
		header("location:../kullanicilar.php?durum=ok");
	} else {
		header("location:../kullanicilar.php?durum=no");
	}

	exit;

}


/********************************************************/


if (isset($_POST['kulduzenle'])) {
	$sorgu=$db->prepare("UPDATE kullanicilar SET 
		kul_isim=:kul_isim,
		kul_mail=:kul_mail,
		kul_telefon=:kul_telefon WHERE kul_id=:kul_id
		");

	$sonuc=$sorgu->execute(array(
		'kul_isim' => $_POST['kul_isim'],
		'kul_mail' => $_POST['kul_mail'],
		'kul_telefon' => $_POST['kul_telefon'],
		'kul_id' => $_POST['kul_id']
	));

	if (strlen($_POST['kul_sifre']!=0)) {
		$sorgu=$db->prepare("UPDATE kullanicilar SET 
			kul_sifre=:kul_sifre WHERE 
			kul_id=:kul_id
			");
		$sonuc=$sorgu->execute(array(
			'kul_sifre' => md5($_POST['kul_sifre']),
			'kul_id' => $_POST['kul_id']
		));
	}

	if ($sonuc) {
		header("location:../kullanicilar.php?durum=ok");
	} else {
		header("location:../kullanicilar.php?durum=no");
	}

	exit;

}


/********************************************************/


if (isset($_POST["kulsilme"])) {
	$sorgu=$db->prepare("DELETE FROM kullanicilar WHERE kul_id={$_POST['kul_id']}");
	$sonuc=$sorgu->execute();

	if ($sonuc) {
		header("location:../kullanicilar.php?durum=ok");
	} else {
		header("location:../kullanicilar.php?durum=no");
	}

	exit;
}



/********************************************************/

if (isset($_POST['mesajekle'])) {
	$sorgu=$db->prepare("INSERT INTO mesajlar SET 
		mesaj_gonderen=:mesaj_gonderen,
		mesaj_detay=:mesaj_detay
		");

	$sonuc=$sorgu->execute(array(
		'mesaj_gonderen' => $_SESSION['kul_id'],
		'mesaj_detay' => $_POST['mesaj_detay']
	));

	if ($sonuc) {
		echo json_encode(array('sonuc' => "ok"));
	} else {
		echo json_encode(array('sonuc' => "no"));
	}
	exit;
}










?>
