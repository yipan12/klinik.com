<html>
<head>
<title>Tambah Stock Reagen</title>
        <!--link rel="stylesheet" href="libs/bootstrap.min.css">	
        <link rel="stylesheet" href="libs/dataTables.bootstrap.css"-->
<?php 
include ('../libs/koneksi.php');
include ("../libs/alerts.php");
	$kunjungan="kunjungan";
	

	
	$sql="SELECT id,kode_reagen,nama_reagen,bentuk,stock FROM reagen  WHERE id = '".$_GET['id']."'";
	$query=mysql_query($sql); 
	$data=mysql_fetch_array($query);
	?> 
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <h3>Set Parameter Uji</h3>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['tambah']))
{
	$sql=mysql_query("SELECT kode_reagen FROM reagen_parameter_array WHERE kode_reagen='".$_POST['kode']."'");
	
	if(mysql_num_rows($sql)>0){
	
	$parameter=implode(",",$_POST['parameter_ujis']);
	//$code=substr($_POST['nama'],0,3);
	$sql="update reagen_parameter_array set kode_reagen='".$_POST['kode']."' ,kode_parameter='".$parameter."' where kode_reagen='".$_POST['kode']."'";
	mysql_query($sql);
	
	$sql=mysql_query("DELETE FROM reagen_parameter WHERE kode_reagen='".$_POST['kode']."'");

	$sql=mysql_query("UPDATE reagen_parameter_array SET `load`='Y' WHERE kode_reagen='".$_POST['kode']."'");

	echo $_POST['kode']."data ada";
	} else {
	
	$parameter=implode(",",$_POST['parameter_ujis']);
	//$code=substr($_POST['nama'],0,3);
	$sql="insert into reagen_parameter_array (kode_reagen,kode_parameter) values ('".$_POST['kode']."','".$parameter."')";
	mysql_query($sql);
	echo $_POST['kode']."data ga ada";
	}

	
	
	$m=mysql_query("select kode_reagen,kode_parameter from reagen_parameter_array where `load`='Y'");
	while ($rw=mysql_fetch_array($m)) {
	$kode_reagen = $rw['kode_reagen'];
	$para = explode(',',$rw['kode_parameter']);
	$pp = count($para);
	//echo $para;
	$indeks=0; 
while($indeks < count($para)){ 
//echo $para[$indeks]; 
//echo "<br>";
$sql1="insert ignore reagen_parameter (kode_reagen,kode_parameter) values ('".$kode_reagen."','".$para[$indeks]."')";
$query1=mysql_query($sql1);
//echo $sql1;



$indeks++; 
}}
	$query=mysql_query("update reagen_parameter_array set `load`='N'"); 
	echo "<script language=javascript>parent.location.href='home.php?ref=reagen';</script>";
	writeMsg('update.sukses');

	//Re-Load Data from DB
	//$sql = mysql_query("select id,kode,nama from kelompok_parameter_uji  WHERE id = '".$_GET['id']."'");
	//$data = mysql_fetch_array($sql);
}
?>
	<div class="form-group">
  		<label class="control-label" for="kode">Kode</label>
  		<input type="text" class="form-control" name="kode" id="kode" value="<?php echo $data['kode_reagen']; ?>"  readonly="readonly">
	</div>


	<div class="form-group">
  		<label class="control-label" for="nama">Nama</label>
  		<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_reagen']; ?>"  readonly="readonly">
	</div>
	
	<div class="form-group">
  		<label class="control-label" for="parameter_uji">Parameter Uji</label>
			<div  style="color:#C0C0C0">#Isikan Dengan Parameter Yang Akan Di Uji</div>
  		<!--input type="number" class="form-control" name="stock" id="stock" value="<?php echo $data['stock']; ?>"  style="max-width:30%" -->
  		<select name="parameter_ujis[]" data-placeholder="Pilih Parameter Uji" style="width:70%;" class="form-control chosen-select" multiple tabindex="17" required>
				<?php
				//include ('libs/koneksi.php');

						  $s=mysql_query("select kode,nama from kelompok_parameter_uji");
							while ($d=mysql_fetch_array($s)) {
							$t=$d['nama'];
							$k=$d['kode'];

				$sql1="select sub_kode,nama_parameter from parameter_uji where kode='".$k."'";
				$query1=mysql_query($sql1);
							
							echo"<optgroup label=$t>";
				while($data=mysql_fetch_array($query1)) {
				$nama=$data['nama_parameter'];
				$sk=$data['sub_kode'];
							echo"<option value=$sk>$nama</option>";
							
				}
				echo"</optgroup>";
				}
				?>
          </select>
	</div>

	
	<div class="form-group">
	<input type="submit" value="Tambah" name="tambah" class="btn btn-primary">
	<a href="home.php?ref=reagen" class="btn btn-danger">Batal</a>
	</div>

	</form>
	</div>
</div>

</div>
</body>
</html>