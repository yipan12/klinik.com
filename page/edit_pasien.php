<html>
<head>
<title>Edit Data</title>
        <!--link rel="stylesheet" href="libs/bootstrap.min.css">	
        <link rel="stylesheet" href="libs/dataTables.bootstrap.css"-->
<?php 
include ('../libs/koneksi.php');
include ("../libs/alerts.php");
	$kunjungan="kunjungan";
					
	$sql="select id,kode,id_pasien,nama,alamat,tempat_lahir,tanggal_lahir,pekerjaan,no_telp from pasien  WHERE id = '".$_GET['id']."'";
	$query=mysql_query($sql); 
	$data=mysql_fetch_array($query);
	?> 
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <h3>Edit Data Pasien</h3>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['update']))
{
	mysql_query("UPDATE pasien SET id_pasien = '".$_POST['id_pasien']."',nama = '".$_POST['nama_pasien']."',alamat = '".$_POST['alamat']."', tempat_lahir = '".$_POST['tempat_lahir']."',tanggal_lahir = '".$_POST['tanggal_lahir']."', pekerjaan = '".$_POST['pekerjaan']."', no_telp = '".$_POST['no_telp']."' WHERE id = '".$_GET['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=pasien';</script>";
	writeMsg('update.sukses');

	//Re-Load Data from DB
	//$sql = mysql_query("select id,kode,nama from kelompok_parameter_uji  WHERE id = '".$_GET['id']."'");
	//$data = mysql_fetch_array($sql);
}
?>

	<div class="form-group">
  		<label class="control-label" for="id_pasien">Kode</label>
  		<input type="text" class="form-control" name="id_pasien" id="id_pasien" value="<?php echo $data['id_pasien']; ?>" tabindex="" readonly="readonly">
	</div>

	<div class="form-group">
  		<label class="control-label" for="nama_pasien">Nama Pasien</label>
  		<input type="text" class="form-control" name="nama_pasien" id="nama_pasien" value="<?php echo $data['nama']; ?>" tabindex="1" required>
	</div>
	<div class="form-group">
  		<label class="control-label" for="alamat">Alamat Pasien</label>
  		<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data['alamat']; ?>" tabindex="2" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="tempat_lahir">Tempat Lahir</label>
  		<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" tabindex="3" required>
	</div>
	<div class="form-group">
  		<label class="control-label" for="tanggal_lahir">Tanggal Lahir</label>
		<div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="btn2" data-link-format="dd-mm-yyyy">
                    <input class="form-control" size="10" type="text" name="tanggal_lahir" tabindex="4" value="<?php echo $data['tanggal_lahir']; ?>" required>
     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
         </div>
  		<!--input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>" tabindex="4" required-->
	</div>

	<!--div class="form-group">
  		<label class="control-label" for="pekerjaan">Pekerjaan</label>
  		<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $data['pekerjaan']; ?>" tabindex="5" required>
	</div-->
	<div class="form-group">
  		<label class="control-label" for="pekerjaan">Pekerjaan </label>
  		<!--input type="text" class="form-control" name="pekerjaan" id="pekerjaan"-->
		<select name="pekerjaan" class="form-control"  tabindex="5" required >
        <option><?php echo $data['pekerjaan']; ?></option>
        <?php
		$sql1=mysql_query("select * from pekerjaan ");
		while($data1=mysql_fetch_array($sql1, MYSQL_BOTH )){
		echo "<option value=$data1[kode]>";
		echo "".$data1[nama_pekerjaan]."";
		} 	 
		
		?>
		</select>   
	</div>
	<div class="form-group">
  		<label class="control-label" for="no_telp">No Telephone</label>
  		<input type="number" class="form-control" name="no_telp" id="no_telp" value="<?php echo $data['no_telp']; ?>" tabindex="6" maxlength="12" style="width:30%;" required>
	</div>

	
	<div class="form-group">
	<input type="submit" value="Update" name="update" class="btn btn-primary" tabindex="7">
	<a href="home.php?ref=pasien" class="btn btn-danger" tabindex="8">Batal</a>
	</div>

	</form>
	</div>
</div>

</div>
</body>
</html>