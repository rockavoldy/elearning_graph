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
				<th class="text-center">Aksi</th>
			</tr>
			<?php $i = 1;
			foreach ($listSoal as $el) { ?>
				<tr>
					<th><?php echo $i ?></th>
					<td><?php echo $el['soal'] ?></td>
					<td class="text-center">
						<?php if ($el['bentuk_soal'] != "isian-esai") { ?>
							<button class="btn btn-primary" type="button" data-toggle="modal" data-soalid="<?php echo $el['id'] ?>" data-target="#modalKunciJawaban">Kunci Jawaban</button>
						<?php } ?>
						<button class="btn btn-info" type="button" data-toggle="modal" data-soalid="<?php echo $el['id'] ?>" data-target="#modalEditSoal">Edit</button>
						<button class="btn btn-danger" type="button" data-toggle="modal" data-soalid="<?php echo $el['id'] ?>" data-target="#modalHapusSoal">Hapus</button>
					</td>

				</tr>
			<?php $i++;
			} ?>
		</table>
	</div>

	<div class="modal fade" id="modalHapusSoal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Hapus Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5>Apa anda yakin akan menghapus soal ini?</h5>
					<span>Soal tidak bisa dihapus jika sudah diisi oleh pengguna.</span>
					<div class="w-100 text-right">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
						<button type="button" class="btn btn-danger" id="hapusSoalButton">Ya, Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEditSoal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modalBodyEditSoal"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="saveEditSoal">Save</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalKunciJawaban" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Kunci Jawaban</h5>
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
								<option value="pilih-node">Memilih Node/Edge</option>
								<option value="isian-esai">Esai</option>
							</select>
						</div>
						<div class="form-group">
							<label for="deskripsiSoal">Deskripsi Soal</label>
							<textarea id="deskripsiSoal" name="deskripsiSoal" class="form-control"></textarea>
						</div>
						<div id="divSoalCustom"></div>
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

	// let lastSoalValue = null;

	$("#bentukSoal").on("change", (event) => {
		let divSoalCustom = document.getElementById("divSoalCustom");
		divSoalCustom.innerHTML = "";
		if (event.target.value == "drag-and-drop") {
			let heading5 = document.createElement("h5");
			heading5.appendChild(document.createTextNode(event.target.selectedOptions[0].text));
			divSoalCustom.appendChild(heading5);

			for (let i = 0; i < 3; i++) {
				let textInput = "";
				switch (i) {
					case 0:
						textInput = "Graf";
						break;
					case 1:
						textInput = "Node";
						break;
					case 2:
						textInput = "Edge";
						break;
					default:
						break;
				}

				let divFormGroupArray = document.createElement("div");
				divFormGroupArray.setAttribute("class", "form-group");

				let labelFormArray = document.createElement("label");
				labelFormArray.setAttribute("for", "list" + textInput + "-" + event.target.value);
				labelFormArray.appendChild(document.createTextNode("Array " + textInput));
				let inputFormArray = document.createElement("input");
				inputFormArray.setAttribute("type", "text");
				inputFormArray.setAttribute("class", "form-control");
				inputFormArray.setAttribute("placeholder", "{A, B, C}")
				inputFormArray.id = "list" + textInput + "-" + event.target.value

				divFormGroupArray.appendChild(labelFormArray);
				divFormGroupArray.appendChild(inputFormArray);
				divSoalCustom.appendChild(divFormGroupArray);
			}

		} else if (event.target.value == 'isian-esai') {

		} else {
			let heading5 = document.createElement("h5");
			heading5.appendChild(document.createTextNode(event.target.selectedOptions[0].text));

			let divFormGroupArray = document.createElement("div");
			divFormGroupArray.setAttribute("class", "form-group");

			let labelFormArray = document.createElement("label");
			labelFormArray.setAttribute("for", "listNode-" + event.target.value);
			labelFormArray.appendChild(document.createTextNode("Array Node"));
			let inputFormArray = document.createElement("input");
			inputFormArray.setAttribute("type", "text");
			inputFormArray.setAttribute("class", "form-control");
			inputFormArray.setAttribute("placeholder", "{A, B, C}")
			inputFormArray.id = "listNode-" + event.target.value;
			divSoalCustom.appendChild(heading5);
			divFormGroupArray.appendChild(labelFormArray);
			divFormGroupArray.appendChild(inputFormArray);
			divSoalCustom.appendChild(divFormGroupArray);
			if (event.target.value == 'pilih-node') {
				let divFormGroupArrayEdge = document.createElement("div");
				divFormGroupArrayEdge.setAttribute("class", "form-group");

				let labelFormArrayEdge = document.createElement("label");
				labelFormArrayEdge.setAttribute("for", "listEdge-" + event.target.value);
				labelFormArrayEdge.appendChild(document.createTextNode("Array Edge"));

				let inputFormArrayEdge = document.createElement("input");
				inputFormArrayEdge.setAttribute("type", "text");
				inputFormArrayEdge.setAttribute("class", "form-control");
				inputFormArrayEdge.setAttribute("placeholder", "{(A, B), (A, C)}")
				inputFormArrayEdge.id = "listEdge-" + event.target.value;

				divFormGroupArrayEdge.appendChild(labelFormArrayEdge);
				divFormGroupArrayEdge.appendChild(inputFormArrayEdge);
				divSoalCustom.appendChild(divFormGroupArrayEdge);
			}
		}
	})

	$("#saveSoalButton").on("click", () => {
		let bentukSoal = document.getElementById("bentukSoal").value;
		let data = {};
		if (bentukSoal == "drag-and-drop") {
			data = {
				deskripsiSoal: $("#deskripsiSoal").val(),
				dataSoalGraf: $("#listGraf-" + bentukSoal).val(),
				dataSoalNode: $("#listNode-" + bentukSoal).val(),
				dataSoalEdge: $("#listEdge-" + bentukSoal).val()
			}
		} else if (bentukSoal == "pilih-node") {
			data = {
				deskripsiSoal: $("#deskripsiSoal").val(),
				listNode: $("#listNode-" + bentukSoal).val(),
				listEdge: $("#listEdge-" + bentukSoal).val(),
			}
		} else {
			data = {
				deskripsiSoal: $("#deskripsiSoal").val(),
				listNode: $("#listNode-" + bentukSoal).val(),
			}
		}

		console.log(data);

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

	function populateMatrix(node, bentukSoal) {
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
					checkbox.id = "check." + node[i - 1].id + "." + node[j - 1].id
					checkbox.onchange = function(event) {
						let index = kunciJawabanForm.data.findIndex(el => el.checkbox_id == event.target.id);
						if (index < 0) {
							kunciJawabanForm.data.push({
								id_soal: node[i - 1].id_soal,
								checkbox_id: event.target.id,
								start_node: node[i - 1].id,
								end_node: node[j - 1].id,
								directional: bentukSoal == "membuat-graf-euler" ? true : false,
								checked: event.target.checked
							});
						} else {
							if (event.target.checked == true) {
								kunciJawabanForm.data[index] = {
									id_soal: node[i - 1].id_soal,
									checkbox_id: event.target.id,
									start_node: node[i - 1].id,
									end_node: node[j - 1].id,
									directional: bentukSoal == "membuat-graf-euler" ? true : false,
									checked: true
								}
							} else {
								kunciJawabanForm.data[index] = {
									id_soal: node[i - 1].id_soal,
									checkbox_id: event.target.id,
									start_node: node[i - 1].id,
									end_node: node[j - 1].id,
									directional: bentukSoal == "membuat-graf-euler" ? true : false,
									checked: false
								}
							}
						}
					}
				}

				row.appendChild(col);
			}

			table.appendChild(row);
		}

		fetch("<?php echo site_url("API/getKunciJawaban/") ?>" + node[0].id_soal + "/" + bentukSoal)
			.then(res => res.json())
			.then(data => {
				if (data.length != 0) {
					data.forEach(el => {
						let checkbox = document
							.getElementById('check.' + el.start_node_id + "." + el.end_node_id).checked = true;
					})
				}
			});

		return table;
	}

	function populateDrag(data, bentukSoal) {
		let table = document.createElement("table");
		table.id = "matrixTable";
		table.setAttribute("class", "table");
		table.innerHTML = "";
		for (let i = 0; i < data.graf.length + 1; i++) {
			let row = document.createElement("tr");

			for (let j = 0; j < 3; j++) {
				let col = document.createElement("td");

				let placeholderOptionNode = document.createElement("option");
				placeholderOptionNode.setAttribute("selected", true);
				placeholderOptionNode.setAttribute("disabled", true);
				placeholderOptionNode.appendChild(document.createTextNode("Pilih Kunci Jawaban Node"));

				let placeholderOptionEdge = document.createElement("option");
				placeholderOptionEdge.setAttribute("selected", true);
				placeholderOptionEdge.setAttribute("disabled", true);
				placeholderOptionEdge.appendChild(document.createTextNode("Pilih Kunci Jawaban Edge"));

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
						let index = kunciJawabanForm.data.findIndex(el => el.id_text_graf == data.graf[i - 1].id);
						if (index >= 0) {
							kunciJawabanForm.data[index].id_text_node = event.target.value;
						} else {
							kunciJawabanForm.data.push({
								id_soal: data.graf[i - 1].id_soal,
								id_text_graf: data.graf[i - 1].id,
								id_text_node: event.target.value,
								id_text_edge: null
							});
						}
					}
					node.appendChild(placeholderOptionNode);
					data.node.forEach(el => {
						let option = document.createElement("option");
						option.value = el.id
						option.appendChild(document.createTextNode(el.text));
						node.appendChild(option);
					})

					let edge = document.createElement("select");
					edge.setAttribute("class", "form-control");
					edge.id = "pilihEdge" + data.graf[i - 1].id;
					edge.onchange = function(event) {
						let index = kunciJawabanForm.data.findIndex(el => el.id_text_graf == data.graf[i - 1].id);
						if (index >= 0) {
							kunciJawabanForm.data[index].id_text_edge = event.target.value;
						} else {
							kunciJawabanForm.data.push({
								id_soal: data.graf[i - 1].id_soal,
								id_text_graf: data.graf[i - 1].id,
								id_text_node: null,
								id_text_edge: event.target.value
							});
						}
					}
					edge.appendChild(placeholderOptionEdge);
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
		fetch("<?php echo site_url("API/getKunciJawaban/") ?>" + data.graf[0].id_soal + "/" + bentukSoal)
			.then(res => res.json())
			.then(data => {
				if (data.length != 0) {
					data.forEach(el => {
						document
							.getElementById('pilihNode' + el.id_text_graf).value = el.id_text_node;

						document
							.getElementById('pilihEdge' + el.id_text_graf).value = el.id_text_edge;
					});
				}
			});

		return table;
	}

	function populatePilihKunci(node, edge) {
		let dataPopulate = node;

		const createOption = (value, text, selected, disabled) => {
			let selectOption = document.createElement("option");
			selectOption.setAttribute("value", value);
			selected ? selectOption.setAttribute("selected", true) : false;
			disabled ? selectOption.setAttribute("disabled", true) : false;
			selectOption.appendChild(document.createTextNode(text));

			return selectOption;
		}

		let divKunci = document.createElement("div");

		let divSwitch = document.createElement("div");
		divSwitch.setAttribute("class", "custom-control, custom-switch");

		let inputSwitch = document.createElement("input");
		inputSwitch.setAttribute("class", "custom-control-input");
		inputSwitch.setAttribute("type", "checkbox");
		inputSwitch.id = "switch-pilih";
		inputSwitch.checked = false;

		let labelSwitch = document.createElement("label");
		labelSwitch.setAttribute("class", "custom-control-label");
		labelSwitch.setAttribute("for", "switch-pilih");
		labelSwitch.appendChild(document.createTextNode("Pilih Node"))

		let selectInput = document.createElement("select");
		selectInput.setAttribute("class", "form-control");
		selectInput.id = "pilih-node";
		selectInput.onchange = function(event) {
			console.log("pilih " + event.target.value);
			let index = kunciJawabanForm.data.findIndex(el => el.id == event.target.value);
			if (index >= 0) {
				kunciJawabanForm.data[index].id = event.target.value;
			} else if (index < 0) {
				kunciJawabanForm.data = {
					"id_soal": node[0].id_soal,
					"id": event.target.value,
					"kunci": true
				};
			}
		}

		let selectOptionDefault = createOption("", "Pilih Node/Edge", true, true);
		selectInput.appendChild(selectOptionDefault)

		dataPopulate.forEach(el => {
			let selectOption = "";
			if (el.posy) {
				selectOption = createOption("node." +
					el.id, el.text);
			} else {
				selectOption = createOption("edge." + el.id, el.start_text + " - " + el.end_text);
			}
			selectInput.appendChild(selectOption);
		});

		inputSwitch.onchange = function(event) {
			selectInput.innerHTML = "";
			let selectOptionDefault = createOption("", "Pilih Node/Edge", true, true);
			selectInput.appendChild(selectOptionDefault)
			if (event.target.checked) {
				labelSwitch.removeChild(labelSwitch.childNodes[0]);
				labelSwitch.appendChild(document.createTextNode("Pilih Edge"));
				edge.forEach(el => {
					let selectOption = createOption("edge." + el.id, el.start_text + " - " + el.end_text);
					selectInput.appendChild(selectOption);
				})
			} else {
				labelSwitch.removeChild(labelSwitch.childNodes[0]);
				labelSwitch.appendChild(document.createTextNode("Pilih Node"));
				node.forEach(el => {
					let selectOption = createOption("node." + el.id, el.text);
					selectInput.appendChild(selectOption);
				})
			}
		}
		divSwitch.appendChild(inputSwitch);

		divSwitch.appendChild(labelSwitch);

		divKunci.appendChild(divSwitch);
		divKunci.appendChild(selectInput);

		return divKunci;
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
					console.log("drag-and-drop");
					let table = populateDrag({
						graf: data.graf,
						node: data.node,
						edge: data.edge
					}, data.bentuk_soal);
					formKunci.appendChild(table);
				} else if (data.bentuk_soal == "pilih-node") {
					console.log("pilih-node");
					let kunci = populatePilihKunci(data.node, data.edge);
					formKunci.appendChild(kunci);
				} else if (data.bentuk_soal == "isian-esai") {
					console.log("isian-esai");
				} else {
					let table = populateMatrix(data.node, data.bentuk_soal);
					formKunci.appendChild(table);
				}
				kunciJawabanForm.bentukSoal = data.bentuk_soal;
			})
	});

	$("#modalKunciJawaban").on("hide.bs.modal", function(event) {
		document.getElementById("deskripsiSoalKunciJawaban").innerHTML = "";
		document.getElementById("formKunciJawaban").remove();
		kunciJawabanForm = {
			bentukSoal: null,
			data: []
		};
	})

	let kunciJawabanForm = {
		bentukSoal: null,
		data: []
	};

	$("#saveKunciJawaban").on("click", function() {
		let data = {
			bentukSoal: kunciJawabanForm.bentukSoal,
			dataKunci: kunciJawabanForm.data
		};

		console.log(data);

		$.ajax({
				method: "POST",
				url: "<?php echo site_url('API/saveKunciJawaban/') ?>",
				data: data
			})
			.done(function(res) {
				console.log(res);
				if (res.message != "success") {
					alert("Gagal input, cek kembali array node dan graf agar sesuai format");
				} else {
					$("#modalKunciJawaban").modal('toggle');
				}
			});
	})

	$("#modalHapusSoal").on("show.bs.modal", function(event) {
		let soalid = $(event.relatedTarget).data('soalid');
		$("#hapusSoalButton").on("click", function() {
			$.ajax({
					method: "GET",
					url: "<?php echo site_url('API/delSoal/') ?>" + soalid,
				})
				.done(function(res) {
					// $("#modalHapusSoal").modal('toggle');
					window.location.reload(false);
				});
		})
	})
</script>