<?php 
					
	$sql="select id,sub_kode,nama_parameter,satuan,metode,batas_normal,biaya from parameter_uji";
	$query=mysql_query($sql); 
	
if(isset($_POST['tambah']))
{
	$query = mysql_query("SELECT max(sub_kode) as maxID FROM parameter_uji where kode='".$_POST['kode']."'");
	$data  = mysql_fetch_assoc($query);
	$idMax = $data['maxID'];
	$noUrut =substr($idMax, 4, 3);
	$noUrut++;
	$char = $_POST['kode']."-";
	$new = $char . sprintf("%03s", $noUrut);
	//echo $newID;
	$cek=substr($new,4,3);
	//echo $cek;
	if($cek == 000) 
	{
	$newID = $char . sprintf("%03s", $noUrut+1);
	}
	else
	{
	$newID = $char . sprintf("%03s", $noUrut);
	} 
	$nama_parameter=mysql_real_escape_string($_POST['nama_parameter']);
	mysql_query("insert into parameter_uji (kode,sub_kode,nama_parameter,satuan,metode,batas_normal,biaya) values ('".$_POST['kode']."','".$newID."','".$nama_parameter."','".$_POST['satuan']."','".$_POST['metode']."','".$_POST['batas_normal']."','".$_POST['biaya']."')");
	echo "<script language=javascript>parent.location.href='home.php?ref=parameter_uji';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['update']))
{
	$nama_parameter=mysql_real_escape_string($_POST['nama_parameter']);
	mysql_query("UPDATE parameter_uji SET  nama_parameter = '".$nama_parameter."',satuan = '".$_POST['satuan']."', metode = '".$_POST['metode']."',batas_normal = '".$_POST['batas_normal']."', biaya = '".$_POST['biaya']."' WHERE id = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=parameter_uji';</script>";
	writeMsg('update.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM parameter_uji WHERE ID = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=parameter_uji';</script>";
}
?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Parameter Uji</h3><br>
			<button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_parameter_uji"><span class="glyphicon glyphicon-plus"></span> Add New </button>
<br><br>

            <div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
							<th width="50">Kode</th>
                            <th>Nama Parameter</th>
							<th>Satuan</th>
							<th>Metode</th>
							<th>Batas Normal</th>
							<th width="60">Biaya</th>
							<th width="50">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$sub_kode = $data['sub_kode'];
$nama = $data['nama_parameter'];
$satuan = $data['satuan'];
$metode = $data['metode'];
$batas_normal = $data['batas_normal'];
$biaya = $data['biaya'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
							<td><?php echo $sub_kode ?></td>
							<td><?php echo $nama ?></td>
                            <td><?php echo $satuan ?></td>
							<td><?php echo $metode ?></td>
                            <td><?php echo $batas_normal ?></td>
							<td><?php echo "Rp ".number_format($biaya,0,'.','.') ?></td>
							<td align="center">
									<button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_parameter_uji" data-id="<?php echo $id ?>" data-sub_kode="<?php echo $sub_kode ?>" data-nama_parameter="<?php echo $nama ?>" data-satuan="<?php echo $satuan ?>" data-metode="<?php echo $metode ?>" data-batas_normal="<?php echo $batas_normal ?>" data-biaya="<?php echo $biaya ?>"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_parameter_uji" data-id="<?php echo $id ?>" data-nama="<?php echo $nama ?>"><span class="glyphicon glyphicon-remove"></span></button>
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