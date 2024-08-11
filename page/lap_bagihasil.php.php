<html>
    <head>
        <title>judul</title>
        <!--link rel="stylesheet" href="../libs/bootstrap.min.css"-->	
        <!--link rel="stylesheet" href="../libs/dataTables.bootstrap.css"-->
    </head>
<?php 
include ('../libs/koneksi.php');

					
	$sql="select id,kode,nama from kelompok_parameter_uji";
	$query=mysql_query($sql); ?>    
    
    <body>
        <div class="container">
		
            <h3 class="text-center">Laporan Bagi Hasil</h3><br>
			<a href="home.php?ref=add_kelompok_parameter_uji" class="btn btn-default btn-sm btn-success" style="float:right;"><span class="glyphicon glyphicon-plus"></span> Add New</a>
<br><br><br>

			<div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
							<th>Kode</th>
                            <th>Nama Kelompok</th>
							<th width="100">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$kode = $data['kode'];
$nama = $data['nama'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
							<td><?php echo $kode ?></td>
                            <td><?php echo $nama ?></td>
							<td align="center">
									<a name="update" href="home.php?ref=edit_kelompok_parameter_uji&id=<?php echo $data['id']; ?>" class="btn btn-default btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> 
									
									<a name="delete" href="home.php?ref=del_kelompok_parameter_uji&id=<?php echo $data['id']; ?>" onclick ="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;"class="btn btn-default btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
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