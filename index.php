<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="libs/bootstrap.min.css" rel="stylesheet">
    <link href="libs/login.css" rel="stylesheet">
    <style>
        body {
            background: url(images/blue.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <script type="text/javascript">
        function validasi(form) {
            if (form.username.value == "") {
                alert("Username Tidak Boleh Kosong");
                form.username.focus();
                return (false);
            }

            if (form.password.value == "") {
                alert("Password Tidak Boleh Kosong");
                form.password.focus();
                return (false);
            }
            return (true);
        }
    </script>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 login-from">
                <h4><em class="glyphicon glyphicon-log-in"></em> Halaman Login</h4>

                <?php
                /**
                 * Pesan Error Bila terjadi kegagalan dalam login
                 */
                if (isset($_GET['error']) && $_GET['error'] == 'salah') {
                    echo '<div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Wrong ! </strong> Username dan Password tidak ditemukan
                       </div>';
                } ?>
                <form action="cek_login.php" method="post" onSubmit="return validasi(this)">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
                <br>
                </center>
            </div>
        </div>
    </div> <!-- End container -->

    <!-- Script js -->
    <script src="libs/jquery/jquery.min.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    <!-- End Script -->

</body>

</html>