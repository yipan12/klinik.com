<?php
include "../libs/koneksi.php";

mysql_query("DELETE FROM kunjungan WHERE ID = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='home.php?ref=daftar_kunjungan';</script>";
?>