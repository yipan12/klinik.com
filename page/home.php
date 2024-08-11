<?php 
session_start();
include ('../libs/koneksi.php');
$ar=array('ADMIN','USER');
$sql=mysql_query("Select * from user");
$data=mysql_fetch_array($sql);  
$sql1=mysql_query("Select COUNT(kode)jumlah_pasien from pasien WHERE tanggal='".date('Y-m-d')."'");
$data1=mysql_fetch_array($sql1);
$sql2=mysql_query("SELECT * FROM pemeriksaan  WHERE tanggal='".date('Y-m-d')."' GROUP BY kode");
$jumlah_pemeriksaan=mysql_num_rows($sql2);
?> 
<link href="../libs/bootstrap.min.css" rel="stylesheet">
<link href="../libs/style.css" rel="stylesheet">



<div id="chrtbar" class="kiri" ></div>
<table id="chrt" hidden="">
	<thead>
		<tr>
			<th></th>
			<th>Jumlah Pasien</th>
			<th>Jumlah Pemeriksaan</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Januari</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Februari</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>April</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Mei</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Juni</th>
			<td>2</td>
			<td>0</td>
		</tr>
		<tr>
			<th>Juli</th>
			<td>5</td>
			<td>11</td>
		</tr>
		<tr>
			<th>Agustus</th>
			<td>1</td>
			<td>1</td>
		</tr>
		<tr>
			<th>September</th>
			<td>2</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Oktober</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>November</th>
			<td>3</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Desember</th>
			<td>3</td>
			<td>4</td>
		</tr>
	</tbody>
</table>


<div class="kanan"><div class="panel-heading" style="text-align:center"><a href="#" class="list-group-item active">Information <?php echo $_SESSION['username']; ?></a>
<ul class="list-group"> 
   <li class="list-group-item" style="text-align:left;">Nama : <strong><?php  echo $data['username']; ?></strong></li>
   <li class="list-group-item" style="text-align:left;">Level : <strong><?php  echo $data['level']; ?></strong> </li> 
   <li class="list-group-item" style="text-align:left;">Pasien Hari Ini : <strong><?php  echo $data1['jumlah_pasien']; ?></strong></li>
   <li class="list-group-item" style="text-align:left;">Pemeriksaan Hari Ini : <strong><?php  echo $jumlah_pemeriksaan; ?></strong></li>
   <br />
   <br />
   <li class="list-group-item list-group-item-info" style="text-align:center;"><a href="logout.php">Logout</a></li>  
</ul>

</div></div>

				
<!--script src="../libs/jquery.min.js" type="text/javascript"></script-->
<!--script src="http://code.highcharts.com/highcharts.js"></script-->
<!--script src="http://code.highcharts.com/modules/data.js"></script-->
<!--script type="text/javascript">
	var $nocon = jQuery.noConflict();
		$nocon(function () {
    $nocon('#chrtbar').highcharts({
        data: {
            table: 'chrt'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: 'Data extracted from a HTML table in the page'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
	</script-->
