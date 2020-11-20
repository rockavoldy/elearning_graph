<div class="col-lg">
    <div class="card">
        <div class="card-header">
			<strong class="card-title">Daftar Topik</strong>
				<button type="button" style="float: right;" class="btn btn-primary btn-sm fa fa-plus-square"  data-toggle="modal" data-target="#addTopik">  Tambah Sesi
				</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead >
                    <tr>
                        <th scope="col-lg-3">No</th>
                        <th scope="col">Nama Topik</th>
                        <th scope="col">Kode Topik</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
			          	<?php
				            	$i=1;
					            foreach ($topik as $key) {
			                	?>
                  <tr>
                    <th><?php echo $i; $i++; ?></th>
                    <td>
						          <?php echo "$key->nama_topik"; ?>
					          </td>
                    <td>
                      <?php echo "$key->kode_topik"; ?>
                    </td>
                    <td> 
                      <button type="button" class="badge badge-success" data-toggle="modal" data-target="#edit<?php echo $key->id_topik;?>">edit </button>
                      <a href="<?php echo base_url('');?>dosen/hapustopik/<?php echo $key->id_topik; ?>" class="badge badge-danger" onclick="return confirm('yakin?');">Delete</a>
                    </td>
			          	</tr>
                  <?php
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal -->
<?php
				foreach ($topik as $key) {
				?>
<!-- Modal Tambah Sesi -->
<div class="modal fade" id="edit<?php echo $key->id_topik;?>" tabindex="-1" role="dialog" aria-labelledby="edit Topik" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Topik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        <form class="container" action="<?php echo site_url('Dosen/updateTopik'); ?>" method="POST">
		<input type="hidden" value="<?php echo $key->id_topik; ?>" name="id_topik">  
		<div class="form-row">
          <div class="form-group col-md-6">
            <label>Nama Topik</label>
            <input type="text" class="form-control"  name="namaTopik" id="namaTopik" value="<?php echo $key->nama_topik; ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Kode Topik</label>
            <input type="text" class="form-control"  name="kodeTopik" id="kodeTopik" value="<?php echo $key->kode_topik; ?>">
          </div>
          <div class="form-group col-md-4">
            <label >Icon</label>
            <input type="text" class="form-control" name="icon" id="icon" value="<?php echo $key->icon; ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
				<?php
					}
				?>



