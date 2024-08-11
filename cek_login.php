<?php
error_reporting(0);

include('libs/koneksi.php');
$sql=mysql_query("select * from  user where username='".$_POST['username']."' and password=MD5('".$_POST['password']."')");
$baris =mysql_num_rows($sql);
$row=mysql_fetch_array($sql);

if ($baris==1){


if ($row[level]=="") {
	echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>";
	echo "<a href=index.php><b>Try Again</b></a></center><br>";
	die("User Level Invalid..");
	
}

session_start();
 include ('timeout.php');
$_SESSION[username]=$row[username];
$_SESSION[userlevel]=$row[level];
$_SESSION[passwd]=$row[password];

header("location:home.php?ref=home");
}else{
echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>";
echo "<a href=index.php><b>Try Again</b></a></center>";	
}
?>