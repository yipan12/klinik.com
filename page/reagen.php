<?php 
					
$sql="SELECT a.id,a.kode_reagen,a.nama_reagen,a.bentuk,a.stock,b.kode_parameter FROM reagen a left join reagen_parameter_array b on (a.kode_reagen)=b.kode_reagen";
$query=mysql_query($sql); 

if(isset($_POST['tambah']))
{
$query = "SELECT max(kode_reagen) as maxID FROM reagen ";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$idMax = $data['maxID'];
$noUrut =substr($idMax, 4,3);
$noUrut++;
$char = "REA-";
$new = $char . sprintf("%03s", $noUrut);
$cek=substr($new,4,3);
if($cek == 000) 
{
$newID = $char . sprintf("%03s", $noUrut+1);
}
else
{
$newID = $char . sprintf("%03s", $noUrut);
} 
	mysql_query("insert into reagen (kode_reagen,nama_reagen,bentuk) values (upper('".$newID."'),'".$_POST['nama_reagen']."',upper('".$_POST['bentuk']."'))");
	echo "<script language=javascript>parent.location.href='home.php?ref=reagen';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['update']))
{
	mysql_query("UPDATE reagen SET  nama_reagen = '".$_POST['nama_reagen']."',bentuk = upper('".$_POST['bentuk']."') WHERE id = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=reagen';</script>";
	writeMsg('update.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM reagen WHERE ID = '".$_POST['id']."'");
	mysql_query("DELETE FROM reagen_parameter WHERE kode_reagen='".$_POST['kode']."'");
	mysql_query("DELETE FROM reagen_parameter_array WHERE kode_reagen='".$_POST['kode']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=reagen';</script>";
}
?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Reagen</h3><br>
			<button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_reagen"><span class="glyphicon glyphicon-plus"></span> Add New </button>
<br><br>

            <div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th width="100">Kode Reagen</th>
                            <th>Nama Reagen</th>
                            <th>Bentuk</th>
                            <th width="100">Stock</th>
                            <th >Parameter</th>
							<th width="150">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$kode_reagen = $data['kode_reagen'];
$nama_reagen = $data['nama_reagen'];
$bentuk = $data['bentuk'];
$stock = $data['stock'];
$parameter = $data['kode_parameter'];
$sql1="SELECT group_concat(' [',b.nama_parameter,'] ')nama_parameter FROM reagen_parameter a LEFT JOIN parameter_uji b ON (b.sub_kode)=a.kode_parameter WHERE a.kode_reagen='".$kode_reagen."'";
$query1=mysql_query($sql1);
$row=mysql_fetch_assoc($query1);
$nama_parameter=$row['nama_parameter'];
  //echo $sql1;
  ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $kode_reagen ?></td>
                            <td><?php echo $nama_reagen ?></td>
                            <td><?php echo $bentuk ?></td>
                            <td><?php echo $stock ?></td>
                            <td><?php echo $nama_parameter  ?></td>
							<td align="center">
									<a name="set" href="home.php?ref=parameter_reagen&id=<?php echo $data['id']; ?>" class="btn btn-default btn-sm btn-success"><span class="glyphicon glyphicon-pushpin"></span></a>
							
									<a name="tambah" href="home.php?ref=stock_reagen&id=<?php echo $data['id']; ?>" class="btn btn-default btn-sm btn-warning"><span class="glyphicon glyphicon-plus"></span></a> 
									
									<button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_reagen" data-id="<?php echo $id ?>" data-nama_reagen="<?php echo $nama_reagen ?>" data-bentuk="<?php echo $bentuk ?>"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_reagen" data-id="<?php echo $id ?>" data-kode="<?php echo $kode_reagen ?>" data-nama_reagen="<?php echo $nama_reagen ?>" data-bentuk="<?php echo $bentuk ?>"><span class="glyphicon glyphicon-remove"></span></button>
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