<html>
    <head>
        <title>Laporan Rekapitulasi</title>
        <!--link rel="stylesheet" href="../libs/bootstrap.min.css"-->	
        <!--link rel="stylesheet" href="../libs/dataTables.bootstrap.css"-->
    </head>
<?php 
include ('../libs/koneksi.php');

					
	
	if(isset($_POST['tanggal']) AND ($_POST['periode']=="semua"))
{	
	$sql="SELECT COUNT(a.parameter)jumlah,a.parameter,b.nama_parameter FROM pemeriksaan a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode GROUP BY a.parameter ORDER BY jumlah DESC LIMIT 10";
	$query=mysql_query($sql); 
	$cek=$_POST['periode'];
	
}	elseif(isset($_POST['tanggal']) AND ($_POST['periode']=="harian"))
{
	$sql="SELECT COUNT(a.parameter)jumlah,a.parameter,b.nama_parameter FROM pemeriksaan a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode where a.tanggal='".$_POST['tanggal']."' GROUP BY a.parameter ORDER BY jumlah DESC LIMIT 10";
	$query=mysql_query($sql); 
	$cek=$_POST['tanggal'];
	
} elseif (isset ($_POST['tanggal']) AND ($_POST['periode']=="bulanan")) 
{
	$bln=substr($_POST['tanggal'],5,2);
	$thn=substr($_POST['tanggal'],0,4);
	$sql="SELECT COUNT(a.parameter)jumlah,a.parameter,b.nama_parameter FROM pemeriksaan a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode WHERE MONTH(tanggal)='".$bln."' AND YEAR(tanggal)='".$thn."' GROUP BY a.parameter ORDER BY jumlah DESC LIMIT 10";
	$query=mysql_query($sql); 
	$cek=$_POST['periode']." (".$bln." - ".$thn.")";	
		
} elseif (isset ($_POST['tanggal']) AND ($_POST['periode']=="tahunan")) 
{
	$thn=substr($_POST['tanggal'],0,4);
	$sql="SELECT COUNT(a.parameter)jumlah,a.parameter,b.nama_parameter FROM pemeriksaan a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode WHERE  YEAR(tanggal)='".$thn."' GROUP BY a.parameter ORDER BY jumlah DESC LIMIT 10";
	$query=mysql_query($sql); 
	
	$cek=$_POST['periode']." (".$thn.")";
}
	
	?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Laporan 10 Besar Pemeriksaan</h3><br>
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
            <div class="">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th>Nama Pemeriksaan</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$nama = $data['nama_parameter'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $nama ?></td>
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