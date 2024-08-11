<html>
<head>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="../libs/bootstrap.min.css" title="style" />

</head>
<body>

      <div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Tambah Pasien</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['simpan']))
{
	mysql_query("INSERT INTO t_member (nama, email, hp) VALUES ('".$_POST['nama']."','".$_POST['email']."','".$_POST['hp']."')");
	writeMsg('save.sukses');
}
?>

	<div class="form-group">
  		<label class="control-label" for="nama">No_Reg (wajib diisi)</label>
  		<input type="text" class="form-control" name="nama" id="nama" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Nama (wajib diisi)</label>
  		<input type="email" class="form-control" name="email" id="email" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="hp">Jenis Kelamin (wajib diisi)</label>
  		<input type="text" class="form-control" name="hp" id="hp">
	</div>
    
    <div class="form-group">
  		<label class="control-label" for="nama">Umur (wajib diisi)</label>
  		<input type="text" class="form-control" name="nama" id="nama" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Tanggal Lahir (wajib diisi)</label>
  		<input type="email" class="form-control" name="email" id="email" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="hp">Tempat Lahir (wajib diisi)</label>
  		<input type="text" class="form-control" name="hp" id="hp">
	</div>
    
    <div class="form-group">
  		<label class="control-label" for="nama">Nama Kepala Keluarga (wajib diisi)</label>
  		<input type="text" class="form-control" name="nama" id="nama" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Alamat </label>
  		<input type="email" class="form-control" name="email" id="email" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="hp">Jenis Pasien (wajib diisi)</label>
  		<input type="text" class="form-control" name="hp" id="hp">
	</div>
    
    <div class="form-group">
  		<label class="control-label" for="nama">Agama </label>
  		<input type="text" class="form-control" name="agama" id="agama" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Dokter Pemeriksa (wajib diisi)</label>
  		<input type="email" class="form-control" name="email" id="email" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="hp">Tanggal Daftar</label>
  		<input type="text" class="form-control" name="hp" id="hp">
	</div>

	<div class="form-group">
	<input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
	<input type="reset" value="Reset" class="btn btn-danger">
	</div>

	</form>
	</div>
</div>
</div>
<script src="../libs/jquery.min.js"></script>
<!-- Load Bootstrap JS -->
<script src="../libs/bootstrap.min.js"></script>
<!-- Load jQuery Validator -->
<script src="../libs/jquery.validate.min.js"></script>
<script src="../libs/additional-methods.min.js"></script>
<script>
$("#form_input").validate();
</script>
  </body>
</html>