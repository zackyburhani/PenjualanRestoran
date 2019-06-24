<!DOCTYPE html>
<html lang="en">
<head>
	<title>SNAZZY | Login</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="<?php echo base_url('assets/img/logo.png')?>">

	<!-- styles -->
	<link href="<?php echo base_url('assets/Login/css/login.css')?>" rel="stylesheet">
    <!-- SweetAlert -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/AdminLTE/dist/css/sweetalert.css')?>">
    <script src="<?php echo base_url('assets/sweetalert/docs/assets/sweetalert/sweetalert.min.js')?>"></script>

</head>
<body>
    <?php
        date_default_timezone_set("Asia/Jakarta");
        $hour = date("G", time());
        $text = '';

        if ($hour >= 0 && $hour <= 11) {
            $text = "Selamat Pagi";
        } elseif ($hour >= 12 && $hour <= 14) {
            $text = "Selamat Siang";
        } elseif ($hour >= 15 && $hour <= 17) {
            $text = "Selamat Sore";
        } elseif ($hour >= 17 && $hour <= 23) {
            $text = "Selamat Malam";
        }
    ?>

    <?php if ($this->session->flashdata('pesanGagal') == TRUE) { ?>
        <script>
            setTimeout(function() {
                swal({
                  title: "Username Atau Password Salah",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
            }, 600);
        </script>
    <?php } ?>

    <div class="wrapper">
        <div class="left">
            <img src="<?php echo base_url('assets/img/LOGO_LOGIN.png')?>">
        </div>
        <div class="right">
            <div class="content">
                <div class="heading">
                    <h2 class="title">Halo,</h2>
                    <span class="subtitle"><?php echo $text ?></span>
                </div>
                <form class="form" method="POST" action="<?php echo site_url('login/auth') ?>">
                    <div class="form-group">
                        <label class="label">username</label>
                        <input type="text" name="username" class="input" placeholder="masukkan username anda">
                        
                    </div>
                    <div class="form-group">
                        <label class="label">password</label>
                        <input type="password" name="password" class="input password" placeholder="masukkan password anda">
                    </div>
                    <button type="submit" class="button">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>