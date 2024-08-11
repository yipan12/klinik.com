<html>
<head>
<title>Edit Data</title>
        <!--link rel="stylesheet" href="libs/bootstrap.min.css">	
        <link rel="stylesheet" href="libs/dataTables.bootstrap.css"-->
<?php 
include ('../libs/koneksi.php');
include ("../libs/alerts.php");
	$kunjungan="kunjungan";
				
	$sql="SELECT a.id,a.dokter_pemeriksa,a.kode,SUM(b.biaya)total,a.fee,a.persen FROM dokter a LEFT JOIN pemeriksaan b ON (a.kode)=b.kode WHERE a.id = '".$_GET['id']."' GROUP BY kode";
	$query=mysql_query($sql); 
	$data=mysql_fetch_array($query);

	?> 
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <h3>Set Fee Dokter Pengirim</h3>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['update']))
{
	$fee =$_POST['fee'] / 100 * $data['total'];	
	mysql_query("UPDATE dokter SET  fee = '".$fee."', persen = '".$_POST['fee']."' WHERE id = '".$_GET['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=lap_bagi_hasil';</script>";
	writeMsg('update.sukses');

	//Re-Load Data from DB
	//$sql = mysql_query("select id,kode,nama from kelompok_parameter_uji  WHERE id = '".$_GET['id']."'");
	//$data = mysql_fetch_array($sql);
}
?>

	<div class="form-group">
  		<label class="control-label" for="nama_dokter">Nama Dokter</label>
  		<input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="<?php echo $data['dokter_pemeriksa']; ?>" readonly="readonly">
	</div>

	<div class="form-group">
  		<label class="control-label" for="kode">Kode Pemeriksaan</label>
  		<input type="text" class="form-control" name="kode" id="kode" value="<?php echo $data['kode']; ?>" readonly="readonly">
	</div>
	<div class="form-group">
  		<label class="control-label" for="total">Total (Rp)</label>
  		<input type="text" class="form-control" name="total" id="total" value="<?php echo number_format($data['total'],0,'.','.'); ?>" readonly="readonly">
	</div>

	<div class="form-group">
  		<label class="control-label" for="fee">Set Fee (%)</label>
  		<input type="number" class="form-control" name="fee" id="fee" value="<?php echo number_format($data['persen'],0,'.','.'); ?>" tabindex="1"  maxlength="2" style="width:13%;" required>
	</div>
		
	<div class="form-group">
	<input type="submit" value="Update" name="update" class="btn btn-primary" tabindex="2">
	<a href="home.php?ref=lap_bagi_hasil" class="btn btn-danger" tabindex="3">Batal</a>
	</div>

	</form>
	</div>
</div>

</div>
</body>
</html>