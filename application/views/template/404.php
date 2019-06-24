<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SNAZZY | 404 Not Found</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo site_url('assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url('assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo site_url('assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url('assets/AdminLTE/dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo site_url('assets/AdminLTE/dist/css/skins/_all-skins.min.css')?>">

  <!-- logo -->
  <link rel="SHORTCUT ICON" href="<?php echo base_url('assets/img/logo.png')?>">

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

  
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo site_url('dashboard') ?>" class="navbar-brand"><b>SNAZZY</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <label class="pull-right" style="color: white; font-size: 16px; margin-top: 15px; margin-right: 15px;"><?php echo longdate_indo(date("Y-m-d")); ?></label>
          </li>  
        </ul>
      </div>


      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  
<div class="content-wrapper">

  <section class="content">
    <div class="error-page">
      <h2 align="center" style="font-size: 100px;" class="text-red"> 404</h2>
      <div class="row">  
        <div class="col-md-12">
          <div class="error-content">
            <center><h3><i class="fa fa-warning text-red"></i> Oops! Page not found.</h3></center>
          </div>    
        </div>
      </div>
    </div>
  </section>

</div>

          