<?php
include "../libs/koneksi.php";

mysql_query("DELETE FROM pasien WHERE ID = '".$_GET['id']."'");
mysql_query("DELETE FROM dokter WHERE ID = '".$_GET['id']."'");
mysql_query("DELETE FROM pemeriksaan WHERE kode = '".$_GET['kode']."'");
mysql_query("DELETE FROM parameter_pasien WHERE kode = '".$_GET['kode']."'");
echo "<script language=javascript>parent.location.href='home.php?ref=pasien';</script>";
?>