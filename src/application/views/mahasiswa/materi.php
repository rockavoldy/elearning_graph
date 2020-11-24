<script src="<?php echo base_url('assets/js/Graphs.js') ?>"></script>
<script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>
<div class="d-flex flex-wrap">
	<div class="col-12 ">
		<div class="card shadow mb-4">
			<!-- Card Body -->
			<div class="card-body">
				<h1><?php echo $topik->nama_topik ?></h1>
				<div><?php echo $konten->isi_konten ?></div>
			</div>
			<br>
			<!-- /.container-fluid -->
		</div>
	</div>
	<div class="col-12 ">
		<div class="card shadow px-3 py-4">
			<h4>Tugas</h4>
			<style>
				.draggable {
					touch-action: none;
					user-select: none;
				}
			</style>
			<div id="tugas"></div>
		</div>
		<script>
			// let graph = new Graph('canvas');
			let createdNode = [];

			fetch("<?php echo base_url('API/getSoal/' . $topik->kode_topik) ?>")
				.then(res => res.json())
				.then(data => {
					console.log(data);
					data.forEach(el => {
						let elTugas = document.getElementById("tugas");
						let divSoal = document.createElement("div");
						let divSoalText = document.createElement("div");
						let divSoalButton = document.createElement("div");
						divSoalButton.setAttribute("class", "px-3 py-2");

						soalText = document.createElement("span");
						soalText.appendChild(document.createTextNode(el.soal || "Tidak ada deskripsi soal"));
						divSoalText.appendChild(soalText);
						divSoalText.setAttribute("class", "w-100");

						let buttonSaveJawaban = document.createElement("button");
						buttonSaveJawaban.setAttribute("class", "btn btn-primary");
						buttonSaveJawaban.appendChild(document.createTextNode("Simpan Jawaban"));

						if (el.bentuk_soal == "drag-and-drop") {
							buttonSaveJawaban.onclick = () => this.saveJawabanDrag(el.id);

							divSoal.setAttribute("class", "d-flex flex-wrap col-12 mb-3");
							divSoal.appendChild(divSoalText);

							elDrop = this.populateGraf(el.graf);
							elDrag = this.populateDrop(el.node.concat(el.edge))
							divSoal.appendChild(elDrop);
							divSoal.appendChild(elDrag);
							divSoalButton.appendChild(buttonSaveJawaban);

							divSoal.appendChild(divSoalButton);
							elTugas.appendChild(divSoal);
						} else if (el.bentuk_soal == "membuat-matriks") {
							buttonSaveJawaban.onclick = () => this.saveJawabanMatriks(el.id)
							const table = this.populateMatrix(el.node);
							let divTableResponsive = document.createElement("div");
							divTableResponsive.setAttribute("class", "table-responsive");
							divTableResponsive.appendChild(table);
							divSoal.appendChild(divSoalText);
							divSoal.appendChild(divTableResponsive);

							divSoalButton.appendChild(buttonSaveJawaban);

							divSoal.appendChild(divSoalButton);
							elTugas.appendChild(divSoal);
						} else {
							// buttonSaveJawaban.id = "button-graf-interaktif";
							buttonSaveJawaban.onclick = () => this.saveJawabanGraf(el.id, el.bentuk_soal)


							let canvas = document.createElement("canvas");
							canvas.id = "canvas" + el.id;
							canvas.width = 800;
							// canvas.setAttribute("height", 600);
							var heightRatio = 0.5;
							canvas.height = canvas.width * heightRatio;
							canvas.setAttribute("style", "border: 2px solid black; background-color: white;");

							divSoal.setAttribute("class", "d-flex flex-wrap mb-3");
							divSoal.appendChild(divSoalText);
							divSoal.appendChild(canvas);
							elTugas.appendChild(divSoal);

							this.populateNode(canvas.id, el.node, el.bentuk_soal, el.id);

							divSoalButton.appendChild(buttonSaveJawaban);
							divSoal.appendChild(divSoalButton);
						}
						// console.log(el);
					})
				});

			let arrGraph = [];

			// function to save jawaban
			function saveJawabanGraf(id_soal, bentukSoal) {
				let dataaa = createdNode.find(el => el.id_soal == id_soal);

				let kirim = [];
				let graphObj = arrGraph.find(el => el.id_soal == id_soal);
				if (graphObj.id_soal == id_soal) {
					let edges = graphObj.graphObj.edges;
					let isEuler = graphObj.graphObj.euler;
					// console.log(graphObj);
					Object.entries(edges).forEach(([keey, ell]) => {
						kirim.push({
							id_soal: id_soal,
							// id_mhs: <?php echo $this->session->userdata('id'); ?>,
							start_node_id: dataaa.data.find(elll => elll.nodeId == ell.startNodeid).id,
							end_node_id: dataaa.data.find(elll => elll.nodeId == ell.endNodeid).id,
							bobot: 0,
							directional: isEuler
						});
					})
				}
				console.log(kirim);
				kirimJawaban(id_soal, bentukSoal, kirim)
			}

			let arrDrag = [];
			let arrDrop = [];

			function saveJawabanDrag(id_soal) {
				console.log(arrDrag);
				kirimJawaban(id_soal, "drag-and-drop", arrDrag);
			}

			let arrMatriks = [];

			function saveJawabanMatriks(id_soal) {
				console.log(arrMatriks)
			}

			function kirimJawaban(id_soal, bentukSoal, dataKirim) {
				let data = {
					bentukSoal: bentukSoal,
					dataJawaban: dataKirim
				}
				$.ajax({
						method: "POST",
						url: "<?php echo site_url('API/saveJawabanSiswa/') ?>" + id_soal,
						data: data
					})
					.done(function(res) {
						console.log(res);
					});
			}

			// graf interactive
			function populateNode(canvasId, data, bentukSoal, id_soal) {
				let graph = null;
				if (bentukSoal === "membuat-graf-euler") {
					graph = new Graph(canvasId, true, true)
				} else if (bentukSoal === "pilih-node" || bentukSoal === "membuat-matriks") {
					graph = new Graph(canvasId, false, false);
				} else {
					graph = new Graph(canvasId, true, false);
				}


				let nodeData = [];
				data.forEach(el => {
					let nodeId = graph.node(Number(el.posx), Number(el.posy), 25, el.text).id;
					nodeData.push({
						id_soal: el.id_soal,
						nodeId: nodeId,
						text: el.text,
						id: el.id
					});
				});

				createdNode.push({
					id_soal: id_soal,
					data: nodeData
				});

				arrGraph.push({
					id_soal: id_soal,
					graphObj: graph
				})
			}

			// drag-and-drop interactive
			function populateGraf(data) {
				const elDrop = document.createElement("div");
				elDrop.setAttribute("class", "col-12 d-flex flex-wrap mb-2");
				elDrop.id = "graf-dropzone";

				data.forEach(el => {
					let graf = document.createElement("div");
					graf.id = "graf-" + el.id;
					graf.setAttribute("class", "col-3 p-2 border border-dark bg-light rounded-lg");
					graf.setAttribute("style", "height: 200px");
					graf.appendChild(document.createTextNode(el.text));
					elDrop.appendChild(graf);
				})

				this.makeDropzone(data);
				return elDrop;
			}

			function populateDrop(data) {
				const elDrag = document.createElement("div");
				elDrag.setAttribute("class", "draggable col-12 d-flex flex-wrap border border-dark");
				elDrag.id = "graf-pilihan";

				data.forEach(el => {
					let nodee = document.createElement("div");
					nodee.id = "drop-" + el.id;
					nodee.setAttribute("class", "col-2 mx-2 my-1 border border-dark bg-dark text-light rounded");
					nodee.appendChild(document.createTextNode(el.text));
					elDrag.appendChild(nodee);
				})

				this.makeDraggable(data);
				return elDrag;
			}

			// membuat matriks table
			function populateMatrix(data) {
				let table = document.createElement("table");
				table.id = "matrixTable";
				table.setAttribute("class", "table table-bordered");
				table.innerHTML = "";
				console.log(data);
				for (let i = 0; i < data.length + 1; i++) {
					let row = document.createElement("tr");

					for (let j = 0; j < data.length + 1; j++) {
						let col = document.createElement("td");
						if (i == 0 && j == 0) {
							col.appendChild(document.createTextNode(""));
						} else if (i == 0 && j > 0) {
							col.appendChild(document.createTextNode(data[j - 1].text));
						} else if (j == 0 && i > 0) {
							col.appendChild(document.createTextNode(data[i - 1].text));
						}
						if (i > 0 && j > 0) {
							let checkbox = document.createElement("input");
							checkbox.setAttribute("type", "checkbox");
							col.appendChild(checkbox);
							checkbox.id = "check." + data[i - 1].id + "." + data[j - 1].id;
							checkbox.onchange = function(event) {
								let getIndexMatriks = arrMatriks.findIndex(el => el.checkbox_id == event.target.id);
								if (getIndexMatriks < 0) {
									if (event.target.checked == true) {
										arrMatriks.push({
											id_soal: data[i - 1].id_soal,
											checkbox_id: event.target.id,
											start_node: data[i - 1].id,
											end_node: data[j - 1].id,
											directional: false,
											checked: event.target.checked
										});
									}
								} else {
									if (event.target.checked == true) {
										arrMatriks[getIndexMatriks] = {
											id_soal: data[i - 1].id_soal,
											checkbox_id: event.target.id,
											start_node: data[i - 1].id,
											end_node: data[j - 1].id,
											directional: false,
											checked: true
										}
									} else {
										arrMatriks[getIndexMatriks] = {
											id_soal: data[i - 1].id_soal,
											checkbox_id: event.target.id,
											start_node: data[i - 1].id,
											end_node: data[j - 1].id,
											directional: false,
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
				return table;
			}


			function makeDropzone(data) {
				data.forEach(el => {
					interact("#graf-" + el.id)
						.dropzone({
							ondrop: function(event) {
								// console.log(event.target.id); //dropbox (graf)
								// console.log(event.relatedTarget.id); //draggable item (node or edge)

								arrDrag = arrDrag.filter(el => el.id_jawaban != event.relatedTarget.id.split("-")[1]);
								arrDrag.push({
									id_soal: el.id,
									id_text_graf: event.target.id.split("-")[1],
									id_jawaban: event.relatedTarget.id.split("-")[1],
								})
								console.log(arrDrag)
							}
						})
						.on('dropactivate', function(event) {
							event.target.classList.add('drop-activated');
						})
				})
			}

			function makeDraggable(data) {
				let position = {
					x: 0,
					y: 0
				};
				data.forEach(el => {
					arrDrop["drop-" + el.id] = {
						position: {
							x: 0,
							y: 0
						},
						droppedInto: null
					}
					interact("#drop-" + el.id).draggable({
						listeners: {
							start(event) {
								// console.log(event.type, event.target)
							},
							move(event) {
								arrDrop["drop-" + el.id].position.x += event.dx
								arrDrop["drop-" + el.id].position.y += event.dy

								event.target.style.transform =
									`translate(${arrDrop["drop-" + el.id].position.x}px, ${arrDrop["drop-" + el.id].position.y}px)`
							},
						}
					})
				})
			}
		</script>
	</div>
</div>