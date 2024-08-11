<?php 
					
	$sql="select id,nama_pekerjaan from pekerjaan";
	$query=mysql_query($sql); 

if(isset($_POST['tambah']))
{
	$code=substr($_POST['nama_pekerjaan'],0,3);
	mysql_query("insert into pekerjaan (nama_pekerjaan,kode) values (upper('".$_POST['nama_pekerjaan']."'),upper('".$code."'))");
	echo "<script language=javascript>parent.location.href='home.php?ref=pekerjaan';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['update']))
{
	$code=substr($_POST['nama_pekerjaan'],0,3);
	mysql_query("UPDATE pekerjaan SET  nama_pekerjaan = upper('".$_POST['nama_pekerjaan']."'),kode = upper('".$code."') WHERE id = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=pekerjaan';</script>";
	writeMsg('update.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM pekerjaan WHERE ID = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=pekerjaan';</script>";
}	
?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Pekerjaan</h3><br>
			<button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_pekerjaan"><span class="glyphicon glyphicon-plus"></span> Add New </button>
<br><br>

            <div class="">
            <!--div class="box-body table-responsive"-->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th>Nama Pekerjaan</th>
							<th width="50">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$nama_pekerjaan = $data['nama_pekerjaan'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $nama_pekerjaan ?></td>
							<td align="center">
									<button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_pekerjaan" data-id="<?php echo $id ?>" data-nama_pekerjaan="<?php echo $nama_pekerjaan ?>"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_pekerjaan" data-id="<?php echo $id ?>" data-nama_pekerjaan="<?php echo $nama_pekerjaan ?>"><span class="glyphicon glyphicon-remove"></span></button>
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
