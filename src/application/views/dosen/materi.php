<div class="col-lg">
<div class="modal-body">
      <form method="post" action="<?php echo site_url('dosen/simpanMateri') ?>">
         <label>Judul</label><input type="text" id="nama_topik" name="nama_Topik" class="form-control" value="<?php echo $topik->nama_topik ;?>" readonly>
         <input type="hidden" name="id_topik" value="<?php echo $topik->id_topik ;?>">
         <label>Kode Materi</label>
         <input type="text" id="kode_topik" name="kode_topik" class="form-control" value="<?php echo $topik->kode_topik ;?>" readonly>
         <label>Konten</label>
         <textarea id="summernote" name="konten"><?php echo isset($konten->isi_konten) ? $konten->isi_konten : ""; ?></textarea>
         </br>         
         <input type="submit" class="btn btn-primary" value="Simpan">   
      </form>
</div>

<div style="font-size: 18px;">
		
	Isi Jawaban : <br>
	<table width="100%" border="3px;" style="color: black;">
				<thead>
					<tr>
						<th>Nama Siswa</th>
						<th>File Jawaban</th>
						<th>Status</th>
						<th>Nilai</th>
						<th>Actions</th>
					</tr>
				</thead>
	<?php 
		foreach ($jawaban_tugas as $key ) {
			?>
			<tr>
			<td><?php echo $key->nama; ?></td>
			<td>
				<a class="btn btn-secondary" href="<?php echo base_url('JawabanTugas/').$key->file_jawaban; ?>"><?php echo $key->file_jawaban; ?></a></td>
			<td>
				<?php 
				if ($key->st == 0) {
					?>
					<font color="red"><?php echo "Belum Dinilai";?></font>
					<?php
				}else{
					?>
					<font color="green"><?php echo "Sudah Dinilai";?></font>
					<?php
				}
				?>
			</td>
			<td><?php echo $key->nilai; ?></td>
			<td><a href="#edit_nilai<?php echo $key->id_jawaban;?>" class="btn btn-primary" data-toggle="modal">Beri Nilai</a></td>
		</tr>	
			<?php
		}
	 ?>
	 </table>
	 <br><br>
	 <a style="margin-left: 1000px; " class="btn btn-primary" href="javascript:history.back()">Kembali</a>

<br><br>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 

<script>
$(document).ready(function() {
  $('#summernote').summernote({
   spellcheck: false,
   height: 350,
   callbacks: {
      onImageUpload: function(files) {
         if (!files.length) return;
         for (let i = 0; i < files.length; i++) {
            uploadImage(files[i]);
         }
      }
   }
  });

  $('#summernote').val($("#summernote").summernote('code', `<?php echo isset($konten->isi_konten) ? $konten->isi_konten : ""; ?>`));


  function uploadImage(file) {
     let data = new FormData();
     data.append('file', file);
     fetch("<?php echo site_url('dosen/uploadImage') ?>", {
        method: "POST",
        body: data
     }).then(response => response.json())
     .then(data => {
        console.log(data);
        $("#summernote").summernote('insertImage', data.path);
     })
  }   
});
</script>

<?php 
		foreach ($jawaban_tugas as $key ) {
			?>
<div id="edit_nilai<?php echo $key->id_jawaban;?>" class="modal fade" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo site_url('Dosen/beri_nilai'); ?>" method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Beri Nilai</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<!-- <label>Name</label> -->
							<input type="hidden" name="id_jawaban" class="form-control" value="<?php echo $key->id_jawaban;?>" >
						</div>
						<div class="form-group">
							<label>Nilai</label>
							<input type="number" name="nilai" class="form-control" value="<?php echo $key->nilai;?>" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input id="tombol" type="submit" class="btn btn-success" value="Edit">
					</div>
				</form>
			</div>
		</div>
	</div>
<?php 
	}
			?>