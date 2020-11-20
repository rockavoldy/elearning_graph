   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->

<div class="row">
  <div class="clo-lg-6">
    <?php echo $this->session->flashdata('message'); ?>
  </div>
</div>
<div class="col-lg">
    <div class="card">
        <div class="card-header">
			    <strong class="card-title"><?php echo $judul ;?></strong>
        </div>
        <div class="card-body">
        <form method="post" action='<?php echo site_url('dosen/eDosen'); ?>'>
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name='nip' value="<?php echo $dosen['nip']; ?>" id="formGroupExampleInput" placeholder="Example input">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name='email' value="<?php echo $dosen['email']; ?>" id="formGroupExampleInput2" placeholder="Another input">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name='nama' value="<?php echo $dosen['nama']; ?>" id="formGroupExampleInput2" placeholder="Another input">
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password"  name='password' class="form-control" id="inputPassword3" placeholder="Password">
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>  
      </div>
    </div>
</div>
</div>

<!-- /.container-fluid -->
