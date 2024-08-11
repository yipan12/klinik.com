<?php 
					
$sql="select id,dokter_pemeriksa,alamat_dokter,no_telp_dokter from pasien";
$query=mysql_query($sql); ?>    
    
    <body>
        <div class="container">
            <h3 class="text-center">Data Dokter Pengirim</h3><br>
<br>

            <div class="">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                     		<th width="10">No</th>
                            <th>Nama Dokter</th>
							<th>Alamat</th>
                            <th>No Telepon</th>
							<!--th width="100">Action</th-->
                    </tr>
                    </thead>
                    <tbody>
 
<?php $no=1;	while ($data=mysql_fetch_array($query)) {			

$nama = $data['dokter_pemeriksa'];
$alamat = $data['alamat_dokter'];
$no_telp = $data['no_telp_dokter'];

   ?>               
                    
                        <tr>
                        	<td><?php echo $no ?></td>
                            <td><?php echo $nama ?></td>
							<td><?php echo $alamat ?></td>
							<td><?php echo $no_telp ?></td>
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