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
        <form method="post" action='<?php echo site_url('mahasiswa/eMhs'); ?>'>
          <div class="form-group">
            <label>NIM</label>
            <input type="text" class="form-control" name='nim' value="<?php echo $mhs['nim']; ?>" id="formGroupExampleInput" placeholder="Example input">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name='email' value="<?php echo $mhs['email']; ?>" id="formGroupExampleInput2" placeholder="Another input">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name='nama' value="<?php echo $mhs['nama']; ?>" id="formGroupExampleInput2" placeholder="Another input">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name='password' id="inputPassword3" placeholder="Password">
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
