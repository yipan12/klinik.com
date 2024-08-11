<?php 

$sql="SELECT id,kode,nama_paket,parameter,biaya FROM paket_pemeriksaan";
$query=mysql_query($sql);

if(isset($_POST['tambah']))
{
	$parameter=implode(",",$_POST['parameter_ujis']);

	$sql= mysql_query("insert into paket_pemeriksaan (kode,nama_paket,parameter,biaya) values (upper('".$_POST['kode']."'),upper('".$_POST['nama_paket']."'),'".$parameter."','".$_POST['biaya']."')");
	//DUMMBY QUERY
	$m=mysql_query("select nama_paket,kode,parameter from paket_pemeriksaan");
	while ($rw=mysql_fetch_array($m)) {
	$reg=$rw['kode'];
	$para = explode(',',$rw['parameter']);
	$pp = count($para);
	$indeks=0; 
	while($indeks < count($para)){ 
	$sql1="insert ignore paket_filter (parameter,kode) values ('".$para[$indeks]."','".$reg."')";
	$query1=mysql_query($sql1);
	$indeks++; 
	}}
	//DUMMBY QUERY	
	$sql=mysql_query("UPDATE paket_filter a,parameter_uji b SET a.biaya=b.biaya WHERE a.parameter=b.sub_kode");
	
	$sql=mysql_query("DROP TABLE IF EXISTS paket_total");
	$sql=mysql_query("DROP TABLE IF EXISTS paket_nama");
	$sql=mysql_query("create table paket_total SELECT kode,SUM(biaya)total FROM paket_filter GROUP BY kode");
	$sql=mysql_query("CREATE TABLE paket_nama SELECT a.kode,a.parameter,b.nama_parameter FROM paket_filter a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode");
	echo "<script language=javascript>parent.location.href='home.php?ref=paket_pemeriksaan';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['update']))
{
	$parameter=implode(",",$_POST['parameter_ujis']);

	$sql= mysql_query("update paket_pemeriksaan set nama_paket=upper('".$_POST['nama']."') ,biaya='".$_POST['biaya']."', parameter='".$parameter."' where kode='".$_POST['kode']."'");
	//DUMMBY QUERY
	$mm=mysql_query("delete from paket_filter");
	$m=mysql_query("select nama_paket,kode,parameter from paket_pemeriksaan");
	while ($rw=mysql_fetch_array($m)) {
	$reg=$rw['kode'];
	$para = explode(',',$rw['parameter']);
	$pp = count($para);
	$indeks=0; 
	while($indeks < count($para)){ 
	$sql1="insert ignore paket_filter (parameter,kode) values ('".$para[$indeks]."','".$reg."')";
	$query1=mysql_query($sql1);
	$indeks++; 
	}}
	//DUMMBY QUERY	
	$sql=mysql_query("DROP TABLE IF EXISTS paket_nama");
	$sql=mysql_query("CREATE TABLE paket_nama SELECT a.kode,a.parameter,b.nama_parameter FROM paket_filter a LEFT JOIN parameter_uji b ON (a.parameter)=b.sub_kode");
	echo "<script language=javascript>parent.location.href='home.php?ref=paket_pemeriksaan';</script>";
	writeMsg('save.sukses');
}
elseif(isset($_POST['hapus']))
{
	mysql_query("DELETE FROM paket_pemeriksaan WHERE ID = '".$_POST['id']."'");
	mysql_query("DELETE FROM paket_filter WHERE kode = '".$_POST['kode']."'");
	mysql_query("DELETE FROM paket_nama WHERE kode = '".$_POST['kode']."'");
	mysql_query("DELETE FROM paket_total WHERE kode = '".$_POST['kode']."'");
	echo "<script language=javascript>parent.location.href='home.php?ref=paket_pemeriksaan';</script>";
}
?> 
    <body>
        <div class="container">
            <h3 class="text-center">Paket Pemeriksaan</h3><br>
			<button type="button" class="btn btn-default btn-sm btn-success" style="float:right;" data-toggle="modal" data-target="#modal_add_paket_pemeriksaan"><span class="glyphicon glyphicon-plus"></span> Add New </button>
<br><br>
            <div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
							<th width="80">Kode Paket</th>
							<th>Nama Paket</th>
                            <th>Parameter Uji</th>
							<th width="80">Biaya</th>
							<th width="50">Action</th>
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			
$id = $data['id'];
$kode = $data['kode'];
$nama_paket = $data['nama_paket'];
$parameter = $data['parameter'];
$biaya = $data['biaya'];
$sql2=mysql_query("SELECT GROUP_CONCAT(' ',nama_parameter,' ') nama_parameter FROM paket_nama WHERE kode='".$kode."'");
$row=mysql_fetch_assoc($sql2);  
$nama_parameter=$row['nama_parameter'];
  ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
							<td><?php echo $kode ?></td>
                            <td><?php echo $nama_paket ?></td>
                            <td><?php echo $nama_parameter ?></td>
							<td><?php echo "  Rp ".number_format($biaya,0,'.','.') ?></td>
							<td align="center">
									<a name="update" href="home.php?ref=edit_paket&id=<?php echo $data['id']."&kode=".$data['kode']; ?>" class="btn btn-default btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> 
									<!--button type="button" class="btn btn-default btn-sm btn-primary" data-toggle="modal" data-target="#modal_edit_paket_pemeriksaan" data-id="<?php echo $id ?>" data-kode="<?php echo $kode ?>" data-nama_paket="<?php echo $nama_paket ?>" data-biaya="<?php echo $biaya ?>"><span class="glyphicon glyphicon-pencil"></span></button-->
									<button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_paket_pemeriksaan" data-id="<?php echo $id ?>" data-nama_paket="<?php echo $nama_paket ?>" data-kode="<?php echo $kode ?>"><span class="glyphicon glyphicon-remove"></span></button>
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