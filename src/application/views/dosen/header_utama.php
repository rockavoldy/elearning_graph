<?php 
if (!$this->session->userdata('login')) {
    redirect(base_url());
}
if ($this->session->userdata('akses')!='dosen') {
    redirect(site_url('Mahasiswa'));
 } 
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $judul; ?></title>
  <link rel="icon"  href="<?php echo base_url(); ?>assets/img/favicon.png"/>
  <link href="<?php echo base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/'); ?>css/summernote-bs4.css" rel="stylesheet">
  <script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>js/summernote-bs4.js"></script>
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">