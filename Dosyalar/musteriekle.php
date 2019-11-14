<?php 
require 'header.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="font-weight-bold text-primary">Müşteri Ekleme</h5>
				</div>
				<div class="card-body">
					<form action="islemler/ajax.php" method="POST" accept-charset="utf-8">
						<div class="form-row">
							<div class="col-md-6 form-group">
								<label>İsim Soyisim</label>
								<input type="text" name="musteri_isim" placeholder="Müşterinizin İsmini Girin" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Mail Adresi</label>
								<input type="mail" name="musteri_mail" placeholder="Müşterinizin Mail Adresini Girin" class="form-control">
							</div>
						</div>


						<div class="form-row">
							<div class="col-md-6 form-group">
								<label>Telefon Numarası</label>
								<input type="text" name="musteri_telefon" placeholder="Müşterinizin Telefonunu Girin" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Websitesi</label>
								<input type="text" name="musteri_website" placeholder="Müşterinizin Websitesini Girin" class="form-control">
							</div>
						</div>



						<div class="form-row">
							<div class="col-md-6 form-group">
								<label>Ülke</label>
								<input type="text" name="musteri_ulke" placeholder="Müşterinizin Yaşadığı Ülkeyi Girin" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Şehir</label>
								<input type="text" name="musteri_sehir" placeholder="Müşterinizin Yaşadığı Şehri Girin" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="col-md-6 form-group">
								<label>Adres</label>
								<input type="text" name="musteri_adres" placeholder="Müşterinizin Adresini Girin" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Meslek</label>
								<input type="text" name="musteri_meslek" placeholder="Müşterinizin Mesleğini Girin" class="form-control">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 form-group">
							<textarea name="musteri_detay" class="form-control" id="editor"></textarea>
						</div>
						</div>

						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-lg" name="musteriekle">Kaydet</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php require 'footer.php'; ?>
<script src="vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace("editor");
</script>