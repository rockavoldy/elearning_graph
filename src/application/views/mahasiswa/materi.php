<script src="<?php echo base_url('assets/js/Graphs.js') ?>"></script>
<script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>
<div class="d-flex flex-wrap">
	<div class="col-xl-12 col-lg-7">
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
	<div class="col-xl-12 col-lg-7">
		<div class="card shadow px-3 py-4">
			<h4>Tugas</h4>
			<style>
				.draggable {
					touch-action: none;
					user-select: none;
				}
			</style>
			<div id="tugas"></div>
			<div class="d-none mb-3 p-2" id="drag-and-drop" class="col-12" style="border: 2px solid black; background-color: white;">
				<div id="graf-dropzone" class="d-flex flex-wrap"></div>

				<div id="graf-pilihan" class="d-flex flex-wrap"></div>
			</div>
		</div>
		<script>
			// let graph = new Graph('canvas');
			let createdNode = [];

			fetch("<?php echo base_url('API/getSoal/' . $topik->kode_topik) ?>")
				.then(res => res.json())
				.then(data => {
					console.log(data);
					data.forEach(el => {
						if (el.bentuk_soal == "drag-and-drop") {
							let dragdrop = document.getElementById("drag-and-drop");
							let divSoal = document.createElement("div");
							let divSoalText = document.createElement("div");

							soalText = document.createElement("span");
							soalText.appendChild(document.createTextNode(el.soal));
							divSoalText.appendChild(soalText);
							divSoalText.setAttribute("class", "w-100");

							divSoal.setAttribute("class", "col-12");
							divSoal.appendChild(divSoalText);

							dragdrop.insertBefore(divSoal, document.getElementById("graf-dropzone"));
							dragdrop.classList.remove('d-none');

							this.populateGraf(el.graf);
							this.populateNodeDrop(el.node);
							this.populateEdge(el.edge);
						} else if (el.bentuk_soal == "membuat-matriks") {
							const table = this.populateMatrix(el.node);

							let divTugas = document.getElementById("tugas");
							let divTableResponsive = document.createElement("div");
							divTableResponsive.setAttribute("class", "table-responsive");
							divTableResponsive.appendChild(table);
							divTugas.appendChild(divTableResponsive);
						} else {
							let elTugas = document.getElementById("tugas");
							let divSoal = document.createElement("div");
							let divSoalText = document.createElement("div");
							let divSoalButton = document.createElement("div");
							divSoalButton.setAttribute("class", "px-3 py-2");

							soalText = document.createElement("span");
							soalText.appendChild(document.createTextNode(el.soal));
							divSoalText.appendChild(soalText);
							divSoalText.setAttribute("class", "w-100");

							let buttonSaveJawaban = document.createElement("button");
							buttonSaveJawaban.setAttribute("class", "btn btn-primary");
							buttonSaveJawaban.appendChild(document.createTextNode("Simpan Jawaban"));
							buttonSaveJawaban.id = "button-graf-interaktif";
							buttonSaveJawaban.onclick = () => this.saveJawabanGraf(el.id)
							divSoalButton.appendChild(buttonSaveJawaban);

							divSoal.setAttribute("class", "d-flex flex-wrap");
							divSoal.appendChild(divSoalText);

							let canvas = document.createElement("canvas");
							canvas.id = "canvas" + el.id;
							canvas.width = 800;
							// canvas.setAttribute("height", 600);
							var heightRatio = 0.5;
							canvas.height = canvas.width * heightRatio;
							canvas.setAttribute("style", "border: 2px solid black; background-color: white;");
							divSoal.appendChild(canvas);
							divSoal.appendChild(divSoalButton);

							elTugas.appendChild(divSoal);
							console.log(el);
							this.populateNode(canvas.id, el.node, el.bentuk_soal, el.id);
						}
					})
				});

			let arrGraph = [];

			function saveJawabanGraf(id_soal) {
				let dataaa = createdNode.find(el => el.id_soal == id_soal);
				console.log("data")
				console.log(dataaa);

				let kirim = [];
				let graphObj = arrGraph.find(el => el.id_soal == id_soal);
				if (graphObj.id_soal == id_soal) {
					let edges = graphObj.graphObj.edges;
					let isEuler = graphObj.graphObj.euler;
					console.log(graphObj);
					Object.entries(edges).forEach(([keey, ell]) => {
						kirim.push({
							id_soal: id_soal,
							id_mhs: <?php echo $this->session->userdata('id'); ?>,
							start_node_id: dataaa.data.find(elll => elll.nodeId == ell.startNodeid).id,
							end_node_id: dataaa.data.find(elll => elll.nodeId == ell.endNodeid).id,
							bobot: 0,
							directional: isEuler
						});
					})
				}
				console.log(kirim)
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
				let dropzone = document.getElementById("graf-dropzone");
				data.forEach(el => {
					let graf = document.createElement("div");
					graf.id = "grafbox" + el.id;
					graf.setAttribute("class", "col-3 p-2 border border-dark bg-light rounded-lg");
					graf.setAttribute("style", "height: 200px");
					graf.appendChild(document.createTextNode(el.text));
					dropzone.appendChild(graf);
				})

				this.makeDropzone(data);
			}

			function populateNodeDrop(data) {
				let pilihan = document.getElementById("graf-pilihan");

				data.forEach(el => {
					let nodee = document.createElement("div");
					nodee.id = "drop" + el.id;
					nodee.setAttribute("class", "col-2 p-1 border border-dark bg-dark text-light rounded");
					nodee.appendChild(document.createTextNode(el.text));
					pilihan.appendChild(nodee);
				})

				this.makeDraggable(data);
			}

			function populateEdge(data) {
				let pilihan = document.getElementById("graf-pilihan");

				data.forEach(el => {
					let edge = document.createElement("div");
					edge.id = "drop" + el.id;
					edge.setAttribute("class", "col-2 p-1 border border-dark bg-dark text-light rounded");
					edge.appendChild(document.createTextNode(el.text));
					pilihan.appendChild(edge);
				})

				this.makeDraggable(data);
			}

			// membuat matriks table
			function populateMatrix(data) {
				let table = document.createElement("table");
				table.id = "matrixTable";
				table.setAttribute("class", "table table-bordered");
				table.innerHTML = "";
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
							checkbox.id = "check" + data[i - 1].id + data[j - 1].id
						}

						row.appendChild(col);
					}

					table.appendChild(row);
				}
				return table;
			}

			function makeDropzone(data) {
				data.forEach(el => {
					interact("#grafbox" + el.id).dropzone({
						ondrop: function(event) {
							alert("dropped: " + event.target.id);
						}
					}).on('dropactivate', function(event) {
						event.target.classList.add('drop-activated');
					})
				})
			}

			function makeDraggable(data) {
				let drop = [

				]
				let position = {
					x: 0,
					y: 0
				};
				data.forEach(el => {
					drop["drop" + el.id] = {
						position: {
							x: 0,
							y: 0
						}
					}
					interact('#drop' + el.id).draggable({
						listeners: {
							start(event) {
								console.log(event.type, event.target)
							},
							move(event) {
								drop["drop" + el.id].position.x += event.dx
								drop["drop" + el.id].position.y += event.dy

								event.target.style.transform =
									`translate(${drop["drop" + el.id].position.x}px, ${drop["drop" + el.id].position.y}px)`
							},
						}
					})
				})
			}

			function saveJawaban(data) {
				// TODO
			}
		</script>
	</div>
</div>