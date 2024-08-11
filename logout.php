
<html>
<head>
<script type="text/javascript">
<!--
window.location = "index.php"
//-->
</script>
</head>
<body>
<?php
  session_start();
  session_destroy();
  echo "<center>Anda telah sukses keluar sistem <b>[LOGOUT]<b>";
  echo "<a href='../../index.php'>";
?>
<body onLoad="setTimeout('delayer()', 9000)">
<h2>Anda sudah LogOut</h2>
<p>redirect, harap tunggu 
location!</p>

</body>
</html>
