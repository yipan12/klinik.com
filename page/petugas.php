<?php 
					
$sql="select id,nama from petugas";
$query=mysql_query($sql); 

if(isset($_POST['tambah']))
{
	$code=substr($_POST['nama_petugas'],0,3);
	mysql_query("insert into petugas (nama,kode) values (upper('".$_POST['nama_petugas']."'),upper('".$code."'))");
	echo "<script language=javascript>parent.location.href='home.php?ref=petugas';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['update']))
{
	$code=substr($_POST['nama_petugas'],0,3);
	mysql_query("UPDATE petugas SET  nama = upper('".$_POST['nama_petugas']."'),kode = upper('".$code."') WHERE id = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=petugas';</script>";
	writeMsg('update.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM petugas WHERE ID = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=petugas';</script>";
}	
?>     
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Petugas</h3><br>
			<button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_petugas"><span class="glyphicon glyphicon-plus"></span> Add New </button>
<br><br>

            <div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th>Petugas</th>
							<th width="50">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$nama_petugas = $data['nama'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $nama_petugas ?></td>
							<td align="center">
									<button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_petugas" data-id="<?php echo $id ?>" data-nama_petugas="<?php echo $nama_petugas ?>"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_petugas" data-id="<?php echo $id ?>" data-nama_petugas="<?php echo $nama_petugas ?>"><span class="glyphicon glyphicon-remove"></span></button>
							</td>
                        </tr>
	<?php $no++; } ?>                                                
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>	
    </body>
</html>