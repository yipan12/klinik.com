<html>
    <head>
        <title>judul</title>
        <!--link rel="stylesheet" href="../libs/bootstrap.min.css"-->	
        <!--link rel="stylesheet" href="../libs/dataTables.bootstrap.css"-->
    </head>
<?php 
include ('../libs/koneksi.php');

					
	$sql="SELECT a.id,a.dokter_pemeriksa,a.kode,SUM(b.biaya)total,a.fee,c.tanggal,c.nama FROM dokter a LEFT JOIN pemeriksaan b ON (a.kode)=b.kode LEFT JOIN pasien c ON (a.kode)=c.kode GROUP BY a.kode
";
	$query=mysql_query($sql); ?>    
    
    <body>
        <div class="container">
		
            <h3 class="text-center">Laporan Bagi Hasil</h3><br>
			<!--a href="home.php?ref=add_kelompok_parameter_uji" class="btn btn-default btn-sm btn-success" style="float:right;"><span class="glyphicon glyphicon-plus"></span> Add New</a-->
<br><br><br>

			<div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
							<th>Nama Dokter</th>
                            <th>Kode Pemeriksaan</th>
                            <th>Total Pemeriksaan</th>
                            <th>Fee Dokter </th>
							<th width="100">Set Fee</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$dokter = $data['dokter_pemeriksa'];
$kode = $data['kode'];
$total = $data['total'];
$fee = $data['fee'];
$nama=$data['nama'];
$tanggal=$data['tanggal'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
							<td><?php echo $dokter ?></td>
                            <td><?php echo "<a href=home.php?ref=input_hasil&kode=".$kode."&tanggal=".$tanggal."&id_pasien=".$id_pasien."&nama=".$nama." target=_blank>".$kode."</a>"; ?></td>
                            <td><?php echo "  Rp ".number_format($total,0,'.','.')  ?></td>
                            <td><?php echo "  Rp ".number_format($fee,0,'.','.') ?></td>
							<td align="center">
									<a name="update" href="home.php?ref=set_feedokter&id=<?php  echo $data['id']; ?>" class="btn btn-default btn-sm btn-primary"><span class="glyphicon glyphicon-pushpin"></span></a> 
									
									<!--a name="delete" href="home.php?ref=del_kelompok_parameter_uji&id=<?php // echo $data['id']; ?>" onclick ="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;"class="btn btn-default btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a-->
							</td>
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