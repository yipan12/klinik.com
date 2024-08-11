<div class="container">
<div class="">
<h3 class="text-center">Tambah Pasien</h3><br><br>
</div>

<div class="row">
	<div class="col-md-6">
    
	<form id="form_input" method="POST">	

<?php  
include ('../libs/koneksi.php');
$kunjungan="kunjungan";

$query = "SELECT max(id_pasien) as maxID FROM ". $kunjungan." where tanggal='".date('Y-m-d')."'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$idMax = $data['maxID'];
$noUrut = (int) substr($idMax, 7, 7);
//echo $query;
$noUrut++;
$char = "PSN";
$newID = $char . sprintf("%07s", $noUrut);


if(isset($_POST['simpan']))
{
$parameter=implode(",",$_POST['parameter_ujis']);

	$sql="INSERT INTO ". $kunjungan ." (kode,tanggal,id_pasien,nama,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,jenis_pasien,alamat,no_telp,dokter_pemeriksa,alamat_dokter,no_telp_dokter,nama_kontak,alamat_kontak,no_telp_kontak,parameter_uji,`load`) VALUES ('".$_POST['kode']."','".$_POST['tanggal']."','".$_POST['id_pasien']."','".$_POST['nama']."','".$_POST['tempat_lahir']."','".$_POST['tanggal_lahir']."','".$_POST['jenis_kelamin']."','".$_POST['pekerjaan']."','".$_POST['jenis_pasien']."','".$_POST['alamat']."','".$_POST['no_telp']."','".$_POST['nama_dokter']."','".$_POST['alamat_dokter']."','".$_POST['no_telp_dokter']."','".$_POST['nama_kontak']."','".$_POST['alamat_kontak']."','".$_POST['no_telp_kontak']."','".$parameter."','Y')";
	$query=mysql_query($sql);
	//echo $sql;
	writeMsg('save.sukses');
}
?>
<table width="1100" border="0">
<tr>
	<td width="525"><div class="form-group">
  		<label class="control-label" for="tanggal">Tanggal </label>
  		<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d') ?>" readonly="readonly" >
	</div>
    </td>
	<td width="535"><div class="form-group">
	  <label class="control-label" for="nama_kontak">Nama Kontak </label>
	  <input type="text" class="form-control" name="nama_kontak" id="nama_kontak"  >
	  </div>
	  </td>
</tr>
<tr>
	<td><div class="form-group">
  		<label class="control-label" for="id_pasien">ID Pasien </label>
  		<input name="id_pasien" type="text" required class="form-control" id="id_pasien" value="<?php echo $newID;   ?>"  readonly="readonly" >
  		<input  name="kode" type="hidden" class="form-control" id="kode" value="<?php $thn=substr(date('Y'),3,1); echo $thn; echo date('mdHis')   ?>"  readonly="readonly" >
	</div>
	</td>
	<td><div class="form-group">
	  <label class="control-label" for="alamat_kontak">Alamat Kontak </label>
	  <textarea type="text" class="form-control" name="alamat_kontak" id="alamat_kontak" ></textarea>
	  </div></td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="nama">Nama </label>
  		<input type="text" class="form-control" name="nama" id="nama"  required>
	</div>
    </td>
    <td><div class="form-group">
      <label class="control-label" for="no_telp_kontak">No Telepon </label>
      <input type="text" class="form-control" name="no_telp_kontak" id="no_telp_kontak" >
    </div></td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="tempat_lahir">Tempat Lahir </label>
  		<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="tanggal_lahir">Tanggal Lahir </label>
		 <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="btn2" data-link-format="dd-mm-yyyy">
                    <input class="form-control" size="10" type="text" name="tanggal_lahir" required>
     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
         </div>
    <input type="hidden" id="btn2" value=""/>
  		<!--input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"-->
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="jenis_kelamin">Jenis Kelamin </label>
  		<!--input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin"-->
		<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="tidak di pilih" selected="selected"> Pilih Jenis Kelamin</option>
				<option value="laki-laki">Laki-Laki</option>
				<option value="perempuan">Perempuan</option>
        </select>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="pekerjaan">Pekerjaan </label>
  		<!--input type="text" class="form-control" name="pekerjaan" id="pekerjaan"-->
		<select name="pekerjaan" class="form-control" required >
        <option>Pilih Pekerjaan</option>
        <?php
		$sql=mysql_query("select * from pekerjaan ");
		while($data=mysql_fetch_array($sql, MYSQL_BOTH )){
		echo "<option value=$data[nama]>";
		echo "".$data[nama]."";
		} 	 
		
		?>
		</select>   
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="jenis_pasien">Jenis Pasien </label>
  		<!--input type="text" class="form-control" name="jenis_pasien" id="jenis_pasien"-->
		<select name="jenis_pasien" class="form-control" required>
        <option>Pilih Jenis Pasien</option>
        <?php
		$sql=mysql_query("select * from jenis_pasien ");
		while($data=mysql_fetch_array($sql, MYSQL_BOTH )){
		echo "<option value=$data[jenis]>";
		echo "".$data[jenis]."";
		} 	 
		
		?>
		</select>   
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="alamat">Alamat </label>
  		<textarea type="text" class="form-control" name="alamat" id="alamat" required></textarea>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="no_telp">No Telepon </label>
  		<input type="text" class="form-control" name="no_telp" id="no_telp" required>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="nama_dokter">Nama Dokter </label>
  		<input type="text" class="form-control" name="nama_dokter" id="nama_dokter" required>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="alamat_dokter">Alamat Dokter </label>
  		<textarea type="text" class="form-control" name="alamat_dokter" id="alamat_dokter" required></textarea>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
    <div class="form-group">
  		<label class="control-label" for="no_telp_dokter">No Telepon </label>
  		<input type="text" class="form-control" name="no_telp_dokter" id="no_telp_dokter" required>
	</div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#parameter_uji" role="tab" data-toggle="tab">Parameter Uji</a></li>
    <li><a href="#paket" role="tab" data-toggle="tab">Paket</a></li>
  </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="parameter_uji">
    

	
	<div class="panel-group">
    <div class="panel panel-default">
      <!--div class="panel-heading"-->
      <?php
			$s=mysql_query("select nama from kelompok_parameter_uji");
			while ($d=mysql_fetch_array($s)) {
			//echo "<option class=uji value=$d[nama]>";
			//echo "".$data[nama].""; 
			$t=$d['nama'];
			
			}
	  
		  echo "<select multiple=multiple  id=selectlist name=parameter_ujis[]>";
            	echo"<optgroup label=$t;  >";
				
								$sql=mysql_query("select sub_kode,nama_parameter from parameter_uji");
								while ($data=mysql_fetch_array($sql)) {
								echo "<option class=uji value=$data[sub_kode]>";
								echo "".$data[nama_parameter].""; 
				}
				?>
				</optgroup>
				
            </select>
			
     
		
		<!--div id="collapse1" class="panel-collapse collapse">
	  
			
		
      </div-->
		
	  
    </div>
  </div>
	
	
	
          </div>
        <div class="tab-pane" id="paket">
          <div class="example">
                                        
                                        <select id="selectlist" multiple="multiple">
                                            <option value="1">OpTiOn 1</option>
                                            <option value="2">OpTiOn 2</option>
                                            <option value="3">OpTiOn 3</option>
                                            <option value="4">OpTiOn 4</option>
                                            <option value="5">OpTiOn 5</option>
                                            <option value="6">OpTiOn 6</option>
                                            <option value="7">OpTiOn 7</option>
                                            <option value="8">OpTiOn 8</option>
                                            <option value="9">OpTiOn 9</option>
                                            <option value="10">OpTiOn 10</option>
                                            <option value="11">OpTiOn 11</option>
                                            <option value="12">OpTiOn 12</option>
                                            <option value="13">OpTiOn 13</option>
                                            <option value="14">OpTiOn 14</option>
                                            <option value="15">OpTiOn 15</option>
                                        </select>
                                    </div>
          </div>
		  
        </div>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2" align="center">&nbsp;</td>
</tr>
<tr>
    <td colspan="2" align="center">
      <div class="form-group">
        <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
        <input type="reset" value="Reset" class="btn btn-danger">
        </div>
    </td>
    </tr>
    </table>
	</form>
	</div>
</div>
</div>
<!--script src="../libs/jquery.min.js"></script-->
<!-- Load Bootstrap JS -->
<!--script src="../libs/bootstrap.min.js"></script-->
<!-- Load jQuery Validator -->
<!--script src="../libs/jquery.validate.min.js"></script-->
<!--script src="../libs/additional-methods.min.js"></script-->
<!--script>
$("#form_input").validate();
</script-->
