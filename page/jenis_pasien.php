<?php 
				
$sql="select id,jenis from jenis_pasien";
$query=mysql_query($sql); 

if(isset($_POST['tambah']))
{
	$kode=substr($_POST['jenis'],0,3);
	mysql_query("insert into jenis_pasien (jenis,kode) values (upper('".$_POST['jenis']."'),upper('".$kode."'))");
	echo "<script language=javascript>parent.location.href='home.php?ref=jenis_pasien';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['update']))
{
	$code=substr($_POST['jenis'],0,3);
	mysql_query("UPDATE jenis_pasien SET  jenis = upper('".$_POST['jenis']."'), kode = upper('".$code."') WHERE id = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=jenis_pasien';</script>";
	writeMsg('update.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM jenis_pasien WHERE ID = '".$_POST['id']."'");
echo "<script language=javascript>parent.location.href='home.php?ref=jenis_pasien';</script>";
}	
?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Jenis Pasien</h3><br>
			<button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_jenis_pasien"><span class="glyphicon glyphicon-plus"></span> Add New </button>
<br><br>
       <div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width='10'>No</th>
                            <th>Jenis Pasien</th>
							<th width="50">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$jenis = $data['jenis'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $jenis?></td>
							<td align="center">
									<button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_jenis_pasien" data-id="<?php echo $id ?>" data-jenis="<?php echo $jenis ?>"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_jenis_pasien" data-id="<?php echo $id ?>" data-jenis="<?php echo $jenis ?>"><span class="glyphicon glyphicon-remove"></span></button>
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