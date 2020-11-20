<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('mahasiswa');?>">
<div class="sidebar-brand-icon">
  <img src="<?php echo base_url('/assets/img/logo.png'); ?>"  width="60" height="60">
  </div>
  <div class="sidebar-brand-text md-3">WEB Kelasku</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item ">
  <a class="nav-link" href="<?php echo site_url('mahasiswa') ;?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
Materi Graf
</div>

<?php foreach ($topik as $key ) { ?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
   
  <a class="nav-link collapsed" href="<?php echo site_url('Mahasiswa/Materi/'); echo ("$key->kode_topik") ?>" >
    <i class="<?php echo $key->icon ?>"></i>
    <span><?php echo $key->nama_topik ?></span>
  </a>
</li>
<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Tes Akhir
</div>
<li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('mahasiswa/evaluasi'); ?>">
      <i class="fas fa-fw fa-award"></i>
        <span>Evaluasi</span></a>
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