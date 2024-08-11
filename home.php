<!DOCTYPE html>
<html lang="en">
<?php
$today = date("j-n-Y");
$cbulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$cnobl  = array("01","02","03","04","05","06","07","08","09","10","11","12");
$nthm = date("Y") - 10;
$ntha = date("Y") + 10;
$nthini = date("Y");
$ntgini = date("j") -1 ;
?>
<style>
.form1 {
padding:3px;height:30px;width:70px;border:1px solid grey;
}
</style>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laboratorium Klinik </title>

    <!-- Import Library -->
	<link href="libs/bootstrap.min.css" rel="stylesheet">
	<link href="libs/bootstrap-multiselect.css" rel="stylesheet">
	<link href="libs/style.css" rel="stylesheet">
    <link href="libs/dataTables.bootstrap.css" rel="stylesheet">
	<link href="libs/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="libs/chosen.css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 
    
    <body class="pushmenu-push">
    <?php 
	#import koneksi header dan sidebar
		include ('libs/koneksi.php');
		include ('libs/alerts.php');
		include ('page/modal.php');
		include_once ('navbar.php'); 
     	include_once ('header.php'); 
     	//include_once ('body.php'); 
	?>
	<div class="container">
	<div class="main">
	<section class="buttonset">
	<div id="nav_list">Menu</div>
	</section>
	<section class="content">
            	
          
    <?php
	#fungsi menu simple
			error_reporting(0);
			$pages_dir='page'; //value directory
			if(!empty($_GET['ref'])) { //kalo ga kosong ambil link page
			$pages = scandir($pages_dir, 0); //scan directory
			unset($pages[0],$pages[1]); // hapus index[0](.) , hapus index[1] (..)
			$ref = $_GET['ref']; //link page
			if(in_array($ref.'.php',$pages)) {  //pencocokan data link page dan directory
				include($pages_dir.'/'.$ref.'.php'); //excute
			} else {
			echo 'halaman tidak di temukan'; }
			} else {
			/*include('body.php'); */ }
	 ?>
     
	</section>
		<!-- End Content -->
	</div>
        <!-- End Main -->
	</div>
    	<!-- End Container -->

    <!-- Import Library  -->
    <script src="libs/jquery.min.js"></script>
    <script src="libs/bootstrap.min.js"></script>
	<script src="libs/jquery.dataTables.min.js"></script>
    <script src="libs/dataTables.bootstrap.js"></script>	
    <script src="libs/jquery.validate.min.js"></script>
	<script src="libs/additional-methods.min.js"></script>
	<script src="libs/bootstrap-datetimepicker.js"></script>
	<script src="libs/bootstrap-multiselect.js"></script>
	
	<script src="libs/highcharts.js"></script>
	<script src="libs/data.js"></script>
	<script src="libs/chosen.jquery.js" type="text/javascript"></script>

<script>
var $pars = jQuery.noConflict();
$pars('#modal_edit_kelompok_parameter_uji').on('show.bs.modal', function(parsh) {
    var nama = $pars(parsh.relatedTarget).data('nama');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="nama"]').val(nama);
});
$pars('#modal_delete_kelompok_parameter_uji').on('show.bs.modal', function(parsh) {
    var nama = $pars(parsh.relatedTarget).data('nama');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	document.getElementById("hapus_id").innerHTML = nama;
});

$pars('#modal_edit_parameter_uji').on('show.bs.modal', function(parsh) {
	var id = $pars(parsh.relatedTarget).data('id');
	var sub_kode = $pars(parsh.relatedTarget).data('sub_kode');
	var nama_parameter = $pars(parsh.relatedTarget).data('nama_parameter');
	var satuan = $pars(parsh.relatedTarget).data('satuan');
	var metode = $pars(parsh.relatedTarget).data('metode');
	var batas_normal = $pars(parsh.relatedTarget).data('batas_normal');
	var biaya = $pars(parsh.relatedTarget).data('biaya');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="sub_kode"]').val(sub_kode);
	$pars(parsh.currentTarget).find('input[name="nama_parameter"]').val(nama_parameter);
	$pars(parsh.currentTarget).find('input[name="satuan"]').val(satuan);
	$pars(parsh.currentTarget).find('input[name="metode"]').val(metode);
	$pars(parsh.currentTarget).find('input[name="batas_normal"]').val(batas_normal);
	$pars(parsh.currentTarget).find('input[name="biaya"]').val(biaya);
});
//ganti hapus dr id ke class
$pars('#modal_delete_parameter_uji').on('show.bs.modal', function(parsh) {
    var nama = $pars(parsh.relatedTarget).data('nama');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	document.getElementById("hapus_id1").innerHTML = nama;
});
//pake shown bukan show
$pars('#modal_add_paket_pemeriksaan').on('shown.bs.modal', function(parsh) {
	 //$pars('.chosen-select', this).chosen();
	$pars('.chosen-select', this).chosen('destroy').chosen();
});
$pars('#modal_edit_paket_pemeriksaan').on('shown.bs.modal', function(parsh) {
	//$pars('.chosen-select', this).chosen();
	$pars('.chosen-select', this).chosen('destroy').chosen();
	var id = $pars(parsh.relatedTarget).data('id');
	var kode = $pars(parsh.relatedTarget).data('kode');
	var nama_paket = $pars(parsh.relatedTarget).data('nama_paket');
	var biaya = $pars(parsh.relatedTarget).data('biaya');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="kode"]').val(kode);
	$pars(parsh.currentTarget).find('input[name="nama_paket"]').val(nama_paket);
	$pars(parsh.currentTarget).find('input[name="biaya"]').val(biaya);
	//document.getElementById("qs1").innerHTML = kode;
});
$pars('#modal_delete_paket_pemeriksaan').on('show.bs.modal', function(parsh) {
    var nama_paket = $pars(parsh.relatedTarget).data('nama_paket');
	var id = $pars(parsh.relatedTarget).data('id');
	var kode = $pars(parsh.relatedTarget).data('kode');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="kode"]').val(kode);
	document.getElementById("hapus_id2").innerHTML = nama_paket;
});

$pars('#modal_edit_pekerjaan').on('show.bs.modal', function(parsh) {
    var nama_pekerjaan = $pars(parsh.relatedTarget).data('nama_pekerjaan');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="nama_pekerjaan"]').val(nama_pekerjaan);
});
$pars('#modal_delete_pekerjaan').on('show.bs.modal', function(parsh) {
    var nama_pekerjaan = $pars(parsh.relatedTarget).data('nama_pekerjaan');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	document.getElementById("hapus_id3").innerHTML = nama_pekerjaan;
});

$pars('#modal_edit_jenis_pasien').on('show.bs.modal', function(parsh) {
    var jenis = $pars(parsh.relatedTarget).data('jenis');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="jenis"]').val(jenis);
});
$pars('#modal_delete_jenis_pasien').on('show.bs.modal', function(parsh) {
    var jenis = $pars(parsh.relatedTarget).data('jenis');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	document.getElementById("hapus_id4").innerHTML = jenis;
});

$pars('#modal_edit_petugas').on('show.bs.modal', function(parsh) {
    var nama_petugas = $pars(parsh.relatedTarget).data('nama_petugas');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="nama_petugas"]').val(nama_petugas);
});
$pars('#modal_delete_petugas').on('show.bs.modal', function(parsh) {
    var nama_petugas = $pars(parsh.relatedTarget).data('nama_petugas');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	document.getElementById("hapus_id5").innerHTML = nama_petugas;
});

$pars('#modal_edit_pasien').on('show.bs.modal', function(parsh) {
	var id_pasien = $pars(parsh.relatedTarget).data('id_pasien');
    var nama_pasien = $pars(parsh.relatedTarget).data('nama_pasien');
	var alamat = $pars(parsh.relatedTarget).data('alamat');
	var tempat_lahir = $pars(parsh.relatedTarget).data('tempat_lahir');
	var tanggal_lahir = $pars(parsh.relatedTarget).data('tanggal_lahir');
	var pekerjaan = $pars(parsh.relatedTarget).data('pekerjaan');
	var no_telp = $pars(parsh.relatedTarget).data('no_telp');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="id_pasien"]').val(id_pasien);
	$pars(parsh.currentTarget).find('input[name="nama_pasien"]').val(nama_pasien);
	$pars(parsh.currentTarget).find('input[name="alamat"]').val(alamat);
	$pars(parsh.currentTarget).find('input[name="tempat_lahir"]').val(tempat_lahir);
	$pars(parsh.currentTarget).find('input[name="tanggal_lahir"]').val(tanggal_lahir);
	$pars(parsh.currentTarget).find('input[name="pekerjaan"]').val(pekerjaan);
	$pars(parsh.currentTarget).find('input[name="no_telp"]').val(no_telp);
});
$pars('#modal_delete_pasien').on('show.bs.modal', function(parsh) {
    var nama_pasien = $pars(parsh.relatedTarget).data('nama_pasien');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	document.getElementById("hapus_id6").innerHTML = nama_pasien;
});

$pars('#modal_edit_reagen').on('show.bs.modal', function(parsh) {
    var nama_reagen = $pars(parsh.relatedTarget).data('nama_reagen');
	var bentuk = $pars(parsh.relatedTarget).data('bentuk');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="nama_reagen"]').val(nama_reagen);
	$pars(parsh.currentTarget).find('input[name="bentuk"]').val(bentuk);
});
$pars('#modal_delete_reagen').on('show.bs.modal', function(parsh) {
    var nama_reagen = $pars(parsh.relatedTarget).data('nama_reagen');
	var bentuk = $pars(parsh.relatedTarget).data('bentuk');
	var kode = $pars(parsh.relatedTarget).data('kode');
	var id = $pars(parsh.relatedTarget).data('id');
    $pars(parsh.currentTarget).find('input[name="id"]').val(id);
	$pars(parsh.currentTarget).find('input[name="kode"]').val(kode);
	document.getElementById("hapus_id7").innerHTML = nama_reagen;
});
</script>	
<script>
	var $fil = jQuery.noConflict();
	$fil(document).ready(function() {
	$fil("#periode").change(function(){
 
	dropdown = $fil('#periode').val();

        
        if (dropdown == 'harian')
        {
          $fil(document.getElementById('m2')).remove();
          $fil(document.getElementById('y2')).remove();
          $fil(document.getElementById('y3')).remove();
          $fil('<select id="d1" name="tgl1" class="form1"><?php 
				for ($ntg = 1; $ntg<=31;$ntg++) {
				if ($ntg == date("j") ) {
					echo "<option value= $ntg selected>$ntg";
				} else{
					echo "<option value= $ntg>$ntg";
				}
			} ?></select> <select id="m1" name="bln1" class="form1"><?php
				for ($nbl = 0; $nbl<=11;$nbl++) {
				if ($nbl == date("n") - 1) {
				echo "<option value= $nbl selected> $cbulan[$nbl]";
				} else {
				echo "<option value= $nbl> $cbulan[$nbl]";
				}
			} ?></select> <select id="y1" name="thn1" class="form1"><?php
				for ($nth = $nthm; $nth<=$ntha;$nth++) {
				if ($nth == date("Y")) {
				echo "<option value= $nth selected> $nth";
				} else {
				echo "<option value= $nth> $nth";
				}
			}?></select>').appendTo('#output');
        
        }
        else if (dropdown == 'bulanan') 
        {
          $fil(document.getElementById('d1')).remove();
          $fil(document.getElementById('m1')).remove();
          $fil(document.getElementById('y1')).remove();
          $fil(document.getElementById('y3')).remove();
           $fil('<select id="m2" name="bln2" class="form1"><?php
				for ($nbl = 0; $nbl<=11;$nbl++) {
				if ($nbl == date("n") - 1) {
				echo "<option value= $nbl selected> $cbulan[$nbl]";
				} else {
				echo "<option value= $nbl> $cbulan[$nbl]";
				}
			} ?></select> <select id="y2" name="thn2" class="form1"><?php
				for ($nth = $nthm; $nth<=$ntha;$nth++) {
				if ($nth == date("Y")) {
				echo "<option value= $nth selected> $nth";
				} else {
				echo "<option value= $nth> $nth";
				}
			}?></select>').appendTo('#output');
        }
        else if (dropdown == 'tahunan') 
        {
          $fil(document.getElementById('d1')).remove();
          $fil(document.getElementById('m1')).remove();
          $fil(document.getElementById('y1')).remove();
          $fil(document.getElementById('m2')).remove();
          $fil(document.getElementById('y2')).remove();
           $fil('<select id="y3" name="thn3" class="form1"><?php
				for ($nth = $nthm; $nth<=$ntha;$nth++) {
				if ($nth == date("Y")) {
				echo "<option value= $nth selected> $nth";
				} else {
				echo "<option value= $nth> $nth";
				}
			}?></select>').appendTo('#output');
        }
        else if (dropdown == 'semua') 
        {
          $fil(document.getElementById('d1')).remove();
          $fil(document.getElementById('m1')).remove();
          $fil(document.getElementById('y1')).remove();
          $fil(document.getElementById('m2')).remove();
          $fil(document.getElementById('y2')).remove();
          $fil(document.getElementById('y3')).remove();

        }
        

		});
	});
</script>	
	
<script>
var $hide = jQuery.noConflict();
$hide('option.hide').hide();
</script>	
<script>
//fungsi informasi pasien (auto sum harga total dan list item)
var $autosum = jQuery.noConflict();
$autosum(document).ready(function() {
$autosum("input[type=checkbox]").change(function(){
  recalculate();
      if (this.checked) {
        var isi = $autosum(this).attr("data");
        var isi2 = $autosum(this).attr("data2");
        var isi3 = $autosum(this).attr("data3");
        $autosum('<div id="d">'+ isi2 +' - '+ isi +' - '+ isi3 +'</div>').appendTo('#output');
        //$autosum('<input type="text" id="dx" value='+ isi +'>').appendTo('#output');
    } else {
         $autosum(document.getElementById('d')).remove();
    } 
});
$autosum(".chkk").change(function(){
	if (this.checked) {
		var isi = $autosum(this).attr("data2");
		$autosum('<input name="nama_paket[]" type="text" id="dx" value='+ isi +'>').appendTo('#output');
	} 
});
function recalculate(){
    var sum = 0;
    $autosum("input[type=checkbox]:checked").each(function(){
      sum += parseInt($autosum(this).attr("price"));
    });
  //  alert(sum);
////$("#output").html(sum);
    document.getElementById('total_biaya').value = sum
}
});
</script>	
	
<script>
//fungsi list parameter uji dan paket
	var $show = jQuery.noConflict();
	$show(document).ready(function(){
$show("#isi1,#isi2,#isi3,#isi4,#isi5,#isi6,#isi7,#isi8,#isi9,#isi_a1,#isi_a2,#isi_a3,#isi_a4,#isi_a5,#isi_a6,#isi_a7,#isi_a8,#isi_a9,#isi_a10,#isi_a11,#isi_a12,#isi_a13,#isi_a14,#isi_a15").hide();

    $show("#div1").click(function(){
        $show("#isi1").slideToggle(200);

    });
	$show("#div2").click(function(){
        $show("#isi2").slideToggle(200);
    
	});

	$show("#div3").click(function(){
        $show("#isi3").slideToggle(200);

	});
	
    $show("#div4").click(function(){
        $show("#isi4").slideToggle(200);

    });
	$show("#div5").click(function(){
        $show("#isi5").slideToggle(200);
    
	});

	$show("#div6").click(function(){
        $show("#isi6").slideToggle(200);

	});
	
    $show("#div7").click(function(){
        $show("#isi7").slideToggle(200);

    });
	$show("#div8").click(function(){
        $show("#isi8").slideToggle(200);
    
	});

	$show("#div9").click(function(){
        $show("#isi9").slideToggle(200);

	});
	$show("#div_a1").click(function(){
        $show("#isi_a1").slideToggle(200);

	});
	$show("#div_a2").click(function(){
        $show("#isi_a2").slideToggle(200);

	});
	$show("#div_a3").click(function(){
        $show("#isi_a3").slideToggle(200);

	});
	$show("#div_a4").click(function(){
        $show("#isi_a4").slideToggle(200);

	});
	$show("#div_a5").click(function(){
        $show("#isi_a5").slideToggle(200);

	});
	$show("#div_a6").click(function(){
        $show("#isi_a6").slideToggle(200);

	});
	$show("#div_a7").click(function(){
        $show("#isi_a7").slideToggle(200);

	});
	$show("#div_a8").click(function(){
        $show("#isi_a8").slideToggle(200);

	});
	$show("#div_a9").click(function(){
        $show("#isi_a9").slideToggle(200);

	});
	$show("#div_a10").click(function(){
        $show("#isi_a10").slideToggle(200);

	});
	$show("#div_a11").click(function(){
        $show("#isi_a11").slideToggle(200);

	});
	$show("#div_a12").click(function(){
        $show("#isi_a12").slideToggle(200);

	});
	$show("#div_a13").click(function(){
        $show("#isi_a13").slideToggle(200);

	});
	$show("#div_a14").click(function(){
        $show("#isi_a14").slideToggle(200);

	});
});

</script>	
<script>
	//fungsi panggil cari paramater uji
	var $ee = jQuery.noConflict();
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"15%"}
    }
    for (var selector in config) {
      $ee(selector).chosen(config[selector]);
    }
</script>	
<script>
//fungsi chart 
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
            text: 'Statistik Pasien Dan Pemeriksaan'
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
</script>
<script>
//fungsi date picker
	var $jnoc3 = jQuery.noConflict();
			$jnoc3('.form_date').datetimepicker({
			language:  'id',
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
			});
</script>
<script>
//fungsi sidebar
	var $jnoc1 = jQuery.noConflict();
	$jnoc1(document).ready(function () {
    $menuLeft = $jnoc1('.pushmenu-left');
    $nav_list = $jnoc1('#nav_list');
    $nav_list.click(function(){
        $jnoc1(this) .toggleClass('active') ;
        $jnoc1('.pushmenu-push').toggleClass('pushmenu-push-toright');
        $menuLeft.toggleClass('pushmenu-open');
        });
    });
</script>
    
<script>
//fungsi datatable
    var $jnoc = jQuery.noConflict();
	$jnoc(function() {
    $jnoc('#example1').dataTable();
    });
</script>
	
<script>
//fungsi validasi
var $jnoc2 = jQuery.noConflict();
$jnoc2("#form_input").validate();
</script>

  </body>
</html>