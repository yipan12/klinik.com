<html>
<head>
<title>Edit Data</title>
        <!--link rel="stylesheet" href="libs/bootstrap.min.css">	
        <link rel="stylesheet" href="libs/dataTables.bootstrap.css"-->
<?php 
include ('../libs/koneksi.php');
include ("../libs/alerts.php");
	$kunjungan="kunjungan";
					
	$sql="select id,kode,id_pasien,nama,alamat,tempat_lahir,tanggal_lahir,pekerjaan,no_telp,jenis_pasien,dokter_pemeriksa from pasien  WHERE id = '".$_GET['id']."'";
	$query=mysql_query($sql); 
	$data=mysql_fetch_array($query);
	?> 
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <h3>Tambah Pemeriksaan Pasien</h3>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  

if(isset($_POST['tambah']))
{
	$parameter=implode(",",$_POST['parameter_ujis']);
	$paket=implode(",",$_POST['paket']);
	
	$sql="insert into kunjungan_pasien (kode,id_pasien,tanggal,nama_pengunjung,alamat_pengunjung,jenis_pengunjung,dokter_pengirim) values ('".$_POST['kode']."','".$_POST['id_pasien']."','".$_POST['tanggal']."','".$_POST['nama']."','".$_POST['alamat']."','".$_POST['jenis_pasien']."','".$_POST['nama_dokter']."')";
	$query=mysql_query($sql);
	//echo $sql;
	
	$sql="insert into dokter (dokter_pemeriksa,kode) values ('".$_POST['nama_dokter']."','".$_POST['kode']."')";
	$query=mysql_query($sql);
	//echo $sql;
	
if(isset($_POST['parameter_ujis']))
{
	$sql="insert into parameter_pasien (id_pasien,tanggal,kode,parameter_uji,`load`) values ('".$_POST['id_pasien']."','".$_POST['tanggal']."','".$_POST['kode']."','".$parameter."','Y')";
	$query=mysql_query($sql);
	//echo $sql;
} elseif(isset($_POST['paket'])) {
	$sql="insert into parameter_pasien (id_pasien,tanggal,kode,parameter_uji,`load`) values ('".$_POST['id_pasien']."','".$_POST['tanggal']."','".$_POST['kode']."','".$paket."','Y')";
	$query=mysql_query($sql);
	//echo $sql;
}	
	
	
	writeMsg('save.sukses');
	//echo "<script language=javascript>parent.location.href='home.php?ref=input_registrasi';</script>";
	echo "
			<script type='text/javascript'>if (confirm('Apakah Anda Ingin Menuju Halaman Input Hasil Uji ?')) {
			// Save it!
			parent.location.href='home.php?ref=hasil_uji'
			} else {
			// Do nothing!
			parent.location.href='home.php?ref=pasien'
			}
			</script>";
}
?>
<table width="1100" border="0">
<tr><td width="525">
	<div class="form-group">
  		<label class="control-label" for="kode">Kode</label>
  		<input type="text" class="form-control" name="kode" id="kode" value="<?php $thn=substr(date('Y'),3,1); echo $thn; echo date('mdHis')   ?>" tabindex="" readonly="readonly">
	</div>
</td>
<td width="525">

</td>
</tr>
<tr><td>
<div class="form-group">
  		<label class="control-label" for="id_pasien">ID Pasien </label>
  		<input name="id_pasien" type="text" required class="form-control" id="id_pasien" value="<?php  echo $data['id_pasien'];   ?>"  readonly="readonly" >
  		<!--input  name="kode" type="text" class="form-control" id="kode" value="<?php //$thn=substr(date('Y'),3,1); echo $thn; echo date('mdHis')   ?>"  readonly="readonly" -->
	</div>
</td><td></td>
</tr>
<tr>
<td><div class="form-group">
  		<label class="control-label" for="tanggal">Tanggal </label>
  		<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d') ?>" readonly="readonly" >
	</div>
</td><td></td>
</tr>
<tr>
<td>
	<div class="form-group">
  		<label class="control-label" for="nama">Nama Pasien</label>
  		<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama']; ?>" tabindex="1" required>
	</div>
</td>
<td></td>
</tr>
<tr><td>
	<div class="form-group">
  		<label class="control-label" for="alamat">Alamat Pasien</label>
  		<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data['alamat']; ?>" tabindex="2" required>
	</div>
</td>
<td></td>
</tr>
<tr><td>
	<div class="form-group">
  		<label class="control-label" for="tempat_lahir">Tempat Lahir</label>
  		<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" tabindex="3" required>
	</div>
</td>
<td></td>
</tr>
<tr><td>
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
</td>
<td></td>
</tr>
<tr><td>
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
</td>
<td></td>
</tr>
<tr><td>		
	</div>
	<div class="form-group">
  		<label class="control-label" for="no_telp">No Telephone</label>
  		<input type="number" class="form-control" name="no_telp" id="no_telp" value="<?php echo $data['no_telp']; ?>" tabindex="6" maxlength="12" style="width:30%;" required>
	</div>
	
	<div class="form-group">
  		<label class="control-label" for="jenis_pasien">Jenis Pasien</label>
  		<!--input type="text" class="form-control" name="jenis_pasien" id="jenis_pasien" value="<?php echo $data['jenis_pasien']; ?>" tabindex="6" required-->
		<select name="jenis_pasien" class="form-control"  tabindex="6" required="required" >
        <option><?php echo $data['jenis_pasien']; ?></option>
        <?php
		$sql2=mysql_query("select * from jenis_pasien ");
		while($data2=mysql_fetch_array($sql2, MYSQL_BOTH )){
		echo "<option value=$data2[kode]>";
		echo "".$data2[jenis]."";
		} 	 
		
		?>
		</select>
	</div>
	
	<div class="form-group">
  		<label class="control-label" for="nama_dokter">Dokter Pengirim</label>
  		<input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="<?php echo $data['dokter_pemeriksa']; ?>" tabindex="6" required>
	</div>

</td>
<td></td>
</tr>
<tr>
<td>

<div class="container1">
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">PARAMETER UJI</a></li>
    <li><a data-toggle="tab" href="#menu1">PAKET</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
         <br>
		 <div style="padding:3px;overflow:auto;width:auto;height:250px;border:0px solid grey">
		 <?php 
//include ('libs/koneksi.php');

		  $s=mysql_query("select kode,nama from kelompok_parameter_uji");
		  $count_a=mysql_num_rows($s);
		  //for ($i=1;$i <=$count_a;$i++) {
		  //echo "div".$i; }
		  $i=1;
			while ($d=mysql_fetch_array($s) ) {
			$t=$d['nama'];
			$k=$d['kode'];
			
$sql1="select sub_kode,nama_parameter,biaya from parameter_uji where kode='".$k."'";
$query1=mysql_query($sql1);
			?>
		<?php echo"<div id=div$i class=clickme>"; echo $t; ?><span class="glyphicon glyphicon-chevron-down kanan_parameter"></span></div>
		<?php echo"<div id=isi$i class=box>"; ?>
<?php
$i=$i+1;
$o=1;
while($data=mysql_fetch_array($query1)) {
$nama=$data['nama_parameter'];
$sk=$data['sub_kode'];
$biaya=number_format($data['biaya'],0,'.','.');
$biaya1=$data['biaya'];
//echo $o;
?>
<input id="<?php echo "chk".$o; ?>" type="checkbox" value="<?php echo $sk; ?>" name="parameter_ujis[]" price="<?php echo $biaya1; ?>" data="<?php echo $nama; ?>" data2="<?php echo $sk; ?>" data3="<?php echo $biaya; ?>">
<?php
echo"
			 <span id=a$o>$sk -  $nama    (Rp. $biaya)</span><br><br>
";		?>	
<?php
$o=$o+1;
  }
  echo"</div>";
  } ?>

       </div></div>
    <div id="menu1" class="tab-pane fade">
	<br>
      <div style="padding:3px;overflow:auto;width:auto;height:250px;border:0px solid grey">
		 <?php 
			$mysql_paket=mysql_query("SELECT a.kode,a.nama_paket,a.parameter,b.total FROM paket_pemeriksaan a LEFT JOIN paket_total b ON(a.kode)=b.kode");
			$i=1;
			while($data_paket=mysql_fetch_array($mysql_paket)) {
			$parameter_paket=$data_paket['parameter'];
			$kode_paket=$data_paket['kode'];
			$nama_paket=$data_paket['nama_paket'];
			$total_paket=$data_paket['total'];
			$total_paket1=number_format($data_paket['total'],0,'.','.');
		  			
$sql2="SELECT parameter,nama_parameter FROM paket_nama WHERE kode='".$kode_paket."'";
$query2=mysql_query($sql2);
			?>
			<div id="<?php echo "div_a".$i; ?>" class="clickme"><input id="chk" type="checkbox" value="<?php echo $parameter_paket; ?>" name="parameter_ujis[]" price="<?php echo $total_paket; ?>" data="<?php echo $nama_paket; ?>" data2="<?php echo $kode_paket; ?>" data3="<?php echo $total_paket1; ?>">
		<?php  echo $nama_paket."    ( Rp. ".number_format($total_paket,0,'.','.')." )"; ?><span class="glyphicon glyphicon-chevron-down kanan_parameter"></span></div>
		<?php echo"<div id=isi_a$i class=box>"; ?>
<?php
$i=$i+1;
$o=1;
while($data2=mysql_fetch_array($query2)) {
$parameter2=$data2['parameter'];
$nama2=$data2['nama_parameter'];

?>
<?php
echo"<span id=a_a$o># $parameter2 -  $nama2   </span><br><br>";?>	
<?php
$o=$o+1;
  }
  echo"</div>";
  } ?>

  </div>
       </div>
   
   </div>
</td>
<td>
<div style="padding:3px;overflow:auto;width:auto;height:250px;border:0px solid grey">
<div id="output" style="padding-left:20px;">Informasi Pasien :<br><br></div>
</div>
<div style="float:right">Total : <input type="text" id="total_biaya" ></div>

</td>
</tr>
<br>
<tr><td>
<br>
	<div class="form-group">
	<input type="submit" value="Tambah" name="tambah" class="btn btn-primary" tabindex="7">
	<a href="home.php?ref=pasien" class="btn btn-danger" tabindex="8">Batal</a>
	</div>
</td>
<td></td>
</tr>	
</table>
	</form>
	</div>
</div>

</div>
</body>
</html>