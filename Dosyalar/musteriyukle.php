<?php require 'header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-body">
					<form action="islemler/ajax.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
						<div class="form-row">
							<div class="col-md-8 form-group">
								<label>Excel Dosyası</label>
								<input type="file" name="musteri_excel" class="form-control">
							</div>
							
						</div>
						<div>
							<button type="submit" class="btn btn-primary" name="musteriyukle">Yükle</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php'; ?>