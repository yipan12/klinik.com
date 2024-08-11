<html>
    <head>
        <title>judul</title>
        <link rel="stylesheet" href="../libs/bootstrap.min.css">	
        <link rel="stylesheet" href="../libs/dataTables.bootstrap.css">
    </head>
<?php 
include ('../libs/koneksi.php');

					
	$sql="select no_reg,nama,jenis_kelamin,umur,tanggal_lahir,tempat_lahir,nama_kk,alamat,jenis_pasien,agama,dokter_pemeriksa,tanggal_daftar from pasien";
	$query=mysql_query($sql); ?>    
    
    <body>
        <div class="container">
            <h2 class="text-center">Tambah Pasien</h2>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th>No</th>
                            <th>Nama</th>
                            <th>No Reg</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>Alamat</th>
                            <th>Jenis Pasien</th>
                            <th>Agama</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$nama = $data['nama'];
$no_reg = $data['no_reg'];
$jenis_kelamin = $data['jenis_kelamin'];
$umur = $data['umur'];
$tanggal_lahir = $data['tanggal_lahir'];
$tempat_lahir = $data['tempat_lahir'];
$nama_kk = $data['nama_kk'];
$alamat = $data['alamat'];
$jenis_pasien = $data['jenis_pasien'];
$agama = $data['agama'];
$dokter_pemeriksa = $data['dokter_pemeriksa'];
$tanggal_daftar = $data['tanggal_daftar'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $nama ?></td>
                            <td><?php echo $no_reg ?></td>
                            <td><?php echo $jenis_kelamin ?></td>
                            <td><?php echo $umur ?></td>
                            <td><?php echo $tanggal_lahir ?></td>
							<td><?php echo $tempat_lahir ?></td>
                            <td><?php echo $nama_kk ?></td>
                            <td><?php echo $alamat ?></td>
                            <td><?php echo $jenis_pasien ?></td>
                            <td><?php echo $agama ?></td>
							<td><?php echo $dokter_pemeriksa ?></td>
                            <td><?php echo $tanggal_daftar ?></td>
                        </tr>
	<?php $no++; } ?>                                                
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>	
        <script src="table/jquery-1.11.1.min.js"></script>
        <script src="table/bootstrap.min.js"></script>
        <script src="table/jquery.dataTables.min.js"></script>
        <script src="table/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script>
    </body>
</html>