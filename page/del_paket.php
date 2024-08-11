<?php
include "../libs/koneksi.php";

mysql_query("DELETE FROM paket_pemeriksaan WHERE ID = '".$_GET['id']."'");
mysql_query("DELETE FROM paket_filter WHERE kode = '".$_GET['kode']."'");
mysql_query("DELETE FROM paket_nama WHERE kode = '".$_GET['kode']."'");
mysql_query("DELETE FROM paket_total WHERE kode = '".$_GET['kode']."'");
echo "<script language=javascript>parent.location.href='home.php?ref=paket_pemeriksaan';</script>";
?>