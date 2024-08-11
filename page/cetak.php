<html>
<title>Print Data Pemeriksaan</title>
	<head>
		<link href="../libs/bootstrap.css" rel="stylesheet">
		<link href="../libs/style.css" rel="stylesheet">
		
		<style type="text/css">		
			
			body {
				padding-top: 20px;
				padding-bottom: 40px;
				font-size: 0.7em;
				color:#333;
			}
			.page-header {
					border: 0px solid #999;
					
			}
			.spc {
			padding:3px 0;
			}
</style>
<div class="header" >
    <div id="logo_image1"><img src=../images/LogoLab.png /></div>
                <div >
						<div style="font-size:16px;">Laboratorium Klinik<br></div>
						<div style="font-size:20px;"><strong>Betha Medika</strong></div>
						<div style="font-size:14px;">Jl. Raya Jagawana, RT.4/4/RW.no 25, Sukarukun, Kec. Sukatani, Kabupaten Bekasi, Jawa Barat 17630</div>
						<div style="font-size:13px;">Telp : 021 30123 666 </div>
						</div><br><br>
	</div>
	</head>
	<?php
	
	$kode=$_GET['kode'];
	$id_pasien=$_GET['id_pasien'];
	$nama=$_GET['nama'];
	$date1=date('Y-m-d');
	
			include ('../libs/koneksi.php');
			//include ('../header.php');
			$query1 = "SELECT id_pasien,kode,nama,ceil(datediff('".$date1."',tanggal_lahir)/365) as umur,tanggal_lahir,alamat,tanggal,dokter_pemeriksa,alamat_dokter FROM pasien  where id_pasien='".$id_pasien."'";
			$result1 = mysql_query($query1) or die(mysql_error());
			$data=mysql_fetch_object($result1);
				//echo $query1;
			//echo $date1;
			
			$thn=substr($data -> tanggal_lahir,0,4);
			$bln=substr($data -> tanggal_lahir,5,2);
			$tgl=substr($data -> tanggal_lahir,8,2);
			
			$thn_now = date('Y');
			$bln_now=date('m');
			$tgl_now = date('d');
			
			
			$harilahir=gregoriantojd($bln,$tgl,$thn);
			//menghitung jumlah hari sejak tahun 0 masehi
			$hariini=gregoriantojd($bln_now,$tgl_now,$thn_now);
			//menghitung jumlah hari sejak tahun 0 masehi
			$umur=$hariini-$harilahir;
			//menghitung selisih hari antara tanggal sekarang dengan tanggal lahir
			$tahun=$umur/365;//menghitung usia tahun
			$sisa=$umur%365;//sisa pembagian dari tahun untuk menghitung bulan
			$bulan=$sisa/30;//menghitung usia bulan
			$hari=$sisa%30;//menghitung sisa hari
			$lahir= "$tgl-$bln-$thn";
			
			$today= "$tgl_now-$bln_now-$thn_now";
			//echo"Tgl Lahir $lahir<br/>";
			//echo"Tgl Skrg $today<br/>";
			//echo"Umur Anda Adalah ".floor($tahun)." tahun ".floor($bulan)." bulan $hari hari";
			
			//echo $thn."-".$bln."-".$tgl;
			//echo $thn_now."-".$bln_now."-".$tgl_now;
			//echo $lahir;
			$no = 1;?>
	<body>
	<br><br><div class="span10 " style="margin-left:40px;">
				<table  border="0" style="width: 100%;">
				<thead>
				</thead>
				<tbody>
				<tr>
					<td class="spc">ID Pasien </td> <td>: <?php echo $data -> id_pasien."<br>"; ?></td>				
					<td class="spc">Tanggal Order </td> <td>: <?php echo $data -> tanggal."<br>"; ?></td>				

				</tr>
				<tr>
					<td class="spc">No Registrasi </td> <td>: <?php echo  $data -> kode."<br>"; ?></td>
					<td class="spc">Dokter Pengirim </td> <td>: <?php echo $data -> dokter_pemeriksa."<br>"; ?></td>
					
				</tr>
				<tr>
					<td class="spc">Nama </td> <td>: <?php echo $data -> nama."<br>"; ?></td>
					<td class="spc">Alamat Pengirim </td> <td>: <?php echo $data -> alamat_dokter."<br>"; ?></td>					
				</tr>
				<tr>
					<!--td><?php //echo "Umur :		". $data ->umur." Tahun"."<br>"; ?></td-->				
					<td class="spc">Umur </td> <td>: <?php echo	floor($tahun)." tahun, ".floor($bulan)." bulan, $hari hari"; ?></td>				
				</tr>
				<tr>
					<td class="spc">Alamat </td> <td>: <?php echo $data -> alamat."<br>"; ?></td>				
				</tr>
				</tbody>
				</table>
				<br><br>
	</div>
	
		<div class='span12  '>
			<h4 align=center style=font-family:arial;color:#333><strong>HASIL PEMERIKSAAN</strong></h4>
			<hr>
			<table  class="table  table-striped" style="width: 100%; min-width : 700px;">
				<thead>
					<th><h4><b>Parameter</b><td><b>Hasil </b></td><td><b>Satuan </b></td><td><b>Nilai Rujukan </b></td><td><b>Metode </b></td></h4></th>
				</thead>
				<tbody>
					<?php
					
$sql1="SELECT SUBSTR(a.parameter,1,3)kelompok,b.nama FROM pemeriksaan a LEFT JOIN kelompok_parameter_uji b ON SUBSTR(a.parameter,1,3)=b.kode WHERE a.kode='".$kode."' GROUP BY kelompok";
$query1=mysql_query($sql1);
while ($data1=mysql_fetch_object($query1)) {
$kelompok=$data1 -> kelompok;
$nama_kelompok=$data1 -> nama;					
					
$query="SELECT a.kode,b.parameter,a.nama_parameter,b.hasil,a.satuan,a.batas_normal,a.metode FROM parameter_uji a INNER JOIN pemeriksaan b ON (a.sub_kode)=b.parameter WHERE b.kode='".$kode."' and a.kode='".$kelompok."'";
$result=mysql_query($query) or die(mysql_error());
//echo $query;
$no=1;
//proses menampilkan data
			echo	"<tr>
					<td><strong>".$nama_kelompok."</strong></td><td></td><td></td><td></td><td></td><td></td>

					</tr>";
//
while($rows=mysql_fetch_object($result)){
					?>

					<tr>
						<td><?php		echo $rows -> nama_parameter;?></td>
						<td><?php		echo $rows -> hasil;?></td>
						<td ><?php	echo $rows -> satuan;?></td>
						<td><?php		echo $rows -> batas_normal;?></td>
						<td><?php		echo $rows -> metode;?></td>
					</tr>
					<?php
}}?>
			
				</tbody>
			</table>
			<?php
			$kes=mysql_query("select kode,kesimpulan,catatan,saran from pemeriksaan_detail WHERE kode='".$kode."'");
			$data3=mysql_fetch_array($kes);
			?>
		<br><div style=text-align:left;font-size:14px;font-family:arial;width:60%;color:#333;><strong>Catatan :</strong> <br><?php echo $data3['catatan']; ?></div>
		<br><div style=text-align:left;font-size:14px;font-family:arial;width:60%;color:#333;><strong>Kesimpulan :</strong> <br><?php echo $data3['kesimpulan']; ?></div>
		<br><div style=text-align:left;font-size:14px;font-family:arial;width:60%;color:#333;><strong>Saran :</strong> <br><?php echo $data3['saran']; ?></div>
		<br><br><div style=text-align:center;width:45%;float:right;font-size:11px;>
		<div style=font-size:16px;font-family:arial;color:#333; >Sintang ,<?php echo date('d-m-Y');  ?></div>
		<div style=font-size:16px;font-family:arial;color:#333;>Pemeriksa</div><br><br>
		<div style=font-size:16px;font-family:arial;color:#333;>Admin</div>
		<div style=font-size:16px;font-family:arial;color:#333;>--------------------------------</div>
		<div style=font-size:16px;font-family:arial;color:#333;>Penanggung Jawab : dr. Thariq muhammad, M.Sc., SpPK</div>
		</div>
		<br><br><br><br><br><br><br><br><div style=font-size:15px;>
		<div style=text-align:left;font-family:arial;color:#333;><strong>Perhatian</strong> : Tanda * menunjukkan nilai di luar rentang batas rujukan</div>
		<div style=text-align:right;font-family:arial;color:#333;>Dicetak Pada :<?php echo date('d-m-Y h:i');  ?></div>
		<div style=text-align:left;font-family:arial;color:#333;>Jika sekiranya ada keraguan tentang hasil pemeriksaan,</div>
		<div style=text-align:left;font-family:arial;color:#333;>harap segera menghubungi Laboratorium Klinik Betha Medika</div>
		</div>
			<br>

		</div>
		<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
	</body>
</html>
