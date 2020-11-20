<div class="col-xl-12 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Body -->
       <div class="card-body">
	   <h1><?php echo $topik->nama_topik ?></h1>
   <div><?php echo $konten->isi_konten ?></div>
        </div>
	<br>	
<div class="col-xl-12 col-lg-7"">


<h4>Tugas </h4>
<p>Status : <?php
// print_r($tugas);
 if($tugas->st=='sudah'){
	?>
	<font style="color:green" > Sudah Dikerjakan </font>
	<br>
	File : <a href=<?php echo base_url("JawabanTugas/$tugas->file_jawaban") ?>> <?php echo $tugas->file_jawaban ?> </a>
	<?php
	if($tugas->total_submit!=5){
		echo form_open_multipart('Mahasiswa/update_tugas');
		?>
		Edit Tugas :
		<input type="file" name="file"/>
		<input type="hidden" name="id_jawaban" value="<?php echo $tugas->id_jawaban ?>">
		<input type="hidden" name="total_submit" value="<?php echo $tugas->total_submit ?>">
		<br>
		<input class="btn btn-primary" type="submit" value="submit"/>
		<br>
		<?php 
		echo form_close();
	}
	?>
	<?php
}else if ($tugas->st=='nilai'){?>
	<font style="color:green" > Sudah Dinilai </font>
	<br>
	Nilai : <?php echo $tugas->nilai; ?>
	<br>
	File : <a href=<?php echo base_url("JawabanTugas/$tugas->file_jawaban") ?>> <?php echo $tugas->file_jawaban ?> </a>
	<?php
}else{
	?>
	<font style="color:red"> Belum Dikerjakan </font>
	<?php
	echo form_open_multipart('Mahasiswa/jawab_tugas');
	?>
	File Upload :
	<input type="file" name="file"/>
	<input type="hidden" name="id_topik" value="<?php echo $topik->id_topik ?>">
	<br>
	<input class="btn btn-primary" type="submit" value="submit"/>
	<br>
	<?php 
	echo form_close();
	?>
	<?php
} ?> </p>	

<!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content --> 
</div>
