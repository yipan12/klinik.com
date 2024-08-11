<?php 
					
$sql="select a.id,a.kode,a.id_pasien,a.nama,a.alamat,a.tempat_lahir,a.tanggal_lahir,b.nama_pekerjaan,a.no_telp from pasien a left join pekerjaan b on (a.pekerjaan)=b.kode";
$query=mysql_query($sql); 

if(isset($_POST['tambah']))
{
	
	
}
elseif(isset($_POST['update']))
{
	mysql_query("UPDATE pasien SET id_pasien = '".$_POST['id_pasien']."',nama = '".$_POST['nama_pasien']."',alamat = '".$_POST['alamat']."', tempat_lahir = '".$_POST['tempat_lahir']."',tanggal_lahir = '".$_POST['tanggal_lahir']."', pekerjaan = '".$_POST['pekerjaan']."', no_telp = '".$_POST['no_telp']."' WHERE id = '".$_POST['id']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=pasien';</script>";
	writeMsg('update.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM pasien WHERE ID = '".$_POST['id']."'");
	mysql_query("DELETE FROM dokter WHERE ID = '".$_POST['id']."'");
	mysql_query("DELETE FROM pemeriksaan WHERE kode = '".$_POST['kode']."'");
	mysql_query("DELETE FROM parameter_pasien WHERE kode = '".$_POST['kode']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=pasien';</script>";
}	
?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Pasien</h3><br>
			<a href="home.php?ref=input_registrasi" class="btn btn-default btn-sm btn-success" style="float:right;"><span class="glyphicon glyphicon-plus"></span> Add New</a>
			<!--button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_pasien"><span class="glyphicon glyphicon-plus"></span> Add New </button-->
<br><br>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th>ID Pasien</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<th>Pekerjaan</th>
							<th>No Telepon</th>
							<th width="90">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$kode = $data['kode'];
$id_pasien = $data['id_pasien'];
$nama_pasien = $data['nama'];
$alamat = $data['alamat'];
$tempat_lahir = $data['tempat_lahir'];
$tanggal_lahir = $data['tanggal_lahir'];
$pekerjaan = $data['nama_pekerjaan'];
$no_telp = $data['no_telp'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $id_pasien ?></td>
							<td><?php echo $nama_pasien ?></td>
                            <td><?php echo $alamat ?></td>
							<td><?php echo $tempat_lahir ?></td>
                            <td><?php echo $tanggal_lahir ?></td>
							<td><?php echo $pekerjaan ?></td>
                            <td><?php echo $no_telp ?></td>
							<td align="center">
									<a name="update" href="home.php?ref=add_pemeriksaan&id=<?php echo $data['id']."&kode=".$data['kode']; ?>" class="btn btn-default btn-sm btn-warning"><span class="glyphicon glyphicon-search"></span></a> 
									<a name="update" href="home.php?ref=edit_pasien&id=<?php echo $data['id']."&kode=".$data['kode']; ?>" class="btn btn-default btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> 
									<!--button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_pasien" data-id="<?php echo $id ?>" data-id_pasien="<?php echo $id_pasien ?>" data-nama_pasien="<?php echo $nama_pasien ?>" data-alamat="<?php echo $alamat ?>" data-tempat_lahir="<?php echo $tempat_lahir ?>" data-tanggal_lahir="<?php echo $tanggal_lahir ?>" data-pekerjaan="<?php echo $pekerjaan ?>" data-no_telp="<?php echo $no_telp ?>"><span class="glyphicon glyphicon-pencil"></span></button-->
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_pasien" data-id="<?php echo $id ?>" data-nama_pasien="<?php echo $nama_pasien ?>"><span class="glyphicon glyphicon-remove"></span></button>
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