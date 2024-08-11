<html>
    <head>
        <title>judul</title>
        <!--link rel="stylesheet" href="../libs/bootstrap.min.css"-->	
        <!--link rel="stylesheet" href="../libs/dataTables.bootstrap.css"-->
    </head>
<?php 
include ('../libs/koneksi.php');

	if(isset($_POST['tanggal']) AND ($_POST['periode']=="semua"))
{	
	$sql="SELECT a.id,a.kode_reagen,a.nama_reagen,a.stock,SUM(b.jumlah)pemakaian FROM reagen a LEFT JOIN reagen_pakai b ON (a.kode_reagen)=b.kode_reagen GROUP BY a.kode_reagen";
	$query=mysql_query($sql); 
	$cek=$_POST['periode'];
	
}	elseif(isset($_POST['tanggal']) AND ($_POST['periode']=="harian"))
{
	$sql="SELECT a.id,a.kode_reagen,a.nama_reagen,a.stock,SUM(b.jumlah)pemakaian FROM reagen a LEFT JOIN reagen_pakai b ON (a.kode_reagen)=b.kode_reagen where b.tanggal='".$_POST['tanggal']."' GROUP BY a.kode_reagen";
	$query=mysql_query($sql); 
	$cek=$_POST['tanggal'];
	
} elseif (isset ($_POST['tanggal']) AND ($_POST['periode']=="bulanan")) 
{
	$bln=substr($_POST['tanggal'],5,2);
	$thn=substr($_POST['tanggal'],0,4);
	$sql="SELECT a.id,a.kode_reagen,a.nama_reagen,a.stock,SUM(b.jumlah)pemakaian FROM reagen a LEFT JOIN reagen_pakai b ON (a.kode_reagen)=b.kode_reagen  WHERE MONTH(tanggal)='".$bln."' AND YEAR(tanggal)='".$thn."' GROUP BY a.kode_reagen";
	$query=mysql_query($sql);
	$cek=$_POST['periode']." (".$bln." - ".$thn.")";	
		
} elseif (isset ($_POST['tanggal']) AND ($_POST['periode']=="tahunan")) 
{
	$thn=substr($_POST['tanggal'],0,4);
	$sql="SELECT a.id,a.kode_reagen,a.nama_reagen,a.stock,SUM(b.jumlah)pemakaian FROM reagen a LEFT JOIN reagen_pakai b ON (a.kode_reagen)=b.kode_reagen WHERE  YEAR(tanggal)='".$thn."' GROUP BY a.kode_reagen";
	$query=mysql_query($sql); 
	$cek=$_POST['periode']." (".$thn.")";
}				
	 ?>    
    
    <body>
        <div class="container">
		
            <h3 class="text-center">Laporan Reagen</h3><br>
<form id="form_input" method="POST">	
			 <table width="327" border="0">
            <tr>
            <td width="111">Periode</td>
            <td width="300">
            <select name="periode" class="form-control" id="periode">
			<option value="semua">Semua</option>
            <option value="harian">Harian</option>
            <option value="bulanan">Bulanan</option>
			<option value="tahunan">Tahunan</option>

            </select>
            </td>
            </tr>
            <tr>
            <td>Tanggal</td>
            <td><input type="text" class="form-control form_date " data-date-format="yyyy-mm-dd" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d'); ?>"></td>
            </tr>
            <tr>
              <td height="41">&nbsp;</td>
              <td><span class="form-group">
                <input type="submit" value="FILTER" name="filter" class="btn btn-primary">
              </span></td>
            </tr>
            </table>
			</form>
			<br><br>
			<div >Periode Data : <?php echo $cek ?></div><br>
			<div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
							<th>Kode Reagen</th>
							<th>Nama Reagen</th>
                            <th>Sisa Stock</th>
                            <th>Pemakaian</th>
							<!--th width="150">Action</th-->
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$kode_reagen = $data['kode_reagen'];
$nama = $data['nama_reagen'];
$stock = $data['stock'];
$pemakaian = $data['pemakaian'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
							<td><?php echo $kode_reagen ?></td>
							<td><?php echo $nama ?></td>
                            <td><?php echo $stock ?></td>
                            <td><?php echo $pemakaian ?></td>
							<!--td align="center">
									<a name="tambah" href="home.php?ref=&id=<?php  echo $data['id']; ?>" class="btn btn-default btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span></a> 
									
									<a name="kurang" href="home.php?ref=&id=<?php  echo $data['id']; ?>" onclick ="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;"class="btn btn-default btn-sm btn-warning"><span class="glyphicon glyphicon-minus"></span></a>
							
									<a name="update" href="home.php?ref=&id=<?php  echo $data['id']; ?>" class="btn btn-default btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> 
									
									<a name="delete" href="home.php?ref=&id=<?php  echo $data['id']; ?>" onclick ="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;"class="btn btn-default btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
							</td-->
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