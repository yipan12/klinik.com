<html>
<head>
<title>Edit Data</title>
        <!--link rel="stylesheet" href="libs/bootstrap.min.css">	
        <link rel="stylesheet" href="libs/dataTables.bootstrap.css"-->
<?php 
include ('../libs/koneksi.php');
include ("../libs/alerts.php");
	$kunjungan="kunjungan";
					
	$sql="select a.id,a.tanggal,a.kode,b.nama,b.alamat,b.jenis_pasien,b.dokter_pemeriksa from kunjungan_pasien a left join pasien b on (a.kode)=b.kode  WHERE a.id = '".$_GET['id']."'";
	$query=mysql_query($sql); 
	$data=mysql_fetch_array($query);
	?> 
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-lg-12">
            <h3>Form Edit (Update Data Kunjungan)</h3>
<br>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['update']))
{
	$sql="UPDATE pasien SET tanggal = '".$_POST['tanggal']."', kode = '".$_POST['kode']."', nama = '".$_POST['nama']."', alamat = '".$_POST['alamat']."', jenis_pasien = '".$_POST['jenis_pasien']."', dokter_pemeriksa = '".$_POST['dokter_pemeriksa']."' WHERE id = '".$_GET['id']."'";
	$query=mysql_query($sql);
	echo $sql;
	//echo "<script language=javascript>parent.location.href='home.php?ref=daftar_kunjungan';</script>";
	writeMsg('update.sukses');

	//Re-Load Data from DB
	//$sql = mysql_query("SELECT id,tanggal,id_pasien,nama,alamat,jenis_pasien,dokter_pemeriksa WHERE id = '".$_GET['id']."'");
	//$data = mysql_fetch_array($sql);
}
?>

	<div class="form-group">
  		<label class="control-label" for="tanggal">Tanggal</label>
  		<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $data['tanggal']; ?>" readonly="readonly">
	</div>

	<div class="form-group">
  		<label class="control-label" for="kode">No Registrasi</label>
  		<input type="text" class="form-control" name="kode" id="kode" value="<?php echo $data['kode']; ?>" readonly="readonly">
	</div>

	<div class="form-group">
  		<label class="control-label" for="nama">Nama</label>
  		<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama']; ?>" tabindex="1" required>
	</div>
	
	<div class="form-group">
  		<label class="control-label" for="alamat">Alamat</label>
  		<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data['alamat']; ?>" tabindex="2" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="jenis_pasien">Jenis Pasien</label>
  		<!--input type="text" class="form-control" name="jenis_pasien" id="jenis_pasien" value="<?php echo $data['jenis_pasien']; ?>" required-->
		<select name="jenis_pasien" class="form-control" tabindex="3"  required>
        <option><?php echo $data['jenis_pasien']; ?></option>
        <?php
		$jenis=mysql_query("select * from jenis_pasien ");
		while($row=mysql_fetch_array($jenis, MYSQL_BOTH )){
		echo "<option value=$row[kode]>";
		echo "".$row['jenis']."";
		} 	 
		
		?>
		</select>   
	</div>

	<div class="form-group">
  		<label class="control-label" for="dokter_pemeriksa">Dokter </label>
  		<!--input type="text" class="form-control" name="nama_dokter" id="nama_dokter"-->
		<select name="dokter_pemeriksa" class="form-control" tabindex="4" data-placeholder="Pilih Dokter" required>
        <option ><?php echo $data['dokter_pemeriksa']; ?></option>
        <?php
		$sql=mysql_query("select * from dokter ");
		while($data=mysql_fetch_array($sql, MYSQL_BOTH )){
		echo "<option value=$data[kode]>";
		echo "".$data[nama]."";
		} 	 
		
		?>
		</select>  
	</div>

	<div class="form-group">
	<input type="submit" value="Update" name="update" class="btn btn-primary" tabindex="5">
	<a href="home.php?ref=daftar_kunjungan" class="btn btn-danger" tabindex="6">Batal</a>
	</div>

	</form>
	</div>
</div>

</div>
</body>
</html>