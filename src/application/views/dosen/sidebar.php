<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon">
  <img src="<?php echo base_url('/assets/img/logo.png') ?>"  width="60"
         height="60">
  </div>
  <div class="sidebar-brand-text md-3">WEB Kelasku</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('dosen/home') ;?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>
<div class="sidebar-heading">
  Menu
</div>

<li class="nav-item">
  <a class="nav-link" href="<?php echo site_url("Dosen") ?>">
  <i class="nav-link-icon fa fa-database"></i>
    <span>Daftar Topik</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo site_url("dosen/listMhs") ?>">
  <i class="nav-link-icon fa fa-database"></i>
    <span>Daftar Mahasiswa</span></a>
</li>


<!-- Divider -->

<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Sub Materi Graph
</div>

<?php foreach ($topik as $key ) { ?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
   
  <a class="nav-link collapsed" href="<?php echo site_url('Dosen/Materi/'); echo ("$key->kode_topik") ?>" >
    <i class="<?php echo $key->icon ?>"></i>
    <span><?php echo $key->nama_topik ?></span>
  </a>
</li>


                      <?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->

<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<div class="sidebar-heading">
  Logout
</div>
  <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('auth/logout') ?>">
      <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Log Out</span></a>
    </li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>