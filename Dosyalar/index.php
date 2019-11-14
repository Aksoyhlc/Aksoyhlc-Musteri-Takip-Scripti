<?php 
include'header.php' 
?>

<link rel="stylesheet" type="text/css" href="vendor/datatables/dataTables.bootstrap4.min.css">
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Giriş -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Müşteriler</h6>
    </div>
    <div class="card-body">

      <div class="justify-content-start d-flex text-left">
       <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dışa Aktar
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">
            <button type="button" class="btn btn-dark icon-split btn-sm" onclick="tiklama('kopyala');">
             <span class="icon text-white-60">
              <i class="far fa-clipboard"></i>
            </span> 
            <span class="text">Kopyala</span>
          </button>
        </a>
        <a class="dropdown-item" href="#">
          <button type="button" class="btn btn-success icon-split btn-sm" onclick="tiklama('excel');">
           <span class="icon text-white-60">
            <i class="far fa-file-excel"></i>
          </span> 
          <span class="text">Excel</span>
        </button>
      </a>
      <a class="dropdown-item" href="#">
        <button type="button" class="btn btn-danger icon-split btn-sm" onclick="tiklama('pdf');">
         <span class="icon text-white-60">
          <i class="far fa-file-pdf"></i>
        </span> 
        <span class="text">PDF</span>
      </button>
    </a>
    <a class="dropdown-item" href="#">
      <button type="button" class="btn btn-info icon-split btn-sm" onclick="tiklama('csv');">
       <span class="icon text-white-60">
        <i class="fas fa-file-csv"></i>
      </span> 
      <span class="text">CSV</span>
    </button>
  </a>
</div>
</div>

<a href="musteriyukle.php" class="ml-2 mb-2"><button type="button" class="btn btn-danger btn-sm">Müşteri Yükle</button></a>

<form action="islemler/ajax.php" method="POST" accept-charset="utf-8">
  <button type="submit" class="btn btn-info btn-sm ml-2" name="telefon-aktar">Telefonları Aktar</button>
</form>

<form action="islemler/ajax.php" method="POST" accept-charset="utf-8">
  <button type="submit" class="btn btn-success btn-sm ml-2" name="mail-aktar">Mailleri Aktar</button>
</form>

<form action="islemler/ajax.php" method="POST" accept-charset="utf-8">
  <button type="submit" class="btn btn-warning btn-sm ml-2" name="isim-mail-telefon-aktar">İsim-Mail-Telefon Aktar</button>
</form>


</div>



<div class="table-responsive mt-3">
  <table class="table table-bordered" id="musteritablosu">
    <thead>
      <tr>
        <th>No</th>
        <th>Müşteri İsim</th>
        <th>Müşteri Mail</th>
        <th>Müşteri Telefon</th>
        <th>Müşteri Şehir</th>
        <th>Müşteri Meslek</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sayi=0;
      $sorgu=$db->prepare("SELECT * FROM musteri");
      $sorgu->execute();
      while ($musteribilgisi=$sorgu->fetch(PDO::FETCH_ASSOC)) { 
        $sayi++;
        ?>
        <tr>
          <td><?php echo $musteribilgisi['musteri_id'];; ?></td>
          <td><?php echo $musteribilgisi['musteri_isim']; ?></td>
          <td><?php echo $musteribilgisi['musteri_mail']; ?></td>
          <td><?php echo $musteribilgisi['musteri_telefon']; ?></td>
          <td><?php echo $musteribilgisi['musteri_sehir']; ?></td>
          <td><?php echo $musteribilgisi['musteri_meslek']; ?></td>
          <td>
            <div class="row justify-content-center">
              <form action="musteriduzenle.php" method="POST" accept-charset="utf-8">
                <input type="hidden" name="musteri_id" value="<?php echo $musteribilgisi['musteri_id']?>">
                <button type="submit" name="duzenleme" class="btn btn-success btn-sm btn-icon-split">
                  <span class="icon text-white-60">
                    <i class="fas fa-edit"></i>
                  </span>
                </button>
              </form>
              <form class="mx-1" action="islemler/ajax.php" method="POST" accept-charset="utf-8">
                <input type="hidden" name="musteri_id" value="<?php echo $musteribilgisi['musteri_id']?>">
                <button type="submit" name="musterisilme" class="btn btn-danger btn-sm btn-icon-split">
                  <span class="icon text-white-60">
                    <i class="fas fa-trash"></i>
                  </span>
                </button>
              </form>
              <form action="musteri.php" method="POST" accept-charset="utf-8">
                <input type="hidden" name="musteri_id" value="<?php echo $musteribilgisi['musteri_id']?>">
                <button type="submit" name="duzenleme" class="btn btn-primary btn-sm btn-icon-split">
                  <span class="icon text-white-60">
                    <i class="fas fa-eye"></i>
                  </span>
                </button>
              </form>
            </div>
          </td>
        </tr>
      <?php } ?>            
    </tbody>
    <tfoot>
      <tr>
        <th>No</th>
        <th>Müşteri İsim</th>
        <th>Müşteri Mail</th>
        <th>Müşteri Telefon</th>
        <th>Müşteri Şehir</th>
        <th>Müşteri Meslek</th>
      </tr>
    </tfoot>
  </table>
</div>
</div>
</div>
<!--Datatables çıkış-->
</div>


<?php include'footer.php' ?>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>

<script>
  $("#musteritablosu").DataTable({
   initComplete: function () {
    this.api().columns().every( function () {
      var column = this;
      var select = $('<select><option value=""></option></select>')
      .appendTo( $(column.footer()).empty() )
      .on( 'change', function () {
        var val = $.fn.dataTable.util.escapeRegex(
          $(this).val()
          );

        column
        .search( val ? '^'+val+'$' : '', true, false )
        .draw();
      } );

      column.data().unique().sort().each( function ( d, j ) {
        select.append( '<option value="'+d+'">'+d+'</option>' )
      } );
    } );
  },
  dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
  buttons: [
  {
    extend: 'copyHtml5', 
    className: 'kopyalama-buton'
  },
  {
    extend: 'excelHtml5', 
    className: 'excel-buton'
  },
  {
   extend: 'pdfHtml5',
   className: 'pdf-buton'
 },
 {
  extend: 'csvHtml5',
  className: 'csv-buton'
}
]
});


  function tiklama(islem){
    switch (islem){
      case "excel":
      $(".excel-buton").trigger("click");
      break;
      case "kopyala":
      $(".kopyalama-buton").trigger("click");
      break;
      case "pdf":
      $(".pdf-buton").trigger("click");
      break;
      case "csv":
      $(".csv-buton").trigger("click");
      break;
    }
  }


</script>



<?php 
if (@$_GET['durum']=="ok") { ?>
  <script type="text/javascript">
   Swal.fire({
    type: 'success',
     title: 'İşlem Başarılı',
     text: 'İşleminiz Başarıyla Gerçekleştirildi',
     confirmButtonText: "Tamam"
   })
 </script>
 <?php } ?>


 <?php 
if (@$_GET['durum']=="no") { ?>
  <script type="text/javascript">
   Swal.fire({
    type: 'error',
     title: 'Hata',
     text: 'İşleminiz Başarısız Oldu Lütfen Tekrar Deneyin',
     confirmButtonText: "Tamam"
   })
 </script>
 <?php } ?>