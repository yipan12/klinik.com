<html>
<head>
<title>Edit Data</title>
        <!--link rel="stylesheet" href="../libs/bootstrap.min.css">	
        <link rel="stylesheet" href="../libs/dataTables.bootstrap.css">
        <link href="../libs/style.css" rel="stylesheet"-->
<?php 
include ('../libs/koneksi.php');
include ("../libs/alerts.php");
	//$kunjungan="kunjungan";
					
	//$sql="select id,tanggal,id_pasien,nama,alamat,jenis_pasien,dokter_pemeriksa from ".$kunjungan."  WHERE id = '".$_GET['id']."'";
	//$query=mysql_query($sql); 
	//$data=mysql_fetch_array($query);
	?> 
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header1">
            <h3>Tambah Paket Pemeriksaan </h3>
        </div>
    </div>
</div>
<br><br>
<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php 
$query = mysql_query("SELECT max(kode) as maxID FROM paket_pemeriksaan ");
$data  = mysql_fetch_assoc($query);
$idMax = $data['maxID'];
$noUrut =substr($idMax, 6,3);

$noUrut++;
$char = "PAKET-";
$new = $char . sprintf("%03s", $noUrut);
//echo $newID;
$cek=substr($new,6,3);
//echo $cek;
if($cek == 000) 
{
$newID = $char . sprintf("%03s", $noUrut+1);
}
else
{
$newID = $char . sprintf("%03s", $noUrut);
} 

if(isset($_POST['tambah']))
{
$parameter=implode(",",$_POST['parameter_ujis']);

	$sql= mysql_query("insert into paket_pemeriksaan (kode,nama_paket,parameter,biaya) values (upper('".$_POST['kode']."'),upper('".$_POST['nama']."'),'".$parameter."','".$_POST['biaya']."')");
	//mysql_query("insert into paket_pemeriksaan (kode,nama,nama1,biaya) values ('".$_POST['nama']."','".$parameter."','".$parameter."','".$_POST['biaya']."')");
	//$sql = mysql_query(update);
	
	//DUMMBY QUERY
	$m=mysql_query("select nama_paket,kode,parameter from paket_pemeriksaan");
	while ($rw=mysql_fetch_array($m)) {
	$reg=$rw['kode'];
	$para = explode(',',$rw['parameter']);
	$pp = count($para);
	//echo $para;
	$indeks=0; 
while($indeks < count($para)){ 
//echo $para[$indeks]; 
//echo "<br>";
$sql1="insert ignore paket_filter (parameter,kode) values ('".$para[$indeks]."','".$reg."')";
$query1=mysql_query($sql1);
//echo $sql1;



$indeks++; 
}}
//DUMMBY QUERY	
	$sql=mysql_query("UPDATE paket_filter a,parameter_uji b SET a.biaya=b.biaya WHERE a.parameter=b.sub_kode");
	
	$sql=mysql_query("DROP TABLE IF EXISTS paket_total");
	$sql=mysql_query("DROP TABLE IF EXISTS paket_nama");
	$sql=mysql_query("create table paket_total SELECT kode,SUM(biaya)total FROM paket_filter GROUP BY kode");
	$sql=mysql_query("CREATE TABLE paket_nama SELECT a.kode,a.parameter,b.nama_parameter FROM paket_filter a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode");
  
	echo "<script language=javascript>parent.location.href='home.php?ref=paket_pemeriksaan';</script>";
	writeMsg('save.sukses');

	//Re-Load Data from DB
	//$sql = mysql_query("SELECT id,tanggal,id_pasien,nama,alamat,jenis_pasien,dokter_pemeriksa WHERE id = '".$_GET['id']."'");
	//$data = mysql_fetch_array($sql);
}
?>
<table width="1000">
<tr>
<td>
	<div class="form-group">
  		<label class="control-label" for="kode">Kode Paket</label>
  		<input type="text" class="form-control" name="kode" id="kode" value="<?php echo $newID; ?>" style="width:35%; text-transform:uppercase;" readonly="readonly">
	</div>
</td>
<td>
<div class="form-group" style="max-height:50px;">
		<label class="control-label" for="pilih">Parameter Uji</label><br>
        <select name="parameter_ujis[]" data-placeholder="Pilih Parameter Uji" style="width:70%;" class="form-control chosen-select " multiple tabindex="3" required>
<?php
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
		  <br><br><br>
		  
        </div>
</td>
<tr>
<td>
	<div class="form-group">
  		<label class="control-label" for="nama">Nama Paket</label>
  		<input type="text" class="form-control" name="nama" id="nama" tabindex="1" style="text-transform:uppercase" required >
	</div>
</td>
</tr>
<tr>
<td>
	<div class="form-group">
  		<label class="control-label" for="biaya">Biaya Paket</label>
  		<input type="number" class="form-control" name="biaya" id="biaya" tabindex="2" style="text-transform:uppercase;width:35%;" required >
	</div>
</td>
</tr>
</table>
	
		
		<!--div class="form-group">
  		<label class="control-label" for="biaya">Biaya</label>
  		<input type="text" class="form-control" name="biaya" id="biaya" tabindex="3" required>
		</div-->

	<div class="form-group">
	<input type="submit" value="Tambah" name="tambah" class="btn btn-primary">
	<a href="home.php?ref=paket_pemeriksaan" class="btn btn-danger">Batal</a>
	</div>

	</form>
	</div>
</div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--script src="../libs/jquery.min.js"></script-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--script src="../libs/bootstrap.min.js"></script>
	<script src="../libs/jquery.dataTables.min.js"></script>
    <script src="../libs/dataTables.bootstrap.js"></script>	
    <script src="../libs/jquery.validate.min.js"></script>
	<script src="../libs/additional-methods.min.js"></script>
	<script src="../libs/bootstrap-datetimepicker.js"></script>
	<script src="../libs/bootstrap-datetimepicker.id.js"></script>
	
	<script src="../libs/highcharts.js"></script>
	<script src="../libs/data.js"></script>
	<script type="text/javascript">
	var $nocon = jQuery.noConflict();
		$nocon(function () {
    $nocon('#chrtbar').highcharts({
        data: {
            table: 'chrt'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: 'Statistik Pasien Dan Pemeriksaan'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
	</script>
	
	<script>
	var $jnoc3 = jQuery.noConflict();
			$jnoc3('.form_date').datetimepicker({
			language:  'id',
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
			});
	</script>
	<script>
	var $jnoc1 = jQuery.noConflict();
	$jnoc1(document).ready(function () {
    $menuLeft = $jnoc1('.pushmenu-left');
    $nav_list = $jnoc1('#nav_list');
    $nav_list.click(function(){
        $jnoc1(this) .toggleClass('active') ;
        $jnoc1('.pushmenu-push').toggleClass('pushmenu-push-toright');
        $menuLeft.toggleClass('pushmenu-open');
        });
    });
	</script>
    
    <script type="text/javascript">
    var $jnoc = jQuery.noConflict();
	$jnoc(function() {
    $jnoc('#example1').dataTable();
    });
    </script>
	
<script>
var $jnoc2 = jQuery.noConflict();
$jnoc2("#form_input").validate();
</script-->

</body>
</html>