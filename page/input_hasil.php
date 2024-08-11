<?php 
#catch data dr halaman sebelumnya menggunakan GET
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$id_pasien=$_GET['id_pasien'];
$tanggal=$_GET['tanggal'];
##

#ambil data pasien dr database
$que=mysql_query("select nama from pasien where kode='".$kode."'");
$row2=mysql_fetch_assoc($que);
##
	
#index data dr database
	$sql="select b.sub_kode,b.nama_parameter,b.satuan,b.metode,b.batas_normal,a.hasil from pemeriksaan a left join parameter_uji b on (a.parameter)=b.sub_kode where a.kode='". $kode ."'";
	$query=mysql_query($sql); 
##
	if(isset($_POST['simpan'])) {
#insert/update data hasil pemeriksaan
	$sql=mysql_query("select parameter from pemeriksaan where kode='".$kode."'");
	$count=mysql_num_rows($sql);
	for($i=0;$i<$count;$i++){
	$sql="update pemeriksaan set hasil='".$_POST['hasil'][$i]."', gambar = '".$_POST['gambar'][$i]."' where parameter='".$_POST['sub_kode'][$i]."' and kode='".$kode."'";
	$query=mysql_query($sql);
	}
##

#insert/update data detail pemeriksaan (kesimpulan,catatan,saran)
	$sql="DELETE FROM pemeriksaan_detail WHERE kode='".$kode."'";
	$query=mysql_query($sql);
	$sql="insert into pemeriksaan_detail (tanggal,kode,kesimpulan,catatan,saran) values ('".$tanggal."','".$kode."','".$_POST['kesimpulan']."','".$_POST['catatan']."','".$_POST['saran']."')";
	$query=mysql_query($sql);
##

#fungsi otomatis mengurangi stock reagen yg terpakai saat pemeriksaan utk parameter yg telah terdaftar di table reagen_parameter
	$sql3="SELECT parameter FROM pemeriksaan WHERE tag='N' AND kode='".$kode."'"; #untuk mendapatkan parameter
	$query3=mysql_query($sql3);
	while ($row=mysql_fetch_assoc($query3)) {
	$parameter=$row['parameter'];
	$sql4="SELECT a.kode_reagen,b.nama_reagen,a.kode_parameter,b.stock FROM reagen_parameter a LEFT JOIN reagen b ON (a.kode_reagen)=b.kode_reagen WHERE a.kode_parameter='".$parameter."'"; #untuk mendapatkan kode reagen dan stock yg tersisa d sistem
	$query4=mysql_query($sql4);
	while ($row2=mysql_fetch_array($query4)) {
	$reagen=$row2['kode_reagen'];
	$stock=$row2['stock'];
	$sql5="UPDATE reagen  SET stock=".$stock."-1 WHERE kode_reagen='".$reagen."'";
	$query5=mysql_query($sql5);
	$insert1="INSERT INTO reagen_pakai (tanggal,kode_reagen,kode_pemeriksaan,parameter) VALUES ('".$tanggal."','".$reagen."','".$kode."','".$parameter."');";
	$que2=mysql_query($insert1);
	}	}
##

#tagging data ke 'Y' bila pada kolom hasil tidak ada nilai
	$insert="UPDATE pemeriksaan SET tag='Y' WHERE hasil!='' AND kode='".$kode."'";
	$que=mysql_query($insert);
##
	echo "<script language=javascript>parent.location.href='home.php?ref=input_hasil&kode=$kode&tanggal=$tanggal&id_pasien=$id_pasien&nama=$nama';</script>";
	writeMsg('save.sukses');
	}
?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Input Data Pemeriksaan</h3><br>
            <p class='pull-right'>
	<a href="page/cetak_mini.php?kode=<?php echo $kode."&id_pasien=".$id_pasien."&nama=".$nama ?>" class="btn btn-default btn-sm btn-warning" style="float:right;" title="Print Struk"><span class="glyphicon glyphicon-print"></span> Print Struk</a>
	<a href="page/cetak.php?kode=<?php echo $kode."&id_pasien=".$id_pasien."&nama=".$nama ?>" class="btn btn-default btn-sm btn-primary" style="float:right;" title="Print Hasil"><span class="glyphicon glyphicon-print"></span> Print Hasil</a>
</p>
         <div class="col-md-2" >#Tanggal : <strong><i><?php echo $tanggal; ?></i></strong></div>
		 <div class="col-md-3" >#No Reg Pasien : <strong><i><?php echo $kode; ?></i></strong></div>
         <div class="col-md-3" >#Nama Pasien : <strong><i><?php echo $row2['nama']; ?></i></strong></div><br><br>
    <form method="POST">     
         <table class="table table-bordered " width="900" >
         

  <tr>
    <td width="38" >No</td>
    <td width="169" >Parameter</td>
    <td width="150" >Hasil</td>
    <td width="150" >Gambar</td>
    <td width="80" >Satuan</td>
    <td width="80" >Metode</td>
    <td width="218" >Batas Normal</td>
  </tr>
  <?php $no=1; while($data=mysql_fetch_array($query)) { 
  
  $nama=$data['nama_parameter'];
  $satuan=$data['satuan'];
  $metode=$data['metode'];
  $batas_normal=$data['batas_normal'];
  
  ?>
  			<tr>
  				<td><?php echo $no++; ?></td>
                <td><?php echo $nama; ?></td>
				<td><input type="hidden" name="sub_kode[]" class="form-control" value="<?php echo $data['sub_kode'];  ?>"><textarea type="text" name="hasil[]" class="form-control" value=""><?php echo $data['hasil'];  ?></textarea></td>
				<td><input name="gambar[]" type="file" class="btn btn-default btn-sm btn-success" style="float:right;"></td>
				<td><?php echo $satuan; ?></td>
				<td><?php echo $metode; ?></td>
				<td><?php echo $batas_normal; ?></td>
  			</tr>
  
  <?php  } ?>
<?php 
#menampilkan data detail (kesimpulan,catatan,dan saran)
 $sql="select id,kode,kesimpulan,catatan,saran from pemeriksaan_detail WHERE kode='".$kode."'";
 $query=mysql_query($sql);
 $data2=mysql_fetch_array($query);
##
 ?>
</table>
<table class="table table-bordered " width="900" >
<tr>
<td>Kesimpulan Pemeriksaan :</td>
<td>Catatan :</td>
<td>Saran :</td>
</tr>
<tr>
<td><textarea type="text" name="kesimpulan" class="form-control"><?php echo $data2['kesimpulan']; ?></textarea></td>
<td><textarea type="text" name="catatan" class="form-control"><?php echo $data2['catatan']; ?></textarea></td>
<td><textarea type="text" name="saran" class="form-control"><?php echo $data2['saran']; ?></textarea></td>
</tr>
</table>
<br>
<div class="form-group">
        <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
        <input type="reset" value="Reset" class="btn btn-danger">
		<a href="home.php?ref=hasil_uji" class="btn btn-success">Back</a>
        </div>

		</div>		
	</form>
</body>