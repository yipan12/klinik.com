<?php 					
#index data dr database	
	$sql="select a.id,a.tanggal,a.kode,a.nama_pengunjung,a.alamat_pengunjung,b.jenis,a.dokter_pengirim from kunjungan_pasien a left join jenis_pasien b on (a.jenis_pengunjung)=b.kode where a.tanggal='".date('Y-m-d')."'";
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
	$sql="select a.id,a.tanggal,a.kode,a.nama_pengunjung,a.alamat_pengunjung,b.jenis,a.dokter_pengirim from kunjungan_pasien a left join jenis_pasien b on (a.jenis_pengunjung)=b.kode WHERE a.tanggal LIKE '".$thn."-".$bln."-".$tg."%"."'";
	$query=mysql_query($sql); 
	$cek=$tg." ".$blnc." ".$thn;
	
} elseif(isset ($_POST['bln2']) AND ($_POST['periode']=="bulanan")) 
{
	
	$bln    = $cnobl[$_POST['bln2']];
	$blnc   = $cbulan[$_POST['bln2']];
	$thn    = $_POST['thn2']; 
	
	$sql="select a.id,a.tanggal,a.kode,a.nama_pengunjung,a.alamat_pengunjung,b.jenis,a.dokter_pengirim from kunjungan_pasien a left join jenis_pasien b on (a.jenis_pengunjung)=b.kode WHERE MONTH(a.tanggal)='".$bln."' AND YEAR(a.tanggal)='".$thn."'";
	$query=mysql_query($sql);
	$cek=$blnc." ".$thn;	
		
} elseif (isset ($_POST['thn3']) AND ($_POST['periode']=="tahunan")) 
{
	$thn    = $_POST['thn3']; 
	
	$sql="select a.id,a.tanggal,a.kode,a.nama_pengunjung,a.alamat_pengunjung,b.jenis,a.dokter_pengirim from kunjungan_pasien a left join jenis_pasien b on (a.jenis_pengunjung)=b.kode WHERE  YEAR(a.tanggal)='".$thn."'";
	$query=mysql_query($sql); 
	$cek=$thn;
} elseif ($_POST['periode']=="semua")
{
	$sql="select a.id,a.tanggal,a.kode,a.nama_pengunjung,a.alamat_pengunjung,b.jenis,a.dokter_pengirim from kunjungan_pasien a left join jenis_pasien b on (a.jenis_pengunjung)=b.kode";
	$query=mysql_query($sql);
	$cek="Semua Data";
}
##
?>       
    <body>
        <div class="container">
            <h3 class="text-center">Daftar Kunjungan Pasien</h3>
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
			<div >Periode Data : <strong><?php echo $cek ?></strong></div>
            <div class="form-group"></div>
			<!--a href="home.php?ref=input_registrasi" class="btn btn-default btn-sm btn-success" style="float:right;"><span class="glyphicon glyphicon-plus"></span> Add New</a-->
<br>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width='10'>No</th>
                            <th>Tanggal</th>
                            <th>No Reg</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Pasien</th>
                            <th>Dokter Pengirim</th>
                            
                      </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$tanggal = $data['tanggal'];
$id_pasien = $data['kode'];
$nama = $data['nama_pengunjung'];
$alamat = $data['alamat_pengunjung'];
$jenis_pasien = $data['jenis'];
$dokter_pemeriksa = $data['dokter_pengirim'];


   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                        	<td><?php echo $tanggal ?></td>
                            <td><?php echo $id_pasien ?></td>
                            <td><?php echo $nama ?></td>
                            <td><?php echo $alamat ?></td>
                            <td><?php echo $jenis_pasien ?></td>
							<td><?php echo $dokter_pemeriksa ?></td>
							
                        </tr>
	<?php $no++; } ?>                                                
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
          </div><!-- /.box-body -->
    </div>	
        <!--script src="table/jquery-1.11.1.min.js"></script-->
        <!--script src="table/bootstrap.min.js"></script-->
        <!--script src="table/jquery.dataTables.min.js"></script-->
        <!--script src="table/dataTables.bootstrap.js"></script-->	
        <!--script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script-->
    </body>
</html>