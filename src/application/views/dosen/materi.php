<div class="col-lg">
	<div class="modal-body">
		<form method="post" action="<?php echo site_url('dosen/simpanMateri') ?>">
			<label>Judul</label><input type="text" id="nama_topik" name="nama_Topik" class="form-control" value="<?php echo $topik->nama_topik; ?>" readonly>
			<input type="hidden" name="id_topik" value="<?php echo $topik->id_topik; ?>">
			<label>Kode Materi</label>
			<input type="text" id="kode_topik" name="kode_topik" class="form-control" value="<?php echo $topik->kode_topik; ?>" readonly>
			<label>Konten</label>
			<textarea id="summernote" name="konten"><?php echo isset($konten->isi_konten) ? $konten->isi_konten : ""; ?></textarea>
			</br>
			<div class="d-flex justify-content-between">
				<input type="submit" class="btn btn-primary" value="Simpan">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBuatSoal">Buat Soal</button>
			</div>

		</form>
	</div>

	<div class="modal fade" id="modalBuatSoal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Buat Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="bentukSoal">Bentuk Soal</label>
							<select id="bentukSoal" class="form-control">
								<option value="" selected disabled>Pilih Bentuk Soal</option>
								<option value="membuat-graf">Membuat Graf</option>
								<option value="membuat-graf-euler">Membuat Graf Euler</option>
								<option value="drag-and-drop">Drag & Drop</option>
								<option value="membuat-matriks">Membuat Matriks</option>
								<option value="pilih-node">Memilih Node</option>
								<option value="isian-array">Isian</option>
							</select>
						</div>
						<div class="form-group">
							<label for="deskripsiSoal">Deskripsi Soal</label>
							<textarea id="deskripsiSoal" name="deskripsiSoal" class="form-control"></textarea>
						</div>
						<div class="d-none" id="soalMembuatGraf">
							<div class="form-group">
								<label for="listNode">Array Node</label>
								<input type="text" class="form-control" name="listNode" id="listNode" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listEdge">Array Edge</label>
								<input type="text" class="form-control" name="listEdge" id="listEdge" placeholder="{(A, B); (A, C); (B, C)}" />
							</div>
						</div>

						<div class="d-none" id="soalMembuatGrafEuler">
							Disini soal membuat graf euler
						</div>

						<div class="d-none" id="soalDragAndDrop">
							Disini soal Drag and Drop
						</div>

						<div class="d-none" id="soalMembuatMatriks">
							MAatrix
						</div>

						<div class="d-none" id="soalMemilihNode">
							Memilih Node
						</div>

						<div class="d-none" id="soalIsian">
							Disini soal isian
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="saveSoalButton" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
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
			foreach ($jawaban_tugas as $key) {
			?>
				<tr>
					<td><?php echo $key->nama; ?></td>
					<td>
						<a class="btn btn-secondary" href="<?php echo base_url('JawabanTugas/') . $key->file_jawaban; ?>"><?php echo $key->file_jawaban; ?></a></td>
					<td>
						<?php
						if ($key->st == 0) {
						?>
							<font color="red"><?php echo "Belum Dinilai"; ?></font>
						<?php
						} else {
						?>
							<font color="green"><?php echo "Sudah Dinilai"; ?></font>
						<?php
						}
						?>
					</td>
					<td><?php echo $key->nilai; ?></td>
					<td><a href="#edit_nilai<?php echo $key->id_jawaban; ?>" class="btn btn-primary" data-toggle="modal">Beri Nilai</a></td>
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

	let bentukSoal = document.getElementById("bentukSoal");

	let lastSoalValue = null;

	$("#bentukSoal").on("change", (event) => {
		if (lastSoalValue != null) lastSoalValue.classList.add("d-none");
		switch (event.target.value) {
			case "membuat-graf":
				lastSoalValue = document.getElementById("soalMembuatGraf");
				break;
			case "membuat-graf-euler":
				lastSoalValue = document.getElementById("soalMembuatGrafEuler");
				break;
			case "drag-and-drop":
				lastSoalValue = document.getElementById("soalDragAndDrop");
				break;
			case "membuat-matriks":
				lastSoalValue = document.getElementById("soalMembuatMatriks");
				break;
			case "pilih-node":
				lastSoalValue = document.getElementById("soalMemilihNode");
				break;
			case "isian-array":
				lastSoalValue = document.getElementById("soalIsian");
				break;
			default:
				break;
		}

		lastSoalValue.classList.remove("d-none");
	})

	$("#saveSoalButton").on("click", () => {
		let data = {
			deskripsiSoal: $("#deskripsiSoal").val(),
			listNode: $("#listNode").val(),
			listEdge: $("#listEdge").val()
		}

		$.ajax({
				method: "POST",
				url: "<?php echo site_url('API/saveSoal/') ?>" + $("#bentukSoal").val(),
				data: data
			})
			.done(function(res) {
				console.log(res);
			});
	})
</script>

<?php
foreach ($jawaban_tugas as $key) {
?>
	<div id="edit_nilai<?php echo $key->id_jawaban; ?>" class="modal fade">
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
							<input type="hidden" name="id_jawaban" class="form-control" value="<?php echo $key->id_jawaban; ?>">
						</div>
						<div class="form-group">
							<label>Nilai</label>
							<input type="number" name="nilai" class="form-control" value="<?php echo $key->nilai; ?>" required>
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