<html>
    <head>
        <title>Laporan Rekapitulasi</title>
        <!--link rel="stylesheet" href="../libs/bootstrap.min.css"-->	
        <!--link rel="stylesheet" href="../libs/dataTables.bootstrap.css"-->
    </head>
<?php 
include ('../libs/koneksi.php'); 
if(isset($_POST['ganti']))
{
	$sql = "SELECT * FROM USER WHERE PASSWORD=MD5('".$_POST['pass_lama']."')";
	$query = mysql_query($sql);
	$hasil =mysql_num_rows($query);
	if($hasil==1)
	{
	$sql = "update USER set PASSWORD=MD5('".$_POST['pass_baru']."')";
	$query = mysql_query($sql);
	echo "Berhasil Update Password";
	} else {
	echo "Password Lama Anda Salah";
	}
	//echo "<script language=javascript>parent.location.href='home.php?ref=pengaturan';</script>";
	//writeMsg('update.sukses');
	//echo $stk;
	//Re-Load Data from DB
	//$sql = mysql_query("select id,kode,nama from kelompok_parameter_uji  WHERE id = '".$_GET['id']."'");
	//$data = mysql_fetch_array($sql);
}
?>    
    <h3 class="text-center">Ganti Password</h3><br>
    <body>
         <form  method="post" class="container">
                <div class="form-group">
                    <label for="">Password Lama</label>
                    <input type="password" class="form-control" name="pass_lama" placeholder="Password Lama" required>
                </div>
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" name="pass_baru" placeholder="Password Baru" required>
                </div><br>
                <div class="text-center">
                    <button class="btn btn-primary" value="ganti" name="ganti">Ganti Password</button>
                </div>
            </form>
            </div><!-- /.box-body -->
        </div>	
        <!--script src="table/jquery-1.11.1.min.js"></script-->
        <!--script src="table/bootstrap.min.js"></script-->
        <!--script src="table/jquery.dataTables.min.js"></script-->
        <!--script src="table/dataTables.bootstrap.js"></script-->	
        <!--script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script-->
    </body>
</html>