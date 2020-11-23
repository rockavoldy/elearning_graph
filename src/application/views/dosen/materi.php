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

	<div>
		<table class="table">
			<tr>
				<th>#</th>
				<th>Soal</th>
				<th>Aksi</th>
			</tr>
			<?php $i = 1;
			foreach ($listSoal as $el) { ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $el['soal'] ?></td>
					<td><button class="btn btn-primary" type="button" data-toggle="modal" data-soalid="<?php echo $el['id'] ?>" data-target="#modalKunciJawaban">Tambah Kunci Jawaban</button></td>
				</tr>
			<?php $i++;
			} ?>
		</table>
	</div>

	<div class="modal fale" id="modalKunciJawaban" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Buat Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modalBody">
					<textarea class="form-control mb-3" readonly id="deskripsiSoalKunciJawaban"></textarea>
					<form id="formKunciJawaban"></form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="saveKunciJawaban" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
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
								<option value="isian-array">Membuat Array</option>
							</select>
						</div>
						<div class="form-group">
							<label for="deskripsiSoal">Deskripsi Soal</label>
							<textarea id="deskripsiSoal" name="deskripsiSoal" class="form-control"></textarea>
						</div>
						<div class="d-none" id="soalMembuatGraf">
							<h5>Membuat Graf</h5>
							<div class="form-group">
								<label for="listNode">Array Node</label>
								<input type="text" class="form-control" name="listNode1" id="listNode1" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listEdge">Array Edge</label>
								<input type="text" class="form-control" name="listEdge1" id="listEdge1" placeholder="{(A, B); (A, C); (B, C)}" />
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="toggle-directional1">
								<label class="custom-control-label" for="toggle-directional1">Directional</label>
							</div>
						</div>

						<div class="d-none" id="soalMembuatGrafEuler">
							<h5>Membuat Graf Euler</h5>
							<div class="form-group">
								<label for="listNode2">Array Node</label>
								<input type="text" class="form-control" name="listNode2" id="listNode2" placeholder="{A, B, C}" />
							</div>
						</div>

						<div class="d-none" id="soalDragAndDrop">
							<h5>Membuat soal Drag and Drop</h5>
							<div class="form-group">
								<label for="listGraf3">List Graf</label>
								<input type="text" class="form-control" name="listGraf3" id="listGraf3" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listNode3">List Node</label>
								<input type="text" class="form-control" name="listNode3" id="listNode3" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listEdge3">List Edge</label>
								<input type="text" class="form-control" name="listEdge3" id="listEdge3" placeholder="{A, B, C}" />
							</div>
						</div>

						<div class="d-none" id="soalMembuatMatriks">
							<!-- <table class="table" id="matrixTable"></table> -->
							<h5>Membuat Tabel Matriks</h5>
							<div class="form-group">
								<label for="listNode">Array Node</label>
								<input type="text" class="form-control" name="listNode4" id="listNode4" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listEdge">Array Edge</label>
								<input type="text" class="form-control" name="listEdge4" id="listEdge4" placeholder="{(A, B); (A, C); (B, C)}" />
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="toggle-directional4">
								<label class="custom-control-label" for="toggle-directional4">Directional</label>
							</div>
						</div>

						<div class="d-none" id="soalMemilihNode">
							<h5>Memilih Node</h5>
							<div class="form-group">
								<label for="listNode">Array Node</label>
								<input type="text" class="form-control" name="listNode5" id="listNode5" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listEdge">Array Edge</label>
								<input type="text" class="form-control" name="listEdge5" id="listEdge5" placeholder="{(A, B); (A, C); (B, C)}" />
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="toggle-directional5">
								<label class="custom-control-label" for="toggle-directional5">Directional</label>
							</div>
						</div>

						<div class="d-none" id="soalIsian">
							<h5>Membuat array</h5>
							<div class="form-group">
								<label for="listNode">Array Node</label>
								<input type="text" class="form-control" name="listNode6" id="listNode6" placeholder="{A, B, C}" />
							</div>
							<div class="form-group">
								<label for="listEdge">Array Edge</label>
								<input type="text" class="form-control" name="listEdge6" id="listEdge6" placeholder="{(A, B); (A, C); (B, C)}" />
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="toggle-directional6">
								<label class="custom-control-label" for="toggle-directional6">Directional</label>
							</div>
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
		let bentukSoal = $("#bentukSoal").val();
		let data = {};
		switch (bentukSoal) {
			case "membuat-graf":
				data = {
					deskripsiSoal: $("#deskripsiSoal").val(),
					listNode: $("#listNode1").val(),
					listEdge: $("#listEdge1").val(),
					directional: document.getElementById("toggle-directional1").checked
				}
				break;
			case "membuat-graf-euler":
				data = {
					deskripsiSoal: $("#deskripsiSoal").val(),
					listNode: $("#listNode2").val(),
				}
				break;
			case "drag-and-drop":
				data = {
					deskripsiSoal: $("#deskripsiSoal").val(),
					dataSoalGraf: $("#listGraf3").val(),
					dataSoalNode: $("#listNode3").val(),
					dataSoalEdge: $("#listEdge3").val()
				}
				break;
			case "membuat-matriks":
				data = {
					deskripsiSoal: $("#deskripsiSoal").val(),
					listNode: $("#listNode4").val(),
					listEdge: $("#listEdge4").val(),
					directional: document.getElementById("toggle-directional4").checked
				}
				break;
			case "pilih-node":
				data = {
					deskripsiSoal: $("#deskripsiSoal").val(),
					listNode: $("#listNode5").val(),
					listEdge: $("#listEdge5").val(),
					directional: document.getElementById("toggle-directional5").checked
				}
				break;
			case "isian-array":
				data = {
					deskripsiSoal: $("#deskripsiSoal").val(),
					listNode: $("#listNode6").val(),
					listEdge: $("#listEdge6").val(),
					directional: document.getElementById("toggle-directional6").checked
				}
				break;
			default:
				break;
		}

		$.ajax({
				method: "POST",
				url: "<?php echo site_url('API/saveSoal/' . $topik->kode_topik . '/') ?>" + bentukSoal,
				data: data
			})
			.done(function(res) {
				console.log(res);
				if (res.message != "success") {
					alert("Gagal input, cek kembali array node dan graf agar sesuai format");
				} else {
					$("#modalBuatSoal").modal('toggle');
				}
			});
	})

	function populateMatrix(node) {
		let table = document.createElement("table");
		table.id = "matrixTable";
		table.setAttribute("class", "table table-bordered");
		table.innerHTML = "";
		for (let i = 0; i < node.length + 1; i++) {
			let row = document.createElement("tr");

			for (let j = 0; j < node.length + 1; j++) {
				let col = document.createElement("td");
				if (i == 0 && j == 0) {
					col.appendChild(document.createTextNode(""));
				} else if (i == 0 && j > 0) {
					col.appendChild(document.createTextNode(node[j - 1].text));
				} else if (j == 0 && i > 0) {
					col.appendChild(document.createTextNode(node[i - 1].text));
				}
				if (i > 0 && j > 0) {
					let checkbox = document.createElement("input");
					checkbox.setAttribute("type", "checkbox");
					col.appendChild(checkbox);
					checkbox.id = "check" + node[i - 1].id + "." + node[j - 1].id
					checkbox.onchange = function(event) {
						kunciJawabanForm.data["check" + node[i - 1].id + "." + node[j - 1].id] = event.target.checked;
					}
					// col.appendChild(document.createTextNode("*"));
					// col.appendChild(document.createTextNode(" "));
				}

				row.appendChild(col);
			}

			table.appendChild(row);
		}

		return table;
	}

	function populateDrag(data) {
		let table = document.createElement("table");
		table.id = "matrixTable";
		table.setAttribute("class", "table");
		table.innerHTML = "";

		for (let i = 0; i < data.graf.length + 1; i++) {
			let row = document.createElement("tr");

			for (let j = 0; j < 3; j++) {
				let col = document.createElement("td");
				if (i == 0) {
					if (j == 0) {
						col.appendChild(document.createTextNode("Graf"));
					} else if (j == 1) {
						col.appendChild(document.createTextNode("Node"));
					} else if (j == 2) {
						col.appendChild(document.createTextNode("Edge"));
					}
				} else {
					let node = document.createElement("select");
					node.setAttribute("class", "form-control");
					node.id = "pilihNode" + data.graf[i - 1].id;
					node.onchange = function(event) {
						kunciJawabanForm.data["node" + data.graf[i - 1].id] = event.target.value;
					}
					data.node.forEach(el => {
						let option = document.createElement("option");
						option.value = el.id
						option.appendChild(document.createTextNode(el.text));
						node.appendChild(option);
					})

					let edge = document.createElement("select");
					edge.setAttribute("class", "form-control");
					edge.id = "pilihedge" + data.graf[i - 1].id;
					edge.onchange = function(event) {
						kunciJawabanForm.data["edge" + data.graf[i - 1].id] = event.target.value;
					}
					data.edge.forEach(el => {
						let option = document.createElement("option");
						option.value = el.id
						option.appendChild(document.createTextNode(el.text));
						edge.appendChild(option);
					})

					if (j == 0) {
						col.appendChild(document.createTextNode(data.graf[i - 1].text));
					} else if (j == 1) {
						col.appendChild(node);
					} else if (j == 2) {
						col.appendChild(edge);
					}
				}
				row.appendChild(col);
			}

			table.appendChild(row);
		}

		return table;
	}

	$("#modalKunciJawaban").on("show.bs.modal", function(event) {
		let soalid = $(event.relatedTarget).data('soalid');
		fetch("<?php echo site_url('API/getSoalById/') ?>" + soalid)
			.then(res => res.json())
			.then(data => {
				console.log(data);
				document.getElementById("deskripsiSoalKunciJawaban").innerHTML = data.soal;
				let formKunci = document.getElementById("formKunciJawaban") || document.createElement("form");
				formKunci.id = "formKunciJawaban";
				document.getElementById("modalBody").appendChild(formKunci)
				if (data.bentuk_soal == "drag-and-drop") {
					let table = populateDrag({
						graf: data.graf,
						node: data.node,
						edge: data.edge
					});
					formKunci.appendChild(table);
				} else {
					let table = populateMatrix(data.node);
					formKunci.appendChild(table);
				}
				kunciJawabanForm.bentukSoal = data.bentuk_soal;
			})
	});

	$("#modalKunciJawaban").on("hide.bs.modal", function(event) {
		document.getElementById("deskripsiSoalKunciJawaban").innerHTML = "";
		document.getElementById("formKunciJawaban").remove();
		kunciJawabanForm = [];
	})

	let kunciJawabanForm = {
		bentukSoal: null,
		data: []
	};

	$("#saveKunciJawaban").on("click", function() {
		console.log(kunciJawabanForm.bentukSoal)
		if (kunciJawabanForm.bentukSoal === 'drag-and-drop') {
			console.log(kunciJawabanForm);
		}
	})
</script>