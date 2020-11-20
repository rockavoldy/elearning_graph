<div class="col-lg">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Daftar Mahasiswa</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead >
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col">Status</th> 
                                            <th scope="col">Opsi</th>              
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
				            	        $i=1;
					                    foreach ($mahasiswa as $key) {
			                	     ?>
                                        <tr>
                                            <th><?php echo $i; $i++; ?></th>
                                            <td><?php echo " $key->nim"; ?></td>
                                            <td><?php echo "$key->nama"; ?></td>
                                            
                                            <td><?php 
                                            if ($key->aktif==1) {
                                                ?>
                                                <font color=blue;> belum di konfirmasi </font><?php
                                            }else if($key->aktif==2){
                                            ?>
                                            <font color=red;> sudah di konfirmasi </font>
                                            <?php
                                            }
                                            ?></td>

                                            <td> 
                                                <a href="<?php echo site_url("Dosen/konfirmasi/$key->nim") ?>" class="badge badge-warning" >konfirmasi</a>
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
