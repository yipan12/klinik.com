<?php 
$cbulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$cnobl  = array("01","02","03","04","05","06","07","08","09","10","11","12");

#index data dari database
	$sql="select a.tanggal,a.kode,a.id_pasien,b.nama from parameter_pasien a left join pasien b on (a.id_pasien)=b.id_pasien where a.tanggal='".date('Y-m-d')."'";
	$query=mysql_query($sql); 
	$cek="Hari Ini";
##
#filtering data sesuai keinginan berdasarkan hari,bulan,tahun,dan semua data 
if(isset($_POST['tgl1']) AND ($_POST['periode']=="harian"))
{
	$tgl    = $_POST['tgl1'];
	$bln    = $cnobl[$_POST['bln1']];
	$blnc   = $cbulan[$_POST['bln1']];
	$thn    = $_POST['thn1']; 

	if($tgl<=9){
		$tg="0".$tgl;
		}else{
		$tg=$tgl;
		}		
	$sql="select a.tanggal,a.kode,a.id_pasien,b.nama from parameter_pasien a left join pasien b on (a.id_pasien)=b.id_pasien WHERE a.tanggal LIKE '".$thn."-".$bln."-".$tg."%"."'";
	$query=mysql_query($sql); 
	$cek=$tg." ".$blnc." ".$thn;
	
} elseif(isset ($_POST['bln2']) AND ($_POST['periode']=="bulanan")) 
{
	
	$bln    = $cnobl[$_POST['bln2']];
	$blnc   = $cbulan[$_POST['bln2']];
	$thn    = $_POST['thn2']; 
	
	$sql="select a.tanggal,a.kode,a.id_pasien,b.nama from parameter_pasien a left join pasien b on (a.id_pasien)=b.id_pasien WHERE MONTH(a.tanggal)='".$bln."' AND YEAR(a.tanggal)='".$thn."'";
	$query=mysql_query($sql);
	$cek=$blnc." ".$thn;	
		
} elseif (isset ($_POST['thn3']) AND ($_POST['periode']=="tahunan")) 
{
	$thn    = $_POST['thn3']; 
	
	$sql="select a.tanggal,a.kode,a.id_pasien,b.nama from parameter_pasien a left join pasien b on (a.id_pasien)=b.id_pasien WHERE  YEAR(a.tanggal)='".$thn."'";
	$query=mysql_query($sql); 
	$cek=$thn;
} elseif ($_POST['periode']=="semua")
{
	$sql="select a.tanggal,a.kode,a.id_pasien,b.nama from parameter_pasien a left join pasien b on (a.id_pasien)=b.id_pasien";
	$query=mysql_query($sql);
	$cek="Semua Data";
}
##
	?>    
    
    <body>
        <div class="container">
            <h2 class="text-center">Index Hasil Uji</h2>
            <form id="form_input" method="POST">	
			<table width="380" border="0">
            <tr>
            <td width="70">Periode</td>
            <td width="300">
            <select name="periode" id="periode" class="form-control" style="width:95%">
				<option hidden >Silahkan pilih</option>
				<option value="harian">Harian</option>
				<option value="bulanan">Bulanan</option>
				<option value="tahunan">Tahunan</option>
				<option value="semua">Semua</option>
			</select>
            </td>
			<td></td>
			<td>  <span class="form-group">
                <input type="submit" value="Filter" name="filter" class="btn btn-primary">
              </span> </td>
            </tr>
			<tr>
			<td >&nbsp; </td>
			<td >&nbsp; </td>
			</tr>
            <tr >
            <td ></td>
            <td>
			<div id="output"></div>
			<!--input type="text" class="form-control form_date " data-date-format="yyyy-mm-dd" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d'); ?>" style="width:50%"-->
			</td>
            </tr>
            
            </table>
			</form>
            <br><br>
			<div >Periode Data : <strong><?php echo $cek ?></strong></div><br>
            <div class="form-group"></div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th>Tanggal</th>
                            <th>ID Pasien</th>
                            <th>No Registrasi</th>
                            <th>Nama Pasien</th>
							<th>Keterangan</th>
                            
                      </tr>
                    </thead>
                    <tbody>
 <?php 
 ##normalisasi data array pasien
	$m=mysql_query("select tanggal,parameter_uji,kode,paket from parameter_pasien where `load`='Y'");
	while ($rw=mysql_fetch_array($m)) {
	$tgl = $rw['tanggal'];
	$reg = $rw['kode'];
	$para = explode(',',$rw['parameter_uji']);
	$j_paket = explode(',',$rw['paket']);
	$pp = count($para);
	//echo $para;
	$indeks=0; 
while($indeks < count($para)){ 
$sql1="insert ignore pemeriksaan (tanggal,parameter,kode,paket) values ('".$tgl."','".$para[$indeks]."','".$reg."','".$j_paket[$indeks]."')";
$query1=mysql_query($sql1);
//echo $sql1;
$indeks++; 
}}
##	
  ?>
<?php $no=1; 	while ($data=mysql_fetch_array($query)) {			

$tanggal = $data['tanggal']; 
$kode = $data['kode']; 
$nama = $data['nama'];
$id_pasien=$data['id_pasien'];
   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
							<td><?php echo $tanggal ?></td>
							<td><?php echo $id_pasien ?></td>
                        	<td><?php  echo "<a href=home.php?ref=input_hasil&kode=".$kode."&tanggal=".$tanggal."&id_pasien=".$id_pasien."&nama=".$nama." target=>".$kode."</a>"; ?></td>
                            <td><?php echo $nama ?></td>


                            <td><?php
							#penjumlahan data parameter uji antara sudah di periksa dan belum
										$k=mysql_query("select SUM(IF(tag='N',pending,0))belum_selesai,SUM(IF(tag='Y',pending,0))sudah_selesai from pemeriksaan where kode='" .$kode. "'");
										$l=mysql_fetch_array($k); 
										$belum_selesai=$l['belum_selesai'];
										$sudah_selesai=$l['sudah_selesai']; 
										$tot = $sudah_selesai+$belum_selesai;   
										echo "Pemeriksaan Belum Selesai :".$belum_selesai."<br>";  
										echo "Pemeriksaan Sudah Selesai :".$sudah_selesai."<br>"; 
										echo "Total Pemeriksaan :".$tot."<br>";  
							##			?></td>
                        </tr>
	<?php   $no++; } 
	#update harga pemeriksaan dari data master parameter uji
	$sql=mysql_query("UPDATE pemeriksaan a, parameter_uji b SET a.biaya=b.biaya  WHERE a.parameter = b.sub_kode;");
	//echo $sql;
	?>                                                
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
          </div>
    </div>	

    </body>