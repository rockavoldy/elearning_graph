<!-- Modal Tambah Sesi -->
<div class="modal fade" id="addTopik" tabindex="-1" role="dialog" aria-labelledby="add Topik" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Topik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        <form class="container" action="<?php echo site_url('Dosen/addTopik'); ?>" method="POST">
          <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nama Topik</label>
            <input type="text" class="form-control" name="namaTopik" id="namaTopik" placeholder="Topik" required>
          </div>
          <div class="form-group col-md-6">
            <label>Kode Topik</label>
            <input type="text" class="form-control" name="kodeTopik" id="kodeTopik" placeholder="Topik" required>
          </div>
          <div class="form-group col-md-4">
            <label >Ikon</label>
            <input type="text" class="form-control" name="namaIkon" id="namaIkon" placeholder="fa-namaikon" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
